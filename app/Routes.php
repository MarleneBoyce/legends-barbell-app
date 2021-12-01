<?php

//MBOYCE 1L: Creating a new routes class that adheres to \Ninja\Routes contract ie. the three methods specified MUST be implemented 
class Routes implements \Ninja\Routes {

	//MBOYCE 10L: Setting private member variables 
	private $usersTable;
	private $workoutsTable;
	private $categoriesTable;
	private $workoutCategoryTable;
	private $authentication;
	private $pagesController; 
	private $registerController; 
	private $userController; 
	private $loginController; 
	private $categoryController; 


	//MBOYCE 1L: Constructor 
	public function __construct() {

		//MBOYCE 1L: Including database connnection 
		include __DIR__ . './DatabaseConnection.php';

		//MBOYCE 1L: Pointing to the workouts table and creating a new instance of the workouts table -- passing related tables 
		$this->workoutsTable = new \Ninja\DatabaseTable($pdo, 'workouts', 'id', '\Legends\Entity\Workout', [&$this->usersTable, &$this->workoutCategoryTable]);
 		
		//MBOYCE 1L: Pointing to the users table and creating a new instance of the users table -- passing related tables 
		$this->usersTable = new \Ninja\DatabaseTable($pdo, 'users', 'id', '\Legends\Entity\User', [&$this->workoutsTable, &$this->rolesTable]);
 		
		//MBOYCE 1L: Pointing to the categories table and creating a new instance of the categories table -- passing related tables 
		$this->categoriesTable = new \Ninja\DatabaseTable($pdo, 'categories', 'id', '\Legends\Entity\Category', [&$this->workoutsTable, &$this->workoutCategoryTable]);
 		
		//MBOYCE 1L: Pointing to the workout_category table and creating a new instance of the workout_category table 
		$this->workoutCategoryTable = new \Ninja\DatabaseTable($pdo, 'workout_category', 'category_id');
		
		//MBOYCE 1L: Pointing to the roles table and creating a new instance of the roles table 
		$this->rolesTable = new \Ninja\DatabaseTable($pdo, 'roles', 'id' );

		//MBOYCE 1L: Pointing to the contacts table and creating a new instance of the contacts table  
		$this->contactsTable = new \Ninja\DatabaseTable ($pdo, 'contacts', 'id', '\Legends\Entity\Contact');

		//MBOYCE 1L: Creating a new instance of the Authentication class 
		$this->authentication = new \Ninja\Authentication($this->usersTable, 'email', 'password');

		//MBOYCE 4L: Creating an instance of the workout controller and passing related tables along with the authentication class 
		$this->workoutController = new \Legends\Controllers\WorkoutController(
			$this->workoutsTable, $this->usersTable, $this->categoriesTable, 
            $this->workoutCategoryTable, $this->authentication
		);
		//MBOYCE 1L: Creating a new instance of the contact controller  
		$this->contactController = new \Legends\Controllers\ContactController($this->contactsTable);
		//MBOYCE 1L: Creating a new instance of the pages controller  
		$this->pagesController = new \Legends\Controllers\PagesController();
		//MBOYCE 1L: Creating a new instance of the register controller
		$this->registerController = new \Legends\Controllers\RegisterController($this->usersTable, $this->authentication);
		//MBOYCE 1L: Creating a new instance of the user controller
		$this->userController = new \Legends\Controllers\UserController($this->usersTable, $this->authentication);
		//MBOYCE 1L: Creating a new instance of the login controller 
		$this->loginController = new \Legends\Controllers\LoginController($this->authentication);
		//MBOYCE 1L: Creating a new instance of the category controller
        $this->categoryController = new \Legends\Controllers\CategoryController($this->categoriesTable, $this->workoutCategoryTable, $this->authentication); 
	}

	//MBOYCE 3L: This function merges 3 different route definitions 
	public function getRoutes(): array {

		return array_merge($this->authRoutes(), $this->pageRoutes(), $this->adminRoutes());
	}

	//MBOYCE 3L: This function gets the authentication from the authentication class 
	public function getAuthentication(): \Ninja\Authentication {   
		return $this->authentication;
	}

	//MBOYCE 4L: This function checks the user's permission for a specific action 
	public function checkPermission($permission): bool {
		$user = $this->authentication->getUser();
		return ($user && $user->hasPermission($permission));
	}

