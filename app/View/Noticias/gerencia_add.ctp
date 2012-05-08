<?php
	echo $this->Form->create('Noticia', array('class'=>'mws-form', 'id'=>'form_contentpost','type' => 'file'));
?>
<div class="mws-panel grid_8 pages">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-list">Adicionar nova notícia</span>
    </div>
    <div class="mws-panel-body">
    		<div class="mws-form-inline">
    		<?php
    			if($this->action == 'gerencia_edit') echo $this->Form->hidden('id', array('value'=>$this->Form->value('Noticia.id')));
    			echo $this->Form->hidden('user_id', array('value'=>AuthComponent::user('id')));
    			echo $this->Form->hidden('codigo', array('value'=> isset($sessao_formulario['Noticia']['codigo']) ? $sessao_formulario['Noticia']['codigo'] : $this->Form->value('Noticia.codigo') ));
    			// echo $this->Form->hidden('created', array('value'=>date('Y-m-d H:i:s')));
				// echo $this->Form->hidden('count_down_value', array('value'=>'0','id'=>'count_down_value'));

				echo $this->Form->input('titulo', array('type'=>'text', 'label' => array('text'=>'Título *'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Noticia']['titulo']) ? $sessao_formulario['Noticia']['titulo'] : $this->Form->value('Noticia.titulo') ) ));

				echo $this->Form->input('chamada', array('type'=>'textarea', 'label' => array('text'=>'Subtítulo <sup>(chamada)</sup> *'), 'div'=>array('class'=>'mws-form-row ckeditor'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'value'=>(isset($sessao_formulario['Noticia']['chamada']) ? $sessao_formulario['Noticia']['chamada'] : $this->Form->value('Noticia.chamada') ) ));
				
				echo $this->Form->input('conteudo', array('type'=>'textarea', 'label' => array('text'=>'Conteúdo *'), 'div'=>array('class'=>'mws-form-row ckeditor'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'value'=>(isset($sessao_formulario['Noticia']['conteudo']) ? $sessao_formulario['Noticia']['conteudo'] : $this->Form->value('Noticia.conteudo') ) ));

				echo $this->Form->input('fonte', array('type'=>'text', 'label' => array('text'=>'Fonte da notícia'), 'div'=>array('class'=>'mws-form-row','id'=>'keywordsdiv'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Noticia']['fonte']) ? $sessao_formulario['Noticia']['fonte'] : $this->Form->value('Noticia.fonte') ) ));
				
				echo $this->Form->input('palavras_chave', array('type'=>'text', 'label' => array('text'=>'Palavras-chave da notícia (separe com virgula)'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=>(isset($sessao_formulario['Noticia']['palavras_chave']) ? $sessao_formulario['Noticia']['palavras_chave'] : $this->Form->value('Noticia.palavras_chave') ) ));
				
				echo $this->Form->input('noticiascategoria_id', array('type'=>'select', 'label' => array('text'=>'Categoria da notícia *'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'chzn-select', 'options'=>$noticiascategorias, 'default'=>(isset($sessao_formulario['Noticia']['noticiascategoria_id']) ? $sessao_formulario['Noticia']['noticiascategoria_id'] : $this->Form->value('Noticia.noticiascategoria_id') ) ));
				
				
				// Configurações da notícia
				echo '<div class="mws-form-row">',
						'<h5>Configurações da notícia</h5>';
						echo $this->Form->input('destaque', array('type'=>'checkbox', 'label' => array('text'=>'Destacar notícia?'), 'div'=>false, 'before'=>'<ul class="mws-form-list inline"><li>', 'after'=>'</li></ul>', 'value'=>'1', 'checked'=>(isset($sessao_formulario['Noticia']['destaque']) ? $sessao_formulario['Noticia']['destaque'] : $this->Form->value('Noticia.destaque') ) ));
						
						echo $this->Form->input('status', array('type'=>'checkbox', 'label' => array('text'=>'Publicar no site?'), 'div'=>false, 'before'=>'<ul class="mws-form-list inline"><li>', 'after'=>'</li></ul>', 'value'=>'1', 'checked'=>(isset($sessao_formulario['Noticia']['status']) ? $sessao_formulario['Noticia']['status'] : $this->Form->value('Noticia.status') ) ));
				echo '</div>';
			?>


				<div id="capadiv" class="mws-form-row">
					<!-- <h4>Imagem de capa</h4> -->
					<div class="mws-panel-header">
				    	<span class="mws-i-24 i-image-2">Imagem de capa</span>
				    </div>
                    <div class="preview">
	                    <?php
	                    	$imgName = isset($sessao_formulario['Noticia']['imagem']) ? $sessao_formulario['Noticia']['imagem'] : $this->Form->value('Noticia.imagem');

	                    	$x = $y = 100;
							if( !empty($imgName) ){
								$imgSrc = $this->Thumbnail->render($imgName, array(
					                    // 'path' => 'image/projeto/'.$noticia['Noticia']['codigo'],
					                    'path' => ( $this->action == 'gerencia_add' ? 'tmp' : 'image/noticia/'.$this->Form->value('Noticia.codigo')),
					                    'absoluteCachePath' => WWW_ROOT . 'files',
					                    'cachePath' => 'files/cache',
					                    'newWidth' => $x,
					                    'newHeight' => $y,
					                    'resizeOption' => 'portrait'
				                    )
				                );
							}else{
								$imgSrc = $this->Thumbnail->render('preview.jpg', array(
					                    'path' => 'imgs',
					                    'cachePath' => 'files/cache',
					                    'newWidth' => $x,
					                    'newHeight' => $y,
					                    'resizeOption' => 'portrait'
					                )
					            );	
							}
	                    	echo $this->Html->image($imgSrc,array('id'=>'imgcapa_preview','width'=>100,'style'=>'padding:10px;border:1px dashed #dfdfdf;background:#fff;margin:20px 0'));

	                    	echo $this->Form->input('imagem',array('type'=>'hidden','id'=>'imgcapa_post', 'value'=>$imgName));
	                    	echo $this->Form->input('imagem_default',array('type'=>'hidden','value'=> ( $this->action == 'gerencia_add' ? '' : $this->Form->value('Noticia.imagem') ) ));
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
                </div><div class="clearfix"></div>


				<div class="mws-form-row notice">Todos os campos marcados com <span style="color:red">*</span> são de preenchimento obrigatório.</div>

    		</div>

    		<div class="mws-button-row">
			<?php
				echo $this->action == 'gerencia_edit' ? $this->Form->postLink(__('Deletar esta notícia'), array('action' => 'delete', $this->Form->value('Noticia.id')), array('id'=>'del-'.$this->Form->value('Noticia.id'),'class'=>'mws-button red small fl'), __('Tem certeza que deseja excluir a noticia # %s?', $this->Form->value('Noticia.codigo'))) : '';

				echo $this->Html->link(__('Ver todas as Notícias', true), array('action' => 'index'),array('class'=>'mws-button gray small fl'));

				echo $this->action == 'gerencia_edit' ? '<span class="notice mr20">Publicado <strong><time datetime="'. $this->Form->value('Noticia.created') .'">'. getTimeAgo($this->Form->value('Noticia.created')) .'</time></strong></span>' : '';

				echo $this->action == 'gerencia_add' ? '<input type="submit" value="Cadastrar" class="mws-button blue" />' : '<input type="submit" value="Atualizar" class="mws-button blue" />';
			?>

    			

    			
    			<!-- <input type="reset" value="Limpar" class="mws-button gray" /> -->
    		</div>
    </div>    	
</div>

	<!-- <div class="mws-panel grid_8 pages">
		<div class="mws-panel-header">
	    	<span class="mws-i-24 i-list">Imagem de capa</span>
	    </div>
	    <div class="mws-panel-body">
			<div class="mws-form-inline">

				<div class="mws-form-row">
					<ul class="ulist">
						<li>A foto deve estar nos <strong>formatos .JPG, .GIF, .BMP ou .PNG</strong>;</li>
						<li>Tamanho máximo de <strong>1MB</strong>;</li>
					</ul><div class="fix mb20"></div>

					conteudo aqui
				</div>

				
			</div>
	    </div>
	</div>
 -->
<?php echo $this->Form->end();?>