<?php
namespace Ninja;
//MBOYCE 1L: This class is responsible for authenticating the user 
class Authentication {
	//MBOYCE 3L: Private member variables 
	private $users;
	private $usernameColumn;
	private $passwordColumn;

	//MBOYCE 6L: Constructor that accepts the Database users, usernameColumn, and passwordColumn. 
	public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn) {
		//This is assgining the arguments to the private member variables and starting the session 
		session_start();
		$this->users = $users;
		$this->usernameColumn = $usernameColumn;
		$this->passwordColumn = $passwordColumn;
	}

	//MBOYCE 10L: This function verfies the login information provided by the user 
	public function login($username, $password) {
		//Identifying the current user, finding their username, and assigning it to the variable $user
		$user = $this->users->find($this->usernameColumn, strtolower($username));

		//If the user is empty (a user is not created) OR the password is not verified, return false
		if(empty($user) || (! password_verify($password, $user[0]->{$this->passwordColumn}))) {
			return false;
		}
	
		//ELSE  determine the current sessions username, and password and return true
		session_regenerate_id();
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $user[0]->{$this->passwordColumn};

		return true;

	}

	//MBOYCE 12L: This function determines if the user is logged in 
	public function isLoggedIn() {
		//MBOYCE 3L: Checking to see if the current sessions username is empty 
		if (empty($_SESSION['username'])) {
			return false;
		}
		
		//MBOYCE 1L: ELSE find the current user's username and assign it to the variable $user 
		$user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

		//MBOYCE 6L: If the current $user is NOT empty AND the user's entered password matches the password in the table, return TRUE else return FALSE
		if (!empty($user) && $user[0]->{$this->passwordColumn} === $_SESSION['password']) {
			return true;
		}
		else {
			return false;
		}
	}
	
	//MBOYCE 8L: This function returns the current user 
	public function getUser() {
		//If there is someone logged in, return their username else, return FALSE 
		if ($this->isLoggedIn()) {
			return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
		}
		else {
			return false;
		}
	}
}