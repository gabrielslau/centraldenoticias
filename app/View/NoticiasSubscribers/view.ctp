<div class="noticiasSubscribers view">
<h2><?php  echo __('Noticias Subscriber');?></h2>
	<dl>
		<dt><?php echo __('Noticia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasSubscriber['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $noticiasSubscriber['Noticia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscriber'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticiasSubscriber['Subscriber']['id'], array('controller' => 'subscribers', 'action' => 'view', $noticiasSubscriber['Subscriber']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Noticias Subscriber'), array('action' => 'edit', $noticiasSubscriber['NoticiasSubscriber']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Noticias Subscriber'), array('action' => 'delete', $noticiasSubscriber['NoticiasSubscriber']['id']), null, __('Are you sure you want to delete # %s?', $noticiasSubscriber['NoticiasSubscriber']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias Subscribers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticias Subscriber'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
	</ul>
</div>
