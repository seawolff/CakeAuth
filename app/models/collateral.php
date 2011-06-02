<?php
class Collateral extends AppModel 
{
	var $name = 'Collateral';
	
	//media plugin behaviors
	var $actsAs = array(
		'Media.Transfer',
		'Media.Coupler',
		'Media.Generator'
	);
	
	//file validation which only allowed jpeg and png to be uploaded
	var $validate = array(
		'file' => array(
			'mimeType' => array(
				'rule' => array('checkMimeType', false, array( 'image/jpeg', 'image/png'))
			)
		)
	);
}
?>