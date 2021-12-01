<?php
namespace Legends\Controllers;
//MBOYCE NEW 1L: Created 'PagesController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
class PagesController {

	//MBOYCE 6L: This function returns a the Home page template in an array 
	public function home() {
		return [
			'template' => 'home.html.php', 
			'title' => 'Legends Barbell - Homepage'
		];
	}

	//MBOYCE 6L: This function returns the "About Us" page template in an array
	public function about() {
		return [
			'template' => 'about.html.php', 
			'title' => 'Legends Barbell - About Us'
		];
	}

	//MBOYCE 6L: This function returns the "Schedule" page template in an array
	public function schedule() {
		return [
			'template' => 'schedule.html.php', 
			'title' => 'Legends Barbell - Workout Schedule'
		];
	}
	
}