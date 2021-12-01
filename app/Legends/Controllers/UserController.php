<?php
namespace Legends\Controllers;
use \Legends\Entity\User;
use \Ninja\DatabaseTable;
use Ninja\Authentication;
use Legends\Entity\Permission;

//MBOYCE NEW 1L: Created 'UserController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
class UserController {
	//Mboyce 1L: Private member variable 
	private $usersTable;

	//MBOYCE 4L: Constructor accepts an instance of the usersTable, and the authentication class 
	public function __construct(DatabaseTable $usersTable, Authentication $authentication) {
		$this->usersTable = $usersTable;
		$this->authentication = $authentication;
	}

	//MBOYCE 9L: This function displays all the users in the table, and returns the template for the specified page 
	public function list() {
		$users = $this->usersTable->findAll();

		return ['template' => 'admin/users/index.html.php',
				'title' => 'user List',
				'variables' => [
						'users' => $users
					]
				];
	}

	//MBOYCE 12L: This function allows the current user to edit other users if they have the correct permissions 
	public function edit() {

		//MBOYCE 1L: Check if the user ID is set, OR find the user by their ID and set it to the $user variable 
		$user = isset($_GET['id']) ? $this->usersTable->findById($_GET['id']) : null;

		//MBOYCE 9L: Return the edit template in an array, and passing in all the variables i.e user, loggedInUser, and all permissions
		return [
			'template' => 'admin/users/edit.html.php',
			'title' => 'Edit User',
			'variables' => [
				'user' => $user,
				'loggedInUser' => $this->authentication->getUser(),
				'permissions' => Permission::all()
			]
		];	
	}

	//MBOYCE 10L: This function allows the edits to be saved 
	public function saveEdit() {

		//MBOYCE 3L: Merging the arrays; Retrieve the posted user, the ID, and the set permissions and set them to the variable $user 
		//Using json_encode to transform an array into a json string to store in the database 
		$user = array_merge($_POST['user'], [ 'id' => $_GET['id'] ], [
			'permissions' =>  json_encode($_POST['permissions'] ?? [])
		]);

		//MBOYCE 3L: If the password is set, hash the password for security purposes 
		if(isset($user['password'])) {
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
		}

		//1L: Save the user information into the usersTable 
		$this->usersTable->save($user);
		
		//MBOYCE 1L: Return to the admin users page 
		header('location: index.php?admin/users');    
	}

	//MBOYCE 4L: This function allows users to delete other users
	public function delete() {
		$this->usersTable->delete($_POST['id']);
		
		//MBOYCE 1L: Returns users to admin/users page 
		header('location: index.php?admin/users');  
	}
}