<?php
	/**
	 * Seleção dos assinantes da notícia
	*/
	// print_r($this->request->data);exit();
	$subscribers_default = array();
	if(isset($sessao_formulario['Subscriber'])) $subscribers_default = $sessao_formulario['Subscriber'];
	elseif($this->action == 'admin_edit'){
		$subscribers_value = $this->Form->value('Subscriber');
		// print_r($subscribers_value);exit();
		if(!empty($subscribers_value)){
			foreach($subscribers_value as $subscriber){
				$subscribers_default[$subscriber['id']] = $subscriber['nome'];
			}
		}
	}
	// print_r($subscribers_default);exit();

	echo $this->Form->hidden('SessionID', array('value'=> SessionComponent::id() )); 
	// echo $this->Form->create('Noticia', array('class'=>'mws-form', 'id'=>'form_contentpost','type' => 'file'));
	echo $this->Form->create('Noticia', array('class'=>'mws-form', 'id'=>'form_contentpost', 'type' => 'file', 'inputDefaults'=>array('error' => array('attributes' => array('wrap' => 'div', 'class' => 'mws-error')), 'format'=>array('label', 'before', 'between', 'input', 'error', 'after') )));
?>
<div class="mws-panel grid_8 noticias form">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-create"><?php echo $title_for_layout?></span>
    </div>
    <div class="mws-panel-body">
    		<div class="mws-form-inline">
    		<?php

    			echo $this->Form->hidden('Noticia.user_id', array('value'=>AuthComponent::user('id')));

    			if($this->action == 'admin_edit') {
    				echo $this->Form->hidden('id', array('value'=>$this->Form->value('Noticia.id')));
    				echo $this->Form->hidden('Noticia.codigo', array('value'=> $this->Form->value('Noticia.codigo') ));
    			}
    			// echo $this->Form->hidden('created', array('value'=>date('Y-m-d H:i:s')));
				// echo $this->Form->hidden('count_down_value', array('value'=>'0','id'=>'count_down_value'));

    			// TITULO
				echo $this->Form->input('Noticia.titulo', array('type'=>'text', 'label' => array('text'=>'Título *'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Noticia']['titulo']) ? $sessao_formulario['Noticia']['titulo'] : $this->Form->value('Noticia.titulo') ) ));

				// RESUMO
				echo $this->Form->input('Noticia.resumo', array('type'=>'textarea', 'label' => array('text'=>'Resumo <sup>(opcional)</sup>'), 'div'=>array('class'=>'mws-form-row ckeditor'), 'between'=>'<div class="mws-form-item">', 'after'=>'<p class="notice">Se o resumo não for informado, o conteúdo da notícia será utilizado em seu lugar</p></div>', 'value'=>(isset($sessao_formulario['Noticia']['resumo']) ? $sessao_formulario['Noticia']['resumo'] : $this->Form->value('Noticia.resumo') ) ));
				
				// CONTEUDO
				echo $this->Form->input('Noticia.conteudo', array('type'=>'textarea', 'label' => array('text'=>'Conteúdo *'), 'div'=>array('class'=>'mws-form-row ckeditor'), 'between'=>'<div class="mws-form-item">', 'after'=>'</div>', 'value'=>(isset($sessao_formulario['Noticia']['conteudo']) ? $sessao_formulario['Noticia']['conteudo'] : $this->Form->value('Noticia.conteudo') ) ));


				
				// FONTE
				echo $this->Form->input('Noticia.fonte', array('type'=>'text', 'label' => array('text'=>'Fonte da notícia'), 'div'=>array('class'=>'mws-form-row','id'=>'keywordsdiv'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Noticia']['fonte']) ? $sessao_formulario['Noticia']['fonte'] : $this->Form->value('Noticia.fonte') ) ));


				
				
			?>


				

				<div class="mws-form-row notice">Todos os campos marcados com <span style="color:red">*</span> são de preenchimento obrigatório.</div>

    		</div>

    		
    </div>    	
</div>






<?php 
	/**
	 * CATEGORIAS
	*/
?>
<div class="mws-panel grid_4 noticias form mws-collapsible mws-collapsed">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-address-book-4">Categorias</span>
    </div>
    <div class="mws-panel-body clearfix">
    	<div class="mws-form-inline">
    	<?php
    		echo '<div class="mws-form-row no-pb add_Categoria">
					<p class="notice no-mb">adicione uma nova</p>

					<input type="text" class="mws-textinput" maxlength="45" name="nome_Categoria" id="new_Categoria" />
					'.$this->Html->link(__('adicionar', true), array('controller'=>'categorias', 'action' => 'admin_add'),array('class'=>'mws-button black small')).'
					
					<p class="notice no-mb">ou selecione uma na lista</p>
				</div>';
			echo '<div class="mws-message error hidden error_Categoria"></div>';


		    echo '<div class="mws-form-row checkboxes mb10 clearfix">';
		    $categorias_default = isset($sessao_formulario['Categoria']) ? $sessao_formulario['Categoria'] : $this->Form->value('Categoria');
		    if(empty($categorias_default)) $categorias_default = array();
			foreach($categorias as $id=>$categoria){
				$checked = (in_array($id,$categorias_default) ) ? true : false;
				// echo '<input type="checkbox" id="check'.$id.'" value="'.$id.'" class="optionsConfig" /><label for="check'.$id.'">'.$categoria.'</label>';
				echo $this->Form->input('NoticiaCategorias', array('type'=>'checkbox', 'legend'=>false, 'div'=>false, 'class'=>'optionsConfig', 'id'=>'Categoria'.$id, 'name'=>'data[Categoria][]', 'value'=>$id, 'label'=>array('text'=>$categoria,'class'=>'ui-button'), 'checked'=>$checked ));
			}
			echo '</div>';
    	?>
    	</div>
    </div>
    <span class="notice">Se nenhuma categoria for selecionada, a notícia será incluida na categoria GERAL automaticamente.</span>
</div>







<?php 
	/**
	 * TAGS
	*/
?>
<div class="mws-panel grid_4 noticias form mws-collapsible mws-collapsed">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-tag">Tags <sup>(opcional)</sup></span>
    </div>
    <div class="mws-panel-body clearfix">
    	<div class="mws-form-inline">
    	<?php
    		echo '<div class="mws-form-row no-pb add_Tag">
					<p class="notice no-mb">adicione uma nova</p>

					<input type="text" class="mws-textinput" maxlength="45" name="nome_Tag" id="new_Tag" />
					'.$this->Html->link(__('adicionar', true), array('controller'=>'tags', 'action' => 'admin_add'),array('class'=>'mws-button black small')).'
					
					<p class="notice no-mb">ou selecione uma na lista</p>
				</div>';
			echo '<div class="mws-message error hidden error_Tag"></div>';

		    echo '<div class="mws-form-row checkboxes mb10 clearfix">';
		    $tags_default = isset($sessao_formulario['Tag']) ? $sessao_formulario['Tag'] : $this->Form->value('Tag');
		    if(empty($tags_default)) $tags_default = array();
			foreach($tags as $id=>$tag){
				$checked = (in_array($id,$tags_default) ) ? true : false;
				echo $this->Form->input('NoticiaTag', array('type'=>'checkbox', 'legend'=>false, 'div'=>false, 'class'=>'optionsConfig', 'id'=>'Tag'.$id, 'name'=>'data[Tag][]', 'value'=>$id, 'label'=>array('text'=>$tag,'class'=>'ui-button'), 'checked'=>$checked ));
			}
			echo '</div>';
    	?>
    	</div>
    </div>
</div>







<?php 
	/**
	 * CONFIGURAÇÕES
	*/
?>
<div class="mws-panel grid_8 noticias form">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-cog-5">Configurações</span>
    </div>
    <div class="mws-panel-body clearfix">
    	<div class="mws-form-inline">
    	<?php
    		echo '<div class="grid_5">';
				$checked = (isset($sessao_formulario['Noticia']['SubscriberView']) ? $sessao_formulario['Noticia']['SubscriberView'] : ( ($this->action == 'admin_edit' && empty($subscribers_default)) ? true : false ) );
			    $hidden = $checked ? 'hidden' : '';
			    $enable = $checked ? 'selected' : '';
			    $disable = !$checked ? 'selected' : '';
				echo $this->Form->input('SubscriberView', array('type'=>'checkbox', 'class'=>'checkbox', 'label' => false, 'div'=>false, 'before'=> sprintf('<div class="mws-form-row switch"><h5 class="no-mb">Visibilidade da notícia</h5><p class="notice">defina quem terá acesso a visualização desta notícia</p><em class="cb-enable %s mws-tooltip-s" title="Todos poderão ver esta notícia"><span>Pública</span></em><em class="cb-disable %s mws-tooltip-s" title="Defina quem terá acesso a esta notícia"><span>Personalizada</span></em>',$enable, $disable), 'after'=>'</div>', 'value'=>'1', 'checked'=>$checked ));

				echo $this->Form->input('Subscriber', array('type'=>'select', 'data-placeholder'=>'Selecione um ou mais', 'multiple'=>true, 'size'=>10, 'style'=>'width:500px', 'label' => false, 'div'=>array('class'=>'mws-form-row NoticiaView '.$hidden.''), 'between'=>'<p class="notice no-mb">Sites com acesso a esta notícia</p><div class="mws-form-items full">', 'after'=>'</div>', 'class'=>'chzn-select', 'options'=>$subscribers, 'default'=>$subscribers_default  ));
		   echo '</div>';


			echo '<div class="grid_3">';
			   	/*$enable = $disable = '';
			    if( (isset($sessao_formulario['Noticia']['destaque']) && $sessao_formulario['Noticia']['destaque'] == 1) || ( $this->action == 'admin_edit' && $this->Form->value('Noticia.destaque') == 1 ) ){
				    $enable = 'selected';
			    } else $disable = 'selected';*/

			    $checked = (isset($sessao_formulario['Noticia']['checked']) ? $sessao_formulario['Noticia']['checked'] : ( $this->action == 'admin_edit' ? $this->Form->value('Noticia.checked') : false ) );
			    $enable = $checked ? 'selected' : '';
			    $disable = !$checked ? 'selected' : '';

				echo $this->Form->input('Noticia.destaque', array('type'=>'checkbox', 'class'=>'checkbox', 'label' => array('text'=>'Destacar notícia?'), 'div'=>false, 'before'=> sprintf('<div class="mws-form-row switch"><em class="cb-enable %s"><span>Sim</span></em><em class="cb-disable %s"><span>Não</span></em>',$enable, $disable), 'after'=>'</div>', 'value'=>'1', 'checked'=>(isset($sessao_formulario['Noticia']['destaque']) ? $sessao_formulario['Noticia']['destaque'] : ( $this->action == 'admin_edit' ? $this->Form->value('Noticia.destaque') : false ) ) ));

				
			    $checked = (isset($sessao_formulario['Noticia']['status']) ? $sessao_formulario['Noticia']['status'] : ( $this->action == 'admin_edit' ? $this->Form->value('Noticia.status') : true ) );
			    $enable = $checked ? 'selected' : '';
			    $disable = !$checked ? 'selected' : '';
				
				echo $this->Form->input('Noticia.status', array('type'=>'checkbox', 'class'=>'checkbox', 'label' => array('text'=>'Publicar no site?'), 'div'=>false, 'before'=>sprintf('<div class="mws-form-row switch"><em class="cb-enable %s"><span>Sim</span></em><em class="cb-disable %s"><span>Não</span></em>',$enable, $disable), 'after'=>'</div>', 'value'=>'1', 'checked'=>$checked ));
			
			echo '</div>';
    	?>
    	</div>
    </div>
</div>







<?php 
	/**
	 * IMAGEM DE CAPA
	*/
?>
<div class="mws-panel grid_8 noticias form mws-collapsible mws-collapsed">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-image-2">Imagem de capa  <sup>(opcional)</sup></span>
    </div>
    <div class="mws-panel-body clearfix">
    	<div id="capadiv" class="mws-form-row">
	    	<div class="preview">
	            <?php
	            	$imgName = isset($sessao_formulario['Noticia']['imagem']) ? $sessao_formulario['Noticia']['imagem'] : $this->Form->value('Noticia.imagem');

	            	$x = $y = 100;
					if( !empty($imgName) ){
						$imgSrc = $this->Thumbnail->render($imgName, array(
			                    // 'path' => 'image/projeto/'.$noticia['Noticia']['codigo'],
			                    'path' => ( $this->action == 'admin_add' ? 'tmp' : 'image/noticia/'.$this->Form->value('Noticia.codigo')),
			                    'absoluteCachePath' => WWW_ROOT . 'files',
			                    'cachePath' => 'files/cache',
			                    'newWidth' => $x,
			                    'newHeight' => $y,
			                    'resizeOption' => 'portrait'
		                    )
		                );
					}else{
						$imgSrc = $this->Thumbnail->render('preview-dark.jpg', array(
			                    'path' => 'img',
			                    'cachePath' => 'files/cache',
			                    'newWidth' => $x,
			                    'newHeight' => $y,
			                    'resizeOption' => 'portrait'
			                )
			            );	
					}
	            	echo $this->Html->image($imgSrc,array('id'=>'imgcapa_preview','width'=>100,'style'=>'padding:10px;border:1px dashed #dfdfdf;background:#fff;margin:20px 0'));

	            	echo $this->Form->input('Noticia.imagem',array('type'=>'hidden','id'=>'imgcapa_post', 'value'=>$imgName));
	            	echo $this->Form->input('Noticia.imagem_default',array('type'=>'hidden','value'=> ( $this->action == 'admin_add' ? '' : $this->Form->value('Noticia.imagem') ) ));
	            ?>
	        </div>
	        <div class="boxupload">
	            <div id="upload-menu">
	                <div class="buttom_choice"><input type="file" name="data[Noticia][Filedata]" id="uploadify-galeria" /></div>
	            </div>
	            <!-- <br clear="all" /> -->
				<div class="clearfix"></div>
	            
	            <div id="fileQueue-galeria"></div>
				<div id="uploader_errors-galeria" class="ui-state-highlight hidden"></div>
				
				<div class="clearfix"></div>
	        </div><!-- end .boxupload -->
    	</div>
    </div>
</div>





<?php 
	/**
	 * BOTÕES DE AÇÕES
	*/
?>
<div class="mws-panel grid_8 form">
    <div class="mws-panel-body">
    	
    	<div class="mws-button-row">
		<?php
			echo $this->action == 'admin_edit' ? $this->Form->postLink(__('Deletar esta notícia'), array('action' => 'delete', $this->Form->value('Noticia.id')), array('id'=>'del-'.$this->Form->value('Noticia.id'),'class'=>'mws-button red small fl'), __('Tem certeza que deseja excluir a noticia # %s?', $this->Form->value('Noticia.codigo'))) : '';

			echo $this->Html->link(__('Cancelar', true), array('action' => 'index'),array('class'=>'mws-button gray small fl'));

			if($this->action == 'admin_edit'){
				App::uses('CakeTime', 'Utility');

				echo '<span class="notice mr20">Publicado <strong><time datetime="'. $this->Form->value('Noticia.created') .'">'. __(CakeTime::timeAgoInWords( $this->Form->value('Noticia.created') )) .'</time></strong></span>';

				if( $this->Form->value('Noticia.created') != $this->Form->value('Noticia.modified') ){
					echo ' | <span class="notice mr20">Última modificação <strong><time datetime="'. $this->Form->value('Noticia.created') .'">'. __(CakeTime::format('d/m/Y' ,$this->Form->value('Noticia.modified') )) .'</time></strong></span>';
				}
			}

			$label = $this->action == 'admin_add' ? 'Cadastrar' : 'Atualizar';
			echo $this->Form->submit($label,array('class'=>'mws-button blue'));
		?>
		</div>

    </div>
</div>






<?php echo $this->Form->end();?>