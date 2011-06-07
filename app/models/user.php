<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	//normal validation
	var $validate = array(
		'name'=>array(
			'Please enter your name.'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your name.'
			)
		),
		'username'=>array(
			'The username must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'The username must be between 5 and 15 characters.'
			),
			'That username has already been taken'=>array(
				'rule'=>'isUnique',
				'message'=>'That username has already been taken.'
			)
		),
		'password'=>array(
			'The password must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'The password must be between 5 and 15 characters.'
			),
			'The passwords do not match'=>array(
				'rule'=>'matchPasswords',
				'message'=>'The passwords do not match.'
			)
		),
		'email'=>array(
			'That email has already been taken'=>array(
				'rule'=>'isUnique',
				'message'=>'That email has already been taken.'
			),
			'Please enter an email.'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter an email.'
			),
			'Please supply a valid email address' => array(
			'rule' => array('email', true),
			'message' => 'Please supply a valid email address.'
			)
		)
	);
	//used in edit action for instance '/users/edit/1'
	var $validateEdit = array(
		'name'=>array(
			'Please enter your name.'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your name.'
			)
		),
		'username'=>array(
			'The username must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'The username must be between 5 and 15 characters.'
			)
		),
		'password'=>array(
			'The password must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'The password must be between 5 and 15 characters.'
			),
			'The passwords do not match'=>array(
				'rule'=>'matchPasswords',
				'message'=>'The passwords do not match.'
			)
		),
		'email'=>array(
			'Please enter an email.'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter an email.'
			),
			'Please supply a valid email address' => array(
			'rule' => array('email', true),
			'message' => 'Please supply a valid email address.'
			)
		)
	);
	
	
	function matchPasswords($data)
	{
		if($data['password'] == $this->data['User']['password_confirmation'])
		{
			return TRUE;
		}
		$this->invalidate('password_confirmation', 'The passwords do not match');
		return FALSE;
	}

	function hashPasswords($data)
	{
		if(isset($this->data['User']['password']))
		{
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);
			return $data;
		}
		return $data;
	}
	
	function beforeSave()
	{
		$this->hashPasswords(NULL, TRUE);
		return TRUE;
	}

}
?>