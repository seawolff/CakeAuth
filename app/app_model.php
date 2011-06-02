<?php
class AppModel extends Model 
{
	var $name = 'App_model';
	
	//used for custom validation see:http://snook.ca/archives/cakephp/multiple_validation_sets_cakephp/
	function validates($options = array()) 
	{
	    // copy the data over from a custom var, otherwise
	    $actionSet = 'validate' . Inflector::camelize(Router::getParam('action'));
	    if (isset($this->validationSet)) 
		{
	        $temp = $this->validate;
	        $param = 'validate' . $validationSet;
	        $this->validate = $this->{$param};
	    } 
		elseif (isset($this->{$actionSet})) 
		{
	        $temp = $this->validate;
	        $param = $actionSet;
	        $this->validate = $this->{$param};
	    } 

	    $errors = $this->invalidFields($options);

	    // copy it back
	    if (isset($temp)) 
		{
	        $this->validate = $temp;
	        unset($this->validationSet);
	    }

	    if (is_array($errors)) 
		{
	        return count($errors) === 0;
	    }
	    return $errors;
	}
}
?>