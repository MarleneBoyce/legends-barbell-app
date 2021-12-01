<?php
try {
	//MBOYCE 1L: Bootstrap our autoloader so we can find classes in our project easily
	include __DIR__ . '/../bootstrap/autoload.php';

	//MBOYCE 4L:  Created a global debug function that can be called from anywhere in the code
	function debug(...$args) {
	 	var_dump(...$args);
		die();
	}

	//MBOYCE 1L: Removes the ? 
	$routeWithoutQueryString = strtok($_SERVER['REQUEST_URI'], '?');
	
	//MBOYCE 1L: Left trims the / 
	$route = ltrim($routeWithoutQueryString, '/');

	//MBOYCE 3L: If the URI just has a /, the user is at the home page, else it's at the specified query location
	function isHomePage($route) {
		return $route == ltrim($_SERVER['REQUEST_URI'],  '/');
	}

	if ( isHomePage($route) ) {
		$route = ''; 	  
	}  
	else {
	    $route = $_SERVER['QUERY_STRING'];
	}


	  //5/22/18 JG NEW 6l: adapter to the code b/c of the .htaccess is ignored by apache
	  //Determine if there is a second ?
	if (strlen(strtok($route, '?')) <  strlen($route))  
	{ 

		if (strpos($route, 'id')){ // Is there an id after the question mark, if so set the id into the global variable GET
		   $_GET['id'] = substr ($route, strlen(strtok($route, '?')) + 4, strlen($route)); 
	       
	 	}

		if (strpos($route, 'page') && strpos($route, 'category')) { //is there a page AND category after the ? 
			//if so, set the page into the global variable GET 
		   $_GET['page'] =  substr($route, strpos($route, '=') + 1, strpos($route, '&') - strpos($route, '=') - 1 );
          
			//AND set the category into the global variable GET 
		   $_GET['category'] = substr ($route, strlen(strtok($route, '&')) + 10, strlen($route)); 
		                                                                             
		   
		}
		//if there is no page and category after the question mark,
		else {
			 //Then check if there is a category on it's own after the ? AND set the category on it's own 
			if (strpos($route, 'category')){
				$_GET['category'] = substr ($route, strlen(strtok($route, '?')) + 10, strlen($route)); 															
			
			}
			//Also check if page is on it's own, and set it to the global variable GET 
			if (strpos($route, 'page')){
				$_GET['page'] = substr ($route, strlen(strtok($route, '?')) + 6, strlen($route)); 
			
			}
		} // end else
	
		$route = strtok($route, '?'); //retrieve the string between ? ? and save as the route variable - for e.g. index?joke/edit?id=12 returns joke/edit
	} // end the 1st if	
	

	//MBOYCE 1L: This is the main Entry into my application and passes all requests to the entry point to then pass to the routes
	//Instancianting the class Entry point and passing $route, Request method, and instancianting the Routes class as the third argument passed into the
	//entry point constructor 
	$entryPoint = new \Ninja\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new Routes());

	//MBOYCE 1L: Then calling the run function of the instanciated Entry Point class 
	$entryPoint->run();
}
catch (PDOException $e) {
	//If there's a Database Issue, Please Display it on the Screen
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();

	include  __DIR__ . '/../templates/layout.html.php';
}
