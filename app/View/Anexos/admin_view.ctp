<div class="anexos view">
<h2><?php  echo __('Anexo');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($anexo['Anexo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Noticia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($anexo['Noticia']['id'], array('controller' => 'noticias', 'action' => 'view', $anexo['Noticia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($anexo['Anexo']['filename']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Anexo'), array('action' => 'edit', $anexo['Anexo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Anexo'), array('action' => 'delete', $anexo['Anexo']['id']), null, __('Are you sure you want to delete # %s?', $anexo['Anexo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Anexos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Anexo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
	</ul>
</div>
