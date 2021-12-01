<?php
namespace Legends\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

//MBOYCE NEW 1L: Created "WorkoutController"
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
//Interacting with the 'workoutsTable', 'usersTable','categoriesTable'and 'workoutCategory' table and returning the template are some of 
//the things that the controller is responsible for
class WorkoutController {

	//MBOYCE 5L: Private member variables 
	private $usersTable;
	private $workoutsTable;
	private $categoriesTable;
	private $workoutCategoryTable;
	private $authentication;

	//MBOYCE 8L: Constructor accepts an instance of the multiple tables and the authentication class 
	public function __construct(DatabaseTable $workoutsTable, DatabaseTable $usersTable, DatabaseTable $categoriesTable, 
	     DatabaseTable $workoutCategoryTable, Authentication $authentication) {
		//MBOYCE 5L: This is assgining the arguments to the private member variables
    	$this->workoutsTable = $workoutsTable;
		$this->usersTable = $usersTable;
		$this->categoriesTable = $categoriesTable;
		$this->workoutCategoryTable = $workoutCategoryTable;
		$this->authentication = $authentication;
	}

	//MBOYCE 1L: This function displays all the workouts
	public function list() {

		//MBOYCE 1L: If the $_GET Page ISSET, assign to the $page ELSE assign the value 1 to $page 
		$page = $_GET['page'] ?? 1;

		//MBOYCE 1L: paginate by 10 
		$perPage = 6; 
		$offset = ($page-1)*$perPage;

		//MBOYCE 5L: If the category ISSET, get the workouts within that category, and the numberofworkouts within the category 
		if (isset($_GET['category'])) {
			$category = $this->categoriesTable->findById($_GET['category']);
			$workouts = $category->getWorkouts($perPage, $offset);
			$totalWorkouts = $category->getNumberOfWorkouts();
		}
		//MBOYCE 4L: ELSE retrieve ALL workouts and display the total 
		else {
			$workouts = $this->workoutsTable->findAll('created_at DESC', $perPage, $offset);
			$totalWorkouts = $this->workoutsTable->total();
		}		
		//MBOYCE 9L: Return the following variables in an array 
		return [
			'template' => 'workouts.html.php', 
			'title' =>  'Legends Barbell - Workouts', 
			'variables' => [
				'totalWorkouts' => $totalWorkouts,
				'workouts' => $workouts,
				'categories' => $this->categoriesTable->findAll(),
				'currentPage' => $page,
				'totalPages' => ceil($totalWorkouts / $perPage),
				'categoryId' => $_GET['category'] ?? null
			]
		];
	}

	//MBOYCE 1L: Displays workouts to admin users 
	public function adminList() {
		//MBOYCE 1L: If the $_GET Page ISSET, assign to the $page ELSE assign the value 1 to $page 
		$page = $_GET['page'] ?? 1;

		//MBOYCE 1L: paginate by 10
		$perPage = 6; 
		$offset = ($page-1)*$perPage;

		//MBOYCE 1L: Authenticate the current user and assign them to $user 
		$user = $this->authentication->getUser();

		//MBOYCE 4L: If the user's role is set to "admin", find all the workouts in the table
		if($user->getRole()[0]->name === 'admin') {
			$workouts = $this->workoutsTable->findAll('created_at DESC', $perPage, $offset);
			$totalWorkouts = $this->workoutsTable->total();	
		}

		//MBOYCE 4L: If the user is not an admin, only display the workouts assigned to their userID 
		else {
			$workouts = $this->workoutsTable->find("user_id", $user->id, 'created_at DESC', $perPage, $offset);
			$totalWorkouts = $this->workoutsTable->total("user_id", $user->id);	
		}

		//MBOYCE 11L: Return the following variables in an array 
		return [
			'template' => 'admin/workouts/index.html.php', 
			'title' => 'Legends Barbell - My Workouts', 
			'variables' => [
				'totalWorkouts' => $totalWorkouts,
				'workouts' => $workouts,
				'user' => $user,
				'categories' => $this->categoriesTable->findAll(),
				//MBOYCE 2L: Assign $page to $currentPage so that the variable is availabe in the template, 
				//find the total pages by dividing the totalworkouts by $perPage (which is set to 6)
				'currentPage' => $page,
				'totalPages' => ceil($totalWorkouts / $perPage),
				'categoryId' => $_GET['category'] ?? null
			]
		];
	}
	
	//MBOYCE 1L: This funtion deletes a workout
	public function delete() {

		//MBOYCE 1L: Authenticate the current user and assign them to $user 
		$user = $this->authentication->getUser();

		//MBOYCE 1L: Assign the $_POST id to the variable $workout 
		$workout = $this->workoutsTable->findById($_POST['id']);

		//MBOYCE 3L: Check if the user that doesnt own a workout and also check that the user doesn't have the permission 
		//If this is true, return 
		if ($workout->user_id != $user->id && !$user->hasPermission('delete_workout') ) {
			return;
		}

		//MBOYCE 3L: Check if the userid assigned to the workout isn't the same as the current user, AND if the user is NOT an admin
		//if this is true, return 
		if($workout->user_id != $user->id && $user->getRole()['name'] !== 'admin') {
			return;
		}
		
		//MBOYCE 1L: Delete the workout in the categories table 
        $this->workoutCategoryTable->deleteWhere('workout_id', $_POST['id']);
		
		//MBOYCE 1L: Delete the workout in the workouts table 
		$this->workoutsTable->delete($_POST['id']); 
		
		//MBOYCE 1L: Return the user to the admin workouts page
        header('location: index.php?admin/workouts');  	

	}

	//MBOYCE 1L: This function allows users to save edits to the workout 
	public function saveEdit() {
		//MBOYCE 1L: Authenticate the current user and assign them to $user 
		$user = $this->authentication->getUser();

		//MBOYCE 2L: Assigned the $_POST workout to the variable $workout and assign the current date/time to the field 'created at' 
		$workout = $_POST['workout'];
		$workout['created_at'] = new \DateTime();

		//MBOYCE 1L: Associating the workout to the specified user
		$workoutEntity = $user->addWorkout($workout);

		//MBOYCE 1L: clearing the associated categories 
		$workoutEntity->clearCategories();

		//MBOYCE 3L: Assigning the $_POST categories to the workout
		foreach ($_POST['category'] as $categoryId) {
			$workoutEntity->addCategory($categoryId);
		}

		//MBOYCE 1L: Redirects the user to the admin workouts page
		header('location: index.php?admin/workouts'); 

	}

	//MBOYCE 1L: This function allows users to edit workouts 
	public function edit() {

		//MBOYCE 1L: Authenticates the current user and assigns them to $user
		$user = $this->authentication->getUser();

		//MBOYCE 1L: Find all the categories within the categories table
		$categories = $this->categoriesTable->findAll();

		//MBOYCE 3L: If the ID ISSET, find the workout associated with that ID 
		if (isset($_GET['id'])) {
			$workout = $this->workoutsTable->findById($_GET['id']);
		}

		//MBOYCE 9L: Return the following variables in an array 
		return [
			'template' => 'admin/workouts/edit.html.php',
			'title' => 'Edit workout',
			'variables' => [
				'workout' => $workout ?? null,
				'user' => $user,
				'categories' => $categories
			]
		];
	}
	
}