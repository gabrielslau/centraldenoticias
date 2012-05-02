<div class="subscribers form">
<?php echo $this->Form->create('Subscriber');?>
	<fieldset>
		<legend><?php echo __('Add Subscriber'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('key');
		echo $this->Form->input('Noticia');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Subscribers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
	</ul>
</div>
