<div class="noticiasTags form">
<?php echo $this->Form->create('NoticiasTag');?>
	<fieldset>
		<legend><?php echo __('Edit Noticias Tag'); ?></legend>
	<?php
		echo $this->Form->input('noticia_id');
		echo $this->Form->input('tag_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NoticiasTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('NoticiasTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Noticias Tags'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
