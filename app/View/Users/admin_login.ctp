<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'login'));?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->inputs(array(
		    'legend' => __('Login'),
		    'username',
		    'password'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login'));?>
</div>