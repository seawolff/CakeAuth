<?php
class CollateralsController extends AppController 
{
 
	var $name = 'Collateral';
	var $components = array('RequestHandler');
 
	function add() 
	{
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
 
}
?>