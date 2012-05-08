var webroot = $('#webroot').val();

function addElement(Model){
	var targetClick = '.add_'+Model+' a';
	var targetValue = '#new_'+Model;
	var recipientAlert = '.error_'+Model;

	$(targetClick).live('click',function(event){
		event.preventDefault();// Previne o form de ser enviado pela forma normal
		var newcat = $(targetValue).val();
		
		$(this).parent('.mws-form-row').css({
		   'background-image' : 'url('+webroot+'img/admin/core/loaders/roller.gif)',
		   'background-position' : 'right center',
		   'background-repeat' : 'no-repeat'
		});
		
		// Envia o formulário via Ajax
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			data: Model+'[nome]='+newcat,
			cache: false,
			dataType: "json",
			success: function(json){
				// $(recipientAlert).html(json).fadeIn().removeClass('hidden');return false;
				$(targetClick).parent('.mws-form-row').removeAttr('style');

				if (json.status == "erro"){
					$(recipientAlert).html(json.msg).fadeIn().removeClass('hidden');
				}
				else if (json.status == "ok"){
					// $(targetClick).parent('.mws-form-row').siblings('.checkboxes').prepend('<input type="checkbox" checked="checked" value="'+json.id+'" id="Categoria1" class="optionsConfig ui-helper-hidden-accessible" name="data[Categoria][]"><label for="Categoria'+json.id+'" class="ui-state-active ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" aria-pressed="true" role="button" aria-disabled="false"><span class="ui-button-text">'+json.nome+'</span></label>');					
					$(targetClick).parent('.mws-form-row').siblings('.checkboxes').prepend('<input type="checkbox" checked="checked" value="'+json.id+'" id="'+Model+json.id+'" class="optionsConfig'+Model+json.id+'" name="data['+Model+'][]"><label class="ui-button" for="'+Model+json.id+'">'+json.nome+'</label>');					
					$('.optionsConfig'+Model+json.id+'').button(); // Categorias e Tags
					$(recipientAlert).html('').fadeOut().addClass('hidden');
				}
			}
		});//end ajax
	});//end click

}