	//MBOYCE MOD Routes were split into AdminRoutes / AuthRoutes, and pageRoutes 
	//I decided this was a more logical / organized way to define the different routes 

	//MBOYCE 1L: AdminRoutes deals with all private pages, and returns an array of all Admin routes 
	public function adminRoutes() {
		return [
			'admin/workouts' => [
				'GET' => [
					'controller' => $this->workoutController,
					'action' => 'adminList'
				],
				'login' => true,
			],
			'admin/workouts/edit' => [
				'POST' => [
					'controller' => $this->workoutController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $this->workoutController,
					'action' => 'edit'
				],
				'login' => true,
				'permissions' => 'edit_workout' 
			],
			'admin/workouts/delete' => [
				'POST' => [
					'controller' => $this->workoutController,
					'action' => 'delete'
				],
				'login' => true,
				'permissions' => 'delete_workout' 
			],
			'admin/users' => [
				'GET' => [
					'controller' => $this->userController,
					'action' => 'list'
				],
				'login' => true,
				'permissions' => 'edit_user'
			],
			'admin/user/edit' => [
				'GET' => [
					'controller' => $this->userController,
					'action' => 'edit'
				],
				'POST' => [
					'controller' => $this->userController,
					'action' => 'saveEdit'
				],
				'login' => true,
				'permissions' => 'edit_user' 
			],
			'admin/user/delete' => [
				'POST' => [
					'controller' => $this->userController,
					'action' => 'delete'
				],
				'login' => true,
				'permissions' => 'delete_user'
			],
			
			'admin/categories/edit' => [
				'POST' => [
					'controller' => $this->categoryController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $this->categoryController,
					'action' => 'edit'
				],
				'login' => true,
				'permissions' => 'edit_category'
			],
			'admin/categories/delete' => [
				'POST' => [
					'controller' => $this->categoryController,
					'action' => 'delete'
				],
				'login' => true,
				'permissions' => 'delete_category'
			],
			'admin/categories' => [
				'GET' => [
					'controller' => $this->categoryController,
					'action' => 'list'
				],
				'login' => true,
				'permissions' => 'edit_category'
			],
			'admin/contacts' => [
				'GET' => [
					'controller' => $this->contactController,
					'action' => 'list'
				],
				'login' => true,
				'permissions' => 'view_messages'
			],
			'admin/contact/delete' => [
				'POST' => [
					'controller' => $this->contactController,
					'action' => 'delete'
				],
				'login' => true,
				'permissions' => 'delete_messages'
			],
		];
	}

	//MBOYCE 1L: authRoutes deal with all authentication pages i.e registration / logging in 
	//and returns an array of all authentication related routes 
	public function authRoutes() {
		return  [
			'register' => [
				'GET' => [
					'controller' => $this->registerController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $this->registerController,
					'action' => 'registerUser'
				]
			],
			'login/error' => [
				'GET' => [
					'controller' => $this->loginController,
					'action' => 'error'
				]
			],
			'login/permissionserror' => [
				'GET' => [
					'controller' => $this->loginController,
					'action' => 'permissionsError'
				]
			],
			'login/success' => [
				'GET' => [
					'controller' => $this->loginController,
					'action' => 'success'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $this->loginController,
					'action' => 'logout'
				]
			],
			'login' => [
				'GET' => [
					'controller' => $this->loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $this->loginController,
					'action' => 'processLogin'
				]
			],
		];
	}

	//MBOYCE 1L: pageRoutes deals with all public pages on the website 
	//and returns an array of all public page routes 
	public function pageRoutes() {
		return [
		
			'workouts' => [
				'GET' => [
					'controller' => $this->workoutController,
					'action' => 'list'
				]
			],
			
			'contact' => [
				'GET' => [
					'controller' => $this->contactController,
					'action' => 'contact'
				],
				'POST' => [
					'controller' => $this->contactController,
					'action' => 'saveContact'
				]
			],
			'schedule' => [
				'GET' => [
					'controller' => $this->pagesController,
					'action' => 'schedule'
				]
			],
			'about' => [
				'GET' => [
					'controller' => $this->pagesController,
					'action' => 'about'
				]
			],
			'' => [
				'GET' => [
					'controller' => $this->pagesController,
					'action' => 'home'
				]
			]
		];
	}

}