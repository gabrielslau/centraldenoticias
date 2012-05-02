<div class="noticiasSubscribers form">
<?php echo $this->Form->create('NoticiasSubscriber');?>
	<fieldset>
		<legend><?php echo __('Edit Noticias Subscriber'); ?></legend>
	<?php
		echo $this->Form->input('noticia_id');
		echo $this->Form->input('subscriber_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NoticiasSubscriber.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('NoticiasSubscriber.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Noticias Subscribers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
	</ul>
</div>
