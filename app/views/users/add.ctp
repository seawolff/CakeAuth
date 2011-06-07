<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Register'); ?></legend>
		<?php echo $session->flash('auth'); ?>

	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirmation', array('type'=>'password'));
		echo $this->Form->input('email');
		echo $this->Form->input('group_id');
		if($admin)
		{
			echo $this->Form->input('roles', array('value' => 'regularuser'));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
    <?php if($admin): ?>
      <li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
    <?php endif; ?>

		<li><?php echo $this->Html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
