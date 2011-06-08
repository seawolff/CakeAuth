<div class="dashboard_index">
	<h2><?php __('Your Dashboard');?></h2>

	<div id="dashboard_links">
		<ul>
			<li>Meeting topic</li>
			<li><?php echo $this->Html->link(__('Files', true), array('controller' => 'Collaterals', 'action' => 'index')); ?></li>
			<li>Favorited Files</li>
			<li>Contacts</li>
			<li><?php echo $this->Html->link(__('Notes', true), array('controller' => 'Posts', 'action' => 'index'));?></li>
			<li>Twitter</li>
		<ul>
	</div><!--#dashboard_links-->
	
	<?php if($admin): ?>
		<div id="admin_links">
			<h2>Admin Links</h2>
			<ul>
		      	<li><?php echo $this->Html->link(__('Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('Add User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('Add Files', true), array('controller' => 'collaterals', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('Add Groups', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
			</ul>
		</div><!--#admin_links-->
    <?php endif; ?>
	
</div><!--.dashboard_index-->