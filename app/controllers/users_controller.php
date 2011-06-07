<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('N', 'Email', 'Otp');
	
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow("add", "register");
		
		if($this->action == 'add' || $this->action == 'edit')
		{
			$this->Auth->authenticate = $this->User;
		}
		
	}

	function login()
	{
		
	}
	
	function logout()
	{
		$this->redirect($this->Auth->logout());
	}

	function index() 
	{
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		
		//Redirect user off of users index page unless that user is an admin
	    if ($this->Auth->user('roles') != 'admin') 
		{
			//$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array("controller" => "posts", "action" => "index"));
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() 
	{
		$this->set('groups', $this->User->Group->find('list'));
	    
		
		if (!empty($this->data)) 
		{
			//get username
            $username = $this->data["User"]["username"];
            $user = $this->User->FindByUsername($username);
			
			//get entered password
			$password = $this->data["User"]["password"];
			//echo $password;
			
			//get entered email
			$email = $this->data["User"]["email"];
			//echo $email;
			
				$this->User->create();
                if ($this->User->save($this->data)) 
				{
                    $user = array(
                                'User' => array(
                                'password' => $password,
                                'username' =>$username,
								'email' => $email,
                                ),

                            );
                            
                            //$this->User->save($this->data);

                    // setup the TIME TO LIVE (valid until date) for the next two days
                    $now = microtime(true);
                    $ttl =$now + 48*3600; // the invitation is good for the next two days

                    // create the OTP - TTL = time to live
                    $otp = $this->Otp->createOTP(array('user'=>$username,'password'=>$password, 'email'=>$email, 'ttl'=> $ttl) );

                    $link = '<a href="http://' . $_SERVER['SERVER_NAME'] . Dispatcher::baseUrl()."/users/register/".$email."/".$ttl."/".$otp.'"> Registration link</a>';
                     // send mail
                    $this->Email->from    = "register@auth.com";
                    $this->Email->to      = $email;

                    $this->Email->subject = "Your Account Activation";
                    $this->Email->sendAs = 'html';


                    $body = "Please use the following link to activate your account:<br>";
                    $body .= $link;

                    $this->Email->send($body);
                    $this->Session->setFlash("Please check your email for a confirmation");
                    $this->redirect("/");
                }
				else
				{
                   $this->Session->setFlash("This user is already in the system, please try another email");

                }

        }
		
		/*if (!empty($this->data)) 
		{
			$this->User->create();
			
			if ($this->User->save($this->data)) 
			{
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}*/
	}

	function register($email,$ttl,$otp) 
	{

	            $user = $this->User->findByEmail($email);
				
                if($user)
				{
                    $passwordHash = $user["User"]["password"];

                    $now = microtime(true);
                    // check expiration date. the experation date should be greater them now.

                    if($now <  $ttl)
					{
						
                        // validate OTP
                        //if($this->Otp->authenticateOTP($otp, array('user'=>$email,'password'=>$passwordHash,'ttl'=> $ttl)) )
						//{
						$isActive = $user["User"]["active"];
						//echo $isActive;
						
						if($isActive == 0)
						{
							
							   $this->Otp->authenticateOTP($otp, array('user'=>$email,'password'=>$passwordHash,'ttl'=> $ttl));
							
                               if (!empty($this->data)) 
							   {
                                   // activate the account by setting the password
                                   $password = $this->data["User"]["password"];
                                   $this->User->id =  $user["User"]["id"];
							   
								   if ($this->User->save($this->data)) 
								   {
										//make user active
										$isActive = 1;
										$this->User->saveField('active', $isActive);
									
									   //$this->User->save($this->data);   //$this->User->save('password',   $this->Auth->password($password));
	                                   $this->Session->setFlash( 'Password Changed');
	                                   $this->redirect(array('action' => 'login'));
								   }
								   else 
								   {
										$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
								   }

                               }
							   else 
							   {
									$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
							   }
							
                               $this->set('email', $email);
                               $this->set('ttime', $ttl);
                               $this->set('hash', $otp);

                        }
						else
						{
                            $this->Session->setFlash("Invalid request.");
                            // send to a error view
                            $this->redirect(array('action' => 'login'));

                        }
                    }
					else
					{
                        $this->Session->setFlash("Your invitation has expired.");
                        // send to a error view
                       $this->redirect(array('action' => 'login'));
                    }
                }
				else
				{
					 $this->Session->setFlash("Invalid request.");
					$this->redirect(array('action' => 'login'));
				}

    }
	

	function edit($id = null) 
	{	
		
		if (!$id && empty($this->data)) 
		{
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) 
		{
			//used for custom validation override
			$this->User->set($this->data);
			if ($this->User->validates())  //if ($this->User->save($this->data)) 
			{
				$this->User->save($this->data);
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) 
		{
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
