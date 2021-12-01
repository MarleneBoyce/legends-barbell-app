<?php
namespace Legends\Entity;

//MBOYCE 1L: The Workout class is a class representation of the workouts table 
class Workout {
	//MBOYCE 10L: Creating public variables 
	public $id;
	public $user_id;
	public $title;
	public $description;
	public $equipment;
	public $image;
	public $duration;
	public $video_id;
	public $created_at;
	public $updated_at;

	//MBOYCE 2L: Creating private variables 
	private $usersTable;
	private $workoutCategoryTable;

	//MBOYCE 4L: Constructor that accepts the users table and workoutCategory table 
	public function __construct(\Ninja\DatabaseTable $usersTable, \Ninja\DatabaseTable $workoutCategoryTable) {
		//MBOYCE 2L: This is assgining the arguments to the private member variables
		$this->usersTable = $usersTable;
		$this->workoutCategoryTable = $workoutCategoryTable;
	}

	//MBOYCE 6L: This function retrieves the user from the usersTable 
	public function getUser() {
		if (empty($this->user)) {
			$this->user = $this->usersTable->findById($this->user_id);
		}
		return $this->user;
	}

	//MBOYCE 4L: This function adds the category (or categories) with an associated workout
	//Once the cateogry is associated with the workout and stored in the $workoutCategory variable, then the function saves the workoutCategory
	public function addCategory($categoryId) {
		$workoutCategory = ['workout_id' => $this->id, 'category_id' => $categoryId];
		$this->workoutCategoryTable->save($workoutCategory);
	}

	//MBOYCE 8L: This function identifies if a workout has categories associated with it
	public function hasCategory($categoryId) {
		//find the categories associated with this workout_id and assign it to the $workoutCategories variable 
		$workoutCategories = $this->workoutCategoryTable->find('workout_id', $this->id);

		//Foreach workout categories, if the workoutCategory is equal to the categoryID, return true 
		foreach ($workoutCategories as $workoutCategory) {
			if ($workoutCategory->category_id == $categoryId) {
				return true;
			}
		}
	}

	//MBOYCE 3L: This function deletes categories associated with a specific workout_id 
	public function clearCategories() {
		$this->workoutCategoryTable->deleteWhere('workout_id', $this->id);
	}
}