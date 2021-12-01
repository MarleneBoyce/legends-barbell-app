<?php
namespace Legends\Controllers;

//MBOYCE NEW 1L: Created 'LoginController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
class LoginController {
	//MBOYCE 1L: Private member variable 
	private $authentication;

	//MBOYCE 3L: Constructor accepts the authentication class
	public function __construct(\Ninja\Authentication $authentication) {
		//MBOYCE 1L: This is assgining the argument to the private member variable
		$this->authentication = $authentication;
	}

	//MBOYCE 3L: This function returns the login template in an array
	public function loginForm() {
		return ['template' => 'auth/login.html.php', 'title' => 'Log In'];
	}

	//MBOYCE 14L: This function processes the login for the user (delegating to the authentication class)
	public function processLogin() {
		//If the user's email and password can be authenticated, then direct the user to the login success page
		if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('Location: index.php?login/success'); 
		}
		//ELSE keep them on the login page and display the error
		else {
			return [
				'template' => 'auth/login.html.php',
				'title' => 'Log In',
				'variables' => [
					'error' => 'Invalid username/password.'
				]
			];
		}
	}

	//MBOYCE 3L: If the user is successfully logged in, redirect them to the Login success page
	public function success() {
		return ['template' => 'auth/loginsuccess.html.php', 'title' => 'Login Successful'];
	}

	//MBOYCE 3L: If the user can not be logged in, direct them to the loginerror page 
	public function error() {
		return ['template' => 'auth/loginerror.html.php', 'title' => 'You are not logged in'];
	}

	//MBOYCE 3L: If a user is trying to access a page they don't have permissions for, dipslay the permission's error page 
	public function permissionsError() {
		return ['template' => 'auth/permissionserror.html.php', 'title' => 'Access Denied'];
	}

	//MBOYCE 3L: This function logs out the user 
	public function logout() {
		//MBOYCE 1L: Unsets the global session variable 
		unset($_SESSION);
		//MBOYCE 1L: Destroys the current session 
		session_destroy();
		//MBOYCE 1L: Redirects user to the 
		return ['template' => 'auth/logout.html.php', 'title' => 'You have been logged out'];
	}
}
