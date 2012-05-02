<div class="noticiasTags view">
<h2><?php  echo __('Noticias Tag');?></h2>
	<dl>
		<dt><?php echo __('Noticia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasTag['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $noticiasTag['Noticia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasTag['Tag']['id'], array('controller' => 'tags', 'action' => 'view', $noticiasTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Noticias Tag'), array('action' => 'edit', $noticiasTag['NoticiasTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Noticias Tag'), array('action' => 'delete', $noticiasTag['NoticiasTag']['id']), null, __('Are you sure you want to delete # %s?', $noticiasTag['NoticiasTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticias Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
