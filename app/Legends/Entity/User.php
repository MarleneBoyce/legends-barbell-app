<?php
namespace Legends\Entity;

//MBOYCE 1L: The User class is a class representation of the users table 
class User {
	//MBOYCE 9L: Public variables 
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	public $role_id;
	public $permissions;
	public $updated_at;
	public $created_at;

	//MBOYCE 1L: Private variable 
	private $workoutsTable;
	private $rolesTable; 

	//MBOYCE 4L: Constructor that accepts the workouts table and roles table 
	public function __construct(\Ninja\DatabaseTable $workoutsTable, \Ninja\DatabaseTable $rolesTable) {
		//MBOYCE 2L: This is assgining the arguments to the private member variables
		$this->workoutsTable = $workoutsTable;
		$this->rolesTable = $rolesTable;
	}

	//MBOYCE 3L: This function returns workouts associated with the specified user_id 
	public function getWorkouts() {
		return $this->workoutsTable->find('user_id', $this->id);
	}

	//MBOYCE 3L: This function returns the role associated with the role_id
	public function getRole() {
		return $this->rolesTable->find('id', $this->role_id);
	}

	//MBOYCE 4L: This function associates the workout to the user_id and saves the workout to the workouts table 
	public function addWorkout($workout) {
		$workout['user_id'] = $this->id;

		return $this->workoutsTable->save($workout);
	}

	//MBOYCE 3L: This function json_decodes the permissions stored in the database 
	public function getPermissions() {
		return json_decode($this->permissions, true);
	}

	//MBOYCE 3L: This function checks if the permissions are within the array of permissions the user has
	public function hasPermission($permission) {
		return in_array($permission, $this->getPermissions());  
	}
}