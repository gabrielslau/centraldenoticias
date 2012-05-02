<div class="noticiasCategorias index">
	<h2><?php echo __('Noticias Categorias');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('noticia_id');?></th>
			<th><?php echo $this->Paginator->sort('categoria_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($noticiasCategorias as $noticiasCategoria): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($noticiasCategoria['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $noticiasCategoria['Noticia']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($noticiasCategoria['Categoria']['id'], array('controller' => 'categorias', 'action' => 'view', $noticiasCategoria['Categoria']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $noticiasCategoria['NoticiasCategoria']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $noticiasCategoria['NoticiasCategoria']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $noticiasCategoria['NoticiasCategoria']['id']), null, __('Are you sure you want to delete # %s?', $noticiasCategoria['NoticiasCategoria']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Noticias Categoria'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
