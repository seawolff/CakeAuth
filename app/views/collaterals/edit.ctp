<div class="collaterals form">
<?php echo $this->Form->create('Collateral');?>
	<fieldset>
		<legend><?php __('Edit Collateral'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('basename');
		echo $this->Form->input('dirname');
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Collateral.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Collateral.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Collaterals', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>