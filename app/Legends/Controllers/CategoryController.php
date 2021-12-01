<?php
namespace Legends\Controllers;

use Ninja\Authentication;

//MBOYCE MOD 1L: Changed Category to 'CategoryController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
//Interacting with an instance of the 'categoriesTable' and returning the template are some of the things that the controller is responsible for
class CategoryController {
	//MBOYCE MOD 2L - Changd private varibles to categoriesTable and workoutCategoryTable
	private $categoriesTable;
    private $workoutCategoryTable; 
	
	//MBoyce MOD 5L - Constructor accepting the categories table, workout table, and authentication 
	public function __construct(\Ninja\DatabaseTable $categoriesTable, \Ninja\DatabaseTable $workoutCategoryTable, Authentication $authentication) { 
		//MBOYCE 3L: This is assgining the arguments to the private member variables 
		$this->categoriesTable = $categoriesTable;
		$this->workoutCategoryTable = $workoutCategoryTable; 
		$this->authentication = $authentication;
	}

	//MBoyce NEW 14L: Created a function 'edit' so authorized users can edit the category name. 
	public function edit() {

		if (isset($_GET['id'])) {
			$category = $this->categoriesTable->findById($_GET['id']);
		}

		//MBOYCE 1L: Getting user information to ensure they are authorized to make this change 
		$user = $this->authentication->getUser();

		return [
			'template' => 'admin/categories/edit.html.php',
			'title' => 'Edit Category',
			'variables' => [
				'user' => $user,
				'category' => $category ?? null
			]
		];
	}

	//MBoyce MOD 5L: saveEdit so users changes to the category will be saved to the database 
	public function saveEdit() {
		$category = $_POST['category'];

		$this->categoriesTable->save($category);
		
		header('location: index.php?admin/categories');   
	}

	//MBoyce MOD 9L: When logged-in users click "Categories", this list function displays all the categories within the database 
	public function list() {
		return [
			'template' => 'admin/categories/index.html.php', 
			'title' => 'Legends Barbell - Workout Categories', 
			'variables' => [
			    'categories' => $this->categoriesTable->findAll()
			]
		];
	}
	
	//MBoyce MOD 7L: When logged-in users click "delete" this function deletes the specific category from the database
	public function delete() {
		$this->workoutCategoryTable->delete($_POST['id']);

		$this->categoriesTable->delete($_POST['id']); 
		
		header('location: index.php?admin/categories');  
	}
}