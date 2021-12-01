<?php
namespace Legends\Entity;

use Ninja\DatabaseTable;

//MBOYCE 1L: The category class is a class representation of the categories table 
class Category {
	//MBOYCE 4L: Assigning public and private variables 
	public $id;
	public $name;
	private $workoutsTable;
	private $workoutCategoryTable;

	//MBOYCE 4L: Constructor that accepts an instance of the workouts and workoutCategory table 
	public function __construct(DatabaseTable $workoutsTable, DatabaseTable $workoutCategoryTable) {
		//MBOYCE 2L: This is assgining the arguments to the private member variables
		$this->workoutsTable = $workoutsTable;
		$this->workoutCategoryTable = $workoutCategoryTable;
	}

	//MBOYCE 1L: This function retrieves the workouts in the workoutsTable 
	public function getWorkouts($limit = null, $offset = null) {
		//MBOYCE 1L: This is retrieving all the categories in the workoutCategory table
		$workoutCategories = $this->workoutCategoryTable->find('category_id', $this->id, null, $limit, $offset);
      
		//MBOYCE 1L: Assiging $workouts to an empty array 
		$workouts = [];

		//MBOYCE 2L: Foreach workout categories found, find the workouts associated with that category, and assign it to the variable $workout 
		foreach ($workoutCategories as $workoutCategory) {
			$workout =  $this->workoutsTable->findById($workoutCategory->workout_id);
			
			//MBOYCE 3L: If workouts are found, store it in an array 
			if ($workout) {
				$workouts[] = $workout;
			}			
		}

		//MBOYCE 1L: Sorting the workouts based on date / time 
		usort($workouts, [$this, 'sortWorkouts']);

		//MBOYCE 1L: Return all the workouts 
		return $workouts;
	}

	//MBOYCE 3L: This function gets the number of workouts 
	public function getNumberOfWorkouts() {
		return $this->workoutCategoryTable->total('category_id', $this->id);
	}

	//MBOYCE 8L: This function sorts the workouts 
	private function sortWorkouts($a, $b) {
		$aDate = new \DateTime($a->created_at);
		$bDate = new \DateTime($b->created_at);

		if ($aDate->getTimestamp() == $bDate->getTimestamp()) {
			return 0;
		}

		return $aDate->getTimestamp() < $bDate->getTimestamp() ? -1 : 1;
	}
}