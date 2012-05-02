<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['id'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($user['User']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Senha'); ?></dt>
		<dd>
			<?php echo h($user['User']['senha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('controller' => 'noticias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Noticias');?></h3>
	<?php if (!empty($user['Noticia'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Codigo'); ?></th>
		<th><?php echo __('Titulo'); ?></th>
		<th><?php echo __('Chamada'); ?></th>
		<th><?php echo __('Conteudo'); ?></th>
		<th><?php echo __('Imagem'); ?></th>
		<th><?php echo __('Fonte'); ?></th>
		<th><?php echo __('Destaque'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Noticia Categoria Count'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Noticia'] as $noticia): ?>
		<tr>
			<td><?php echo $noticia['id'];?></td>
			<td><?php echo $noticia['user_id'];?></td>
			<td><?php echo $noticia['codigo'];?></td>
			<td><?php echo $noticia['titulo'];?></td>
			<td><?php echo $noticia['chamada'];?></td>
			<td><?php echo $noticia['conteudo'];?></td>
			<td><?php echo $noticia['imagem'];?></td>
			<td><?php echo $noticia['fonte'];?></td>
			<td><?php echo $noticia['destaque'];?></td>
			<td><?php echo $noticia['status'];?></td>
			<td><?php echo $noticia['created'];?></td>
			<td><?php echo $noticia['modified'];?></td>
			<td><?php echo $noticia['noticia_categoria_count'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'noticias', 'action' => 'view', $noticia['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'noticias', 'action' => 'edit', $noticia['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'noticias', 'action' => 'delete', $noticia['id']), null, __('Are you sure you want to delete # %s?', $noticia['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Noticia'), array('controller' => 'noticias', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