(function($){
	// var loadercontent = $('#loader-content');
	var webroot            = $('#webroot').val();
	var SessionID          = $('#SessionID').val();
	var Taglist            = $('#NoticiaTaglist').val();
	var working            = false;
	var ImagensAdicionadas = 0;


	var configContent = {
		toolbar: 'Geral',
		extraPlugins : 'uicolor',
		filebrowserBrowseUrl 		: webroot+'js/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl 	: webroot+'js/ckfinder/ckfinder.html?type=NoticiaImages',
		filebrowserUploadUrl 		: webroot+'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl 	: webroot+'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=NoticiaImages'
	}, configChamada = {
		toolbar: 'Basico',
		extraPlugins : 'uicolor',
		resize_enabled : false,
		height: '100px',
		MaxLength: 200
	};

	$('#NoticiaConteudo').ckeditor(configContent);
	// $('#NoticiaChamada').ckeditor(configChamada);


	$('.optionsConfig').button(); // Categorias e Tags

	// Criação de categorias e tags novas por ajax
	addElement('Tag');
	addElement('Categoria');



	/* Collapsible Panels */
	$(".wrap.mws-collapsible.mws-collapsed .panel-body").css("display", "none");
	$(".wrap.mws-collapsible .mws-panel-header")
		.append("<div class=\"mws-collapse-button mws-inset\"><span></span></div>")
		.find(".mws-collapse-button span")
		.live("click", function(event) {
			$(this)
				.parents(".wrap")
				.toggleClass("mws-collapsed")
				.find(".panel-body")
				.slideToggle("fast");
		});




	/* Visibilidade da Notícia */

	$('#NoticiaSubscriberView').live('change',function(){
		var SelectListSubscribers = $(this).parent('.switch').siblings('.NoticiaView');
		if( $(this).is(':checked') ) {
			if(!SelectListSubscribers.hasClass('hidden')){
				SelectListSubscribers.addClass('hidden');
				$('#SubscriberSubscriber option:selected').each(function() {
			        $(this).removeAttr('selected');
			        $("#SubscriberSubscriber").trigger("liszt:updated"); // Atualiza os elementos criados pelo plugin
			    });
			}
		}
		else{
			if(SelectListSubscribers.hasClass('hidden'))
				SelectListSubscribers.removeClass('hidden');
		}
	});
	$('.switch em').live('click',function(){
		$('#NoticiaSubscriberView').trigger("change");
	});


	/* Tooltips */
	if($.fn.tipsy) {
		$(".mws-tooltip-s").tipsy({gravity: 's'});
		// $('input[title], select[title], textarea[title]').tipsy({trigger: 'focus', gravity: 'w'});
	}



	/* Chosen Select Box Plugin */
	/*if($.fn.chosen) {
		$('select.chzn-select').chosen();
	}*/


	// TagEditor para as Palavras-chave
	/*$( '.tagedit' ).tagedit({
		// autocompleteURL: webroot+'tags/taglist',
		// return, comma, period, semicolon
		breakKeyCodes: [ 13, 44, 46, 59 ],
		autocompleteOptions: {
			source: function(request, response){
				// var data = eval('(' + Taglist + ')'); //converte a  string para objeto Json
				// alert( data[0]['id'] );
				var data = eval( Taglist ); //converte a  string para objeto Json
				// var data = [
				// 	{ "id": "1", "label": "Hazel Grouse", "value": "Hazel Grouse" },
				// 	{ "id": "2", "label": "Common Quail",	"value": "Common Quail" },
				// 	{ "id": "3", "label": "Greylag Goose", "value": "Greylag Goose" },
				// 	{ "id": "4", "label": "Merlin", "value": "Merlin" },
				// ];	



				return response($.ui.autocomplete.filter(data, request.term) );
			}
		}
	});*/

	// Function Source
	/*$('#function-source input.tag').tagedit({
		autocompleteOptions: {
			source: function(request, response){
				var data = [
					{ "id": "1", "label": "Hazel Grouse", "value": "Hazel Grouse" },
					{ "id": "2", "label": "Common Quail",	"value": "Common Quail" },
					{ "id": "3", "label": "Greylag Goose", "value": "Greylag Goose" },
					{ "id": "4", "label": "Merlin", "value": "Merlin" },
				];				
				return response($.ui.autocomplete.filter(data, request.term) );
			}
		}
	});	*/



	/*alert(SessionID);
	
	$.ajax({
		type: "POST",
		url: webroot+'noticias/tempUploadCapa/'+SessionID,
		data : {'session_id' : SessionID}  ,
		cache: false,
		dataType: "json",
		success: function(j){
			// var json = eval('(' + j + ')'); //converte a  string para objeto Json

			// console.log( j );

			$('.notice').html( j );
			
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		}
	});//end ajax*/

/**
 * Upload da Capa da Notícia
 */
	var sufixoObjGal = '-galeria';
	$('#uploadify'+sufixoObjGal).uploadify({
		'uploader'			: webroot+'js/plugins/uploadify/uploadify.swf',
		'script'			: webroot+'noticias/tempUploadCapa/',
		'scriptData'  		: {'session_id' : SessionID},
		'cancelImg'			: webroot+'css/plugins/uploadify/cancel.png',
		'folder'			: webroot+'app/webroot/files/tmp/',
		'queueID'			: 'fileQueue'+sufixoObjGal,
		'queueSizeLimit'	: 1,
		'auto'				: true,
		'multi'				: false,
		'fileDesc'			: 'Imagens JPEG, GIF , BMP ou PNG',
		'fileExt'			:  '*.jpg;*.jpeg;*.gif;*.bmp;*.png',
		'sizeLimit'			: 1048576, // Allow a maximum of 1 MB per file
		'buttonText'		: 'Adicionar',
		'onError'			: function(event,queueID,fileObj,errorObj){
			if (errorObj.type === 'File Size'){
				$('#uploadify'+queueID).addClass('uploadifyError');
				$('#uploadify'+queueID+' .percentage').text(' - '+'Extension: '+ fileObj.type+', Erro: '+errorObj.info);
			}
		},
		'onComplete'		: function(event,queueID,fileObj,response,data){
			var json = eval('(' + response + ')'); //converte a  string para objeto Json
			// alert(queueID);
			queueID = sufixoObjGal+queueID;

			if(json.status == 'ok'){
				var reqImagem = json.imagem; // mostra o nome da imagem enviada
				var imgpreview = json.preview;
				//var path = webroot.'files/image/produto/';
				//var path = webroot.'files/tmp/';
				ImagensAdicionadas++;
				
				$('#uploadify'+queueID).addClass('uploadifySucess');
				$('#uploadify'+queueID+' .percentage').text(' - Enviado com sucesso');

				// var imgUploaded = '<div> <img class="imagemtemp preview " src="'+ imgpreview +'" alt="" width="132" /> <p> <input type="hidden" class="imagem" name="data[Noticia][tempfoto]['+ ImagensAdicionadas +'][imagem]" value="'+ reqImagem +'" /> <input type="hidden" class="imagem_default" name="data[Noticia][tempfoto]['+ ImagensAdicionadas +'][imagem_default]" value="" /> </p> <p> <input type="checkbox" name="data[Noticia][tempfoto]['+ ImagensAdicionadas +'][remove]" id="tempfoto'+ ImagensAdicionadas +'" value="'+ ImagensAdicionadas +'"> <label for="tempfoto'+ ImagensAdicionadas +'">Remover</label> </p> </div>';

				$('#imgcapa_preview').attr('src',imgpreview);
				$('#imgcapa_post').val(json.imagem);

				// $('#temporary-imgs'+sufixoObjGal+' .content_inside').append(imgUploaded);//Inclui o thumb da imagem recem enviada
				$('#ImagensAdicionadas').val(ImagensAdicionadas);

				if( $('#temporary-imgs'+sufixoObjGal).hasClass('hidden') ){
					$('#temporary-imgs'+sufixoObjGal).removeClass('hidden');
				}
			}else if(json.status == 'erro'){
				$('#uploadify'+queueID).addClass('uploadifyError');
				$('#uploadify'+queueID+' .percentage').text(' - '+json.msg);
				return false;
			}
		}
	});/*end uploadfy*/
	
})(jQuery);