<div class="dashboard_index">
	<h2><?php __('Your Dashboard');?></h2>

	<div id="dashboard_links">
		<ul>
			<li>Meeting topic</li>
			<li>Files</li>
			<li>Favorites Page</li>
			<li>Accenture Contacts</li>
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
			</ul>
		</div><!--#admin_links-->
    <?php endif; ?>

	<div style="position:relative; float:right;">
		<h1>Editing this Page</h1>

		<p>To change the content of this page, create: APP/views/pages/home.ctp.<br/>
		To change its layout, create: APP/views/layouts/default.ctp.<br/>
		You can also add some CSS styles for your pages at: APP/webroot/css.</p>
	</div>
	
</div><!--.dashboard_index-->