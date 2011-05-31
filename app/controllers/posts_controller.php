<?php
class PostsController extends AppController {

	var $name = 'Posts';

	
	function beforeFilter()
	{
		parent::beforeFilter();
	}


	function index() 
	{	

		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
		
		//set so the user can only see their own posts
		if ($this->Auth->user('roles') != 'admin') 
		{
			$this->set('posts', $this->Post->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')))));
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() 
	{	
		if (!empty($this->data)) 
		{
			$this->Post->create();
			if ($this->Post->save($this->data)) 
			{
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) 
	{	
		//check Post.user_id against session User.id to prevent editing posts not posted by the current user
		$post = $this->Post->find('first', array(
		        'conditions' => array('Post.id' => $id, 'Post.user_id' => $this->Auth->user('id')),
		        'recursive'  => -1
		    ));
	    if (!$post) 
		{
			if ($this->Auth->user('roles') != 'admin') 
			{
	        	//$this->cakeError('error404');
				$this->Session->setFlash(__('You do no have the ability to edit this post.', true));
				$this->redirect(array('action' => 'index'));
			}
			
	    }
	
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) 
		{
			if ($this->Post->save($this->data)) 
			{
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) 
	{
		//check Post.user_id against session User.id to prevent deleting posts not posted by the current user
		$post = $this->Post->find('first', array(
		        'conditions' => array('Post.id' => $id, 'Post.user_id' => $this->Auth->user('id')),
		        'recursive'  => -1
		    ));
	    if (!$post) 
		{
			if ($this->Auth->user('roles') != 'admin') 
			{
	        	//$this->cakeError('error404');
				$this->Session->setFlash(__('You do no have the ability to delete this post.', true));
				$this->redirect(array('action' => 'index'));
			}
			
	    }
		
		if (!$id) 
		{
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Post was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Post was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>