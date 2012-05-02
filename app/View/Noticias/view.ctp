<div class="noticias view">
<h2><?php  echo __('Noticia');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($noticia['User']['id'], array('controller' => 'users', 'action' => 'view', $noticia['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['codigo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['titulo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chamada'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['chamada']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conteudo'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['conteudo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagem'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['imagem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fonte'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['fonte']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destaque'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['destaque']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Noticia Categoria Count'); ?></dt>
		<dd>
			<?php echo h($noticia['Noticia']['noticia_categoria_count']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Noticia'), array('action' => 'edit', $noticia['Noticia']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Noticia'), array('action' => 'delete', $noticia['Noticia']['id']), null, __('Are you sure you want to delete # %s?', $noticia['Noticia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Noticias'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Noticia'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Anexos'), array('controller' => 'anexos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Anexo'), array('controller' => 'anexos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Anexos');?></h3>
	<?php if (!empty($noticia['Anexo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Noticia Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($noticia['Anexo'] as $anexo): ?>
		<tr>
			<td><?php echo $anexo['id'];?></td>
			<td><?php echo $anexo['noticia_id'];?></td>
			<td><?php echo $anexo['filename'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'anexos', 'action' => 'view', $anexo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'anexos', 'action' => 'edit', $anexo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'anexos', 'action' => 'delete', $anexo['id']), null, __('Are you sure you want to delete # %s?', $anexo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Anexo'), array('controller' => 'anexos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Categorias');?></h3>
	<?php if (!empty($noticia['Categoria'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($noticia['Categoria'] as $categoria): ?>
		<tr>
			<td><?php echo $categoria['id'];?></td>
			<td><?php echo $categoria['nome'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'categorias', 'action' => 'view', $categoria['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'categorias', 'action' => 'edit', $categoria['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'categorias', 'action' => 'delete', $categoria['id']), null, __('Are you sure you want to delete # %s?', $categoria['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Subscribers');?></h3>
	<?php if (!empty($noticia['Subscriber'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Key'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($noticia['Subscriber'] as $subscriber): ?>
		<tr>
			<td><?php echo $subscriber['id'];?></td>
			<td><?php echo $subscriber['nome'];?></td>
			<td><?php echo $subscriber['key'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'subscribers', 'action' => 'view', $subscriber['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'subscribers', 'action' => 'edit', $subscriber['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'subscribers', 'action' => 'delete', $subscriber['id']), null, __('Are you sure you want to delete # %s?', $subscriber['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tags');?></h3>
	<?php if (!empty($noticia['Tag'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($noticia['Tag'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id'];?></td>
			<td><?php echo $tag['nome'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
