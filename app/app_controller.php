<?php


class AppController extends Controller
{
	var $components = array("Auth", "Session");
	
	function beforeFilter()
	{		
		//$this->Auth->allow('index', 'view');
		$this->Auth->authError = 'Please login to view this page.';
		$this->Auth->loginError = 'Incorrect username/password combination.';
		$this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'index');
		$this->Auth->logoutRedirect = array("controller" => "pages", "action" => "home");
		
	    $this->set('admin', $this->_isAdmin());
	    $this->set('logged_in', $this->_loggedIn());
	    $this->set('users_username', $this->_usersUsername());
	
		$this->set('users_userid',$this->_usersUserid()); 
	}
	
	
	function _usersUserid()
	{
        $users_userid=0;
        if ($this->Auth->user())
		{
           $users_userid=$this->Auth->user('id');
        }
        return $users_userid;
	}
	
	function _isAdmin()
	{
		$admin = FALSE;
		if($this->Auth->user('roles') == 'admin')
		{
			$admin = TRUE;
		}
		return $admin;
  }

  function _loggedIn()
  {
    $logged_in = FALSE;

    if($this->Auth->user())
    {
      $logged_in = TRUE;
    }
    return $logged_in;
  }


  function _usersUsername()
  {
    $users_username = NULL;
    if($this->Auth->user())
    {
      $users_username = $this->Auth->user('username');
    }
    return $users_username;
  }

}
