<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Meeting Place | user driven meetings'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
  	?>
	
  <style>
    #user-nav
    {
      width:100%;
      text-align:right;
    }
  </style>

</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link(__('Meeting Place', true), array('controller' => '', 'action' => 'index')); ?></h1>
		</div>
		<div id="content">
      
      <div id="user-nav">
        <?php if($logged_in): ?>
        Welcome, <?php echo $html->link($users_username, array('controller'=>'users', 'action' => sprintf('view/%s', $users_userid) )); ?>. <?php echo $html->link('Logout', array('controller'=>'users', 'action'=>'logout')); ?>
        <?php else: ?>
          <!--<?php echo $html->link('Register', array('controller'=>'users', 'action'=>'add')); ?> or-->
          <?php echo $html->link('Login', array('controller'=>'users', 'action'=>'login')); ?>
        <?php endif; ?>
      </div>

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	<?php if($admin) echo $this->element('sql_dump'); ?>
	
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="lib/jquery.js"><\/script>')</script>

<?php  echo $scripts_for_layout; ?>
</body>
</html>
