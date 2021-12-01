<?php
namespace Ninja;

//
class EntryPoint {
	//Declaring private member variables 
	private $route;
	private $method;
	private $routes;

	//The constructor is accepting the $route, $method, and instaniated routes class as it's arguements 
	public function __construct(string $route, string $method, \Ninja\Routes $routes) {
		//Assigning the arguments passed to the private member variables 
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
		//run the CheckUrl function 
		$this->checkUrl();
	}

	//MBOYCE 6L: If the route is not in lowercase, display a 301 response code and redirect the lowercase value of the route 
	private function checkUrl() {
		if ($this->route !== strtolower($this->route)) {
			//this response code permanently redirects to the lowercase version of the URL 
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}


	//MBOYCE 6L: LoadTemplate is passing the file name and variables 
	private function loadTemplate($templateFileName, $variables = []) {
		//Extracting variable array into individual variables 
		extract($variables);

		//Starting the output buffer
		ob_start();
		//Including the templates passed into the function 
		include  __DIR__ . '/../../templates/' . $templateFileName;

		//and clearing the output buffer 
		return ob_get_clean();
	}

	// this processes the requests and calls the appropriate controller action
	// to either redirect or return a layout wrapped page.
	public function run() {

		// Gets Route and controller Mappings
		$routes = $this->routes->getRoutes();

		// Get Authenticated User Info
		$authentication = $this->routes->getAuthentication();

		// Check if User is Authenticated and show an error if not
		if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
			header('location: index.php?login/error');   
		}

		// Identifying what permissions are required, and checking if user Has specific permissions
		if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
			header('location: index.php?login/permissionserror');
		}

		//Identifying the assigned controller and storing it in the variable $controller
		$controller = $routes[$this->route][$this->method]['controller'];
		
		//Identifying the assigned action and storing it in the variable $action
		$action = $routes[$this->route][$this->method]['action'];
		
		//Calling the action of the controller, and storing the resulting array in the $page variable 
		$page = $controller->$action();

		//This is loading the layout templage and passing the following variables
		echo $this->loadTemplate('layout.html.php', [
			'loggedIn' => $authentication->isLoggedIn(), //This returns if the user is logged in 
			'user' => $authentication->getUser() ?? null, //If the user is logged in, their information is retrieved, else it's null
			'output' =>  $this->loadTemplate($page['template'], $page['variables'] ?? []), //This loads the sub-template and the array of variables
			'title' => $page['title'] , //This retrieves the page title 
		]);
	}
}