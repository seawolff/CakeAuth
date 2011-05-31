<?php
class Post extends AppModel {
	var $name = 'Post';
	
	var $currentUsrId = NULL;
	
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	function own($id) 
	{
	    App::import('Component', 'Session');
	    $Session = new SessionComponent();
	    $user = $Session->read('Auth.User');//User or Admin or 
	    $this->contain();
	    $review = $this->find('first', array(
	        'conditions' => array(
	            'Post.id' => $id,
	            'Post.user_id' => $user['id']
	        )
	    ));
	    return $review;
	}

}
?>