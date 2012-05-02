<div class="anexos form">
<?php echo $this->Form->create('Anexo');?>
	<fieldset>
		<legend><?php echo __('Edit Anexo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('noticia_id');
		echo $this->Form->input('filename');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Anexo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Anexo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Anexos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
	</ul>
</div>
