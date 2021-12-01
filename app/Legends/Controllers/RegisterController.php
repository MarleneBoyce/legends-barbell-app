<?php
namespace Legends\Controllers;

use Legends\Entity\Permission;
use \Ninja\DatabaseTable;
use \Legends\Entity\User;

//MBOYCE NEW 1L: Created 'RegisterController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
class RegisterController {
	//MBOYCE 1L: Private member variable 
	private $usersTable;
	

	//MBOYCE 3L: Constructer accepts the usersTable
	public function __construct(DatabaseTable $usersTable) {
		//MBOYCE 1L: This is assgining the argument to the private member variable
		$this->usersTable = $usersTable;
	}

	//MBOYCE 6L: This function returns the registration page template in an array 
	public function registrationForm() {
		return [
			'template' => 'auth/register.html.php', 
			'title' => 'Register an account'
		];
	}

	//MBOYCE 6L: If the regristration is successful, this function returns to user to the registersuccess template 
	public function success() {
		return [
			'template' => 'auth/registersuccess.html.php', 
			'title' => 'Registration Successful
		'];
	}

	//MBOYCE 73L: This function registers the user 
	public function registerUser() {
		//MBOYCE 1L: The $user variable is equal the the value collected from the registration form with method="post". 
		$user = $_POST['user'];

		//MBOYCE 2L: $valid is set to true, and $errors is set to an empty array
		$valid = true;
		$errors = [];

		//MBOYCE 4L: If the first_name field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($user['first_name'])) {
			$valid = false;
			$errors[] = 'First Name cannot be blank';
		}
		//MBOYCE 4L: If the last_name field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($user['last_name'])) {
			$valid = false;
			$errors[] = 'Last Name cannot be blank';
		}
		//MBOYCE 4L: If the email field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($user['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		//MBOYCE 6L: If the email is not left blank, the email will be validated to ensure it's in the correct format, if it is not an error message will be stored
		//in the error array ELSE the email will be stored to the user's email 
		else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}
		else { 
			$user['email'] = strtolower($user['email']);

			//MBOYCE 5L: If the entered email is already in the usersTable, $valid will be set to false and the error will be stored in the errors array 
			if (count($this->usersTable->find('email', $user['email'])) > 0) {
				$valid = false;
				$errors[] = 'That email address is already registered';
			}
		}


		//MBOYCE 4L: If the password field is left base, $valid will be set to false and the error message will be stored in the error array 
		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		//MBOYCE 1L: If the $valid variable is set to true, (meaning there are no errors) then the following will occur 
		if ($valid == true) {
			
			//MBOYCE 1L: The password entered will be hashed for security purposes 
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

			//MBOYCE 1L: The user's role id will be set to 2, meaning they will be automatically be assigned the "instructor" role 
			$user['role_id'] = 2;

			//MBOYCE 5L: The user will have limited permissions set when they register 
			//These permissions allow new users to view, create, edit, and delete their OWN workouts
			$user['permissions'] = json_encode(Permission::instructorPermissions());

			//MBOYCE 1L: Once the information is validated, the user is saved to the usersTable 
			$this->usersTable->save($user);

			//MBOYCE 1L: This will return the user to the login page so they can now log in
            header('Location: index.php?login'); 

		}
		else {
			//MBOYCE 9L: If errors are present, remain on (or return) the register page and display the errors 
			return [
				'template' => 'auth/register.html.php', 
				'title' => 'Register an account',
				'variables' => [
					'errors' => $errors,
					'user' => $user
				]
			]; 
		}
	}
}