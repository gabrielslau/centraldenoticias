<div class="noticiasSubscribers index">
	<h2><?php echo __('Noticias Subscribers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('noticia_id');?></th>
			<th><?php echo $this->Paginator->sort('subscriber_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($noticiasSubscribers as $noticiasSubscriber): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($noticiasSubscriber['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $noticiasSubscriber['Noticia']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($noticiasSubscriber['Subscriber']['id'], array('controller' => 'subscribers', 'action' => 'view', $noticiasSubscriber['Subscriber']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $noticiasSubscriber['NoticiasSubscriber']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $noticiasSubscriber['NoticiasSubscriber']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $noticiasSubscriber['NoticiasSubscriber']['id']), null, __('Are you sure you want to delete # %s?', $noticiasSubscriber['NoticiasSubscriber']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Noticias Subscriber'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
	</ul>
</div>
