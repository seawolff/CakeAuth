<?php
class CollateralsController extends AppController 
{
 
	var $name = 'Collaterals';
	var $components = array('RequestHandler');
 
	function beforeFilter()
	{
		parent::beforeFilter();
		
	}

	function index() 
	{	

		$this->Collateral->recursive = 0;
		$this->set('collaterals', $this->paginate());

		if ($this->Auth->user('roles') != 'admin') 
		{
			//Show only the collateral with the same group_id as the current user
			$this->set('collaterals', $this->Collateral->find('all', array('conditions' => array('group_id' => $this->Auth->user('group_id')))));
		}
		
	}

	function add() 
	{
		if ($this->Auth->user('roles') != 'admin') 
		{
			$this->redirect(array("action" => "index"));
		}
		
		if (!empty($this->data)) 
		{
			if ($this->Collateral->save($this->data)) 
			{
				$result = '<div id="output">success</div>';
				$result .= '<div id="message">Your Message</div>';
			}
			else
			{
				$result = "<div id='output'>failed</div>";
				$result .= '<div id="message">'. $this->Collateral->validationErrors['file'] .'</div>';
			}
 
			$this->RequestHandler->renderAs($this, 'ajax');
			$this->set('result', $result);
			$this->render('../elements/ajax');
		}
	}
	
	function view($id = null) 
	{
		if (!$id) 
		{
			$this->Session->setFlash(__('Invalid collateral', true));
			$this->redirect(array('action' => 'add'));
		}
		$this->set('collateral', $this->Collateral->read(null, $id));
	}
 
	function edit($id = null) 
	{
		if ($this->Auth->user('roles') != 'admin') 
		{
			$this->redirect(array("action" => "index"));
		}
		
		$this->set('groups', $this->Collateral->Group->find('list'));
		
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Invalid Collateral', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) 
		{
			if ($this->Collateral->save($this->data)) 
			{
				$this->Session->setFlash(__('The collateral has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The collateral could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) 
		{
			$this->data = $this->Collateral->read(null, $id);
		}
	}
	
}
?>