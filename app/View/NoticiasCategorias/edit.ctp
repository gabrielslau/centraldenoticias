<div class="noticiasCategorias form">
<?php echo $this->Form->create('NoticiasCategoria');?>
	<fieldset>
		<legend><?php echo __('Edit Noticias Categoria'); ?></legend>
	<?php
		echo $this->Form->input('noticia_id');
		echo $this->Form->input('categoria_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NoticiasCategoria.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('NoticiasCategoria.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Noticias Categorias'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
