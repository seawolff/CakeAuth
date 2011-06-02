<div class="users form">
	<h2><?php __('User Registration'); ?></h2>
	<?php echo $session->flash('auth'); ?>
	
	<div>
	    <h3>Update your details</h3>
		<div>
			<span style="float:right"><?php $session->flash(); ?></span>
			<p>Update your information below. Once you are done - click the <strong>register</strong> button.</p>
			<div style="clear: both; margin-top: 30px">
			<?php 
				echo $form->create('User', array('url' => 'register/'.$email.'/'.$ttime.'/'.$hash.'/') ); 
			?>
				<div style="float: left">
				
	                <b>Create password (your email is <u><?php echo $email;?></u> )</b>
					<br/><br/>
					<?php echo $form->input('password'); ?>
					<br/><br/>
					<span style="float:left">
						<?php echo $form->input('password_confirmation', array('type'=>'password')); ?>
					</span>

					<?php echo $this->Form->end(__('Submit', true));?>
	        	</div>
			</div>
		</div>
	</div>
</div>


