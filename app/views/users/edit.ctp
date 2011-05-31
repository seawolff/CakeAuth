<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php echo $session->flash('auth'); ?>

	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirmation', array('type'=>'password'));
		echo $this->Form->input('email');
		if($admin)
		{
			echo $this->Form->input('roles');
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
