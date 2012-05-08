<div class="noticias form">
<?php echo $this->Form->create('Noticia' , array('url' => array('controller' => 'noticias','action' =>'edit'), 'id'=>'form_contentNoticia')); ?>
	<div id="post-body">
		<div id="post-body-content">
			<?php
				echo $this->Form->hidden('created', array('value'=>date('Y-m-d H:i:s')));
				echo $this->Form->hidden('count_down_value', array('value'=>'0','id'=>'count_down_value'));
				
				echo $this->Form->input('titulo', array('type'=>'text', 'label' => array('text'=>'Título *', 'class'=>'title'), 'div'=>array('id'=>'titlediv', 'class'=>'boxCol') ));
				
				echo $this->Form->input('chamada', array('type'=>'textarea', 'label' => array('text'=>'Subtítulo <sup>(chamada) *</sup>', 'class'=>'title'), 'div'=>array('id'=>'chamada_div', 'class'=>'boxCol form-field ckeditor'),'maxlength'=>'10' ));
				
				echo $this->Form->input('conteudo', array('type'=>'textarea', 'label' => array('text'=>'Conteúdo *', 'class'=>'title'), 'div'=>array('id'=>'content_div', 'class'=>'boxCol form-field ckeditor'), 'before'=>'<p id="count_down_show"></p>' ));
				
				echo $this->Form->input('fonte', array('type'=>'text', 'label' => array('text'=>'Fonte da notícia', 'class'=>'title'), 'div'=>array('id'=>'fontdiv', 'class'=>'boxCol') ));
				
				echo $this->Form->input('palavras_chave', array('type'=>'text', 'label' => array('text'=>'Palavras-chave da notícia (separe com virgula)', 'class'=>'title'), 'div'=>array('id'=>'keywordsdiv', 'class'=>'boxCol'),'class'=>'fullarg' ));
			?>

			<div id="publishing-control-info" class="fullbox">
				<div class="contentbox">
					<p>Publicado: <strong><time datetime="<?php echo $this->Form->value('Noticia.created')?>"><?php echo getTimeAgo($this->Form->value('Noticia.created'))?></time></strong></p>
					<p>
						<span class="title">Destaque principal? </span>
						<span class="options"><?php echo $form->radio('destaque',array('1'=>'Sim','0'=>'Não'), array('default'=>$this->Form->value('Noticia.destaque'), 'legend'=>false));?></span>
					</p>
					<p>
						<span class="title">Publicar no site? </span>
						<span class="options"><?php echo $form->radio('ativado',array('1'=>'Sim','0'=>'Não'), array('default'=>$this->Form->value('Noticia.status'), 'legend'=>false));?></span>
					</p>
				</div>
			</div><!-- end #publishing-control-info -->
				
			

			<p class="notice">Todos os campos marcados com <span style="color:red">*</span> são de preenchimento obrigatório.</p><br clear="all" />

			<div id="publishing-actions">
				<input type="submit" value="Atualizar" class="fr button blue button-publish" />
				<div class="fix"></div>
			</div>
		</div><!-- end #post-body-content -->
	</div><!-- end #post-body -->
<?php echo $this->Form->end();?>
</div><!-- end .form -->
<div class="actions">
	<h3><?php __('Mais ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Deletar esta notícia', true), array('action' => 'delete', $this->Form->value('Noticia.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Noticia.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar todas as Notícias', true), array('action' => 'index'));?></li>
	</ul>
</div>
<?php
	/*
	** Scripts
	*/
	echo $this->Html->script(array('ckeditor/ckeditor','ckeditor/adapters/jquery','scripts'), false);
?>