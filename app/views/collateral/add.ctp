<!--#add.ctp-->
<?php
	echo $html->script('jquery.fileUploader', false);
	echo $html->css('fileUploader', null, array(), false);
	echo $html->script('runFileUploader', false);
?>
 
<div class="galleries form">
	<h2><?php __('Upload Photo');?></h2>

	<?php
		echo $form->create('Collateral', array('type' => 'file'));
		echo $form->input('file', array('type' => 'file', 'label' => false, 'class' => 'imageUpload'));
		echo $form->end();
	?>

	<br />

	<input type="submit" value="Upload" id="pxUpload" disabled="disabled" />
	<input type="reset" value="Clear" id="pxClear" disabled="disabled" />
</div>