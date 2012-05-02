<div class="noticiasCategorias view">
<h2><?php  echo __('Noticias Categoria');?></h2>
	<dl>
		<dt><?php echo __('Noticia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasCategoria['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $noticiasCategoria['Noticia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasCategoria['Categoria']['id'], array('controller' => 'categorias', 'action' => 'view', $noticiasCategoria['Categoria']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Noticias Categoria'), array('action' => 'edit', $noticiasCategoria['NoticiasCategoria']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Noticias Categoria'), array('action' => 'delete', $noticiasCategoria['NoticiasCategoria']['id']), null, __('Are you sure you want to delete # %s?', $noticiasCategoria['NoticiasCategoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias Categorias'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticias Categoria'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
