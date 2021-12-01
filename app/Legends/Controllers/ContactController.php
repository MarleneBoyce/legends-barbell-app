<?php
namespace Legends\Controllers;

use Ninja\DatabaseTable;

//MBOYCE NEW 1L: Created 'ContactController' to properly identify that it is a controller
//Controller's job is to process requests and return necessary response by delegating responsibility to other parts of the application 
//Interacting with an instance of the 'contactsTable' and returning the template are some of the things that the controller is responsible for
class ContactController {

	//MBOYCE NEW 1L: Private member variable 
	private $contactsTable;

	//MBOYCE NEW 3L: Constructor accepting the contactsTable
	public function __construct(DatabaseTable $contactsTable) {
		//MBOYCE 1L: This is assgining the argument to the private member variable
		$this->contactsTable = $contactsTable;
	}

	//MBOYCE 6L: This function returns the specified template as an array
	public function contact() {
		return [
			'template' => 'contact.html.php', 
			'title' => 'Legends Barbell - Contact Us'
		];
	}

	//MBOYCE NEW 6L: This function saves the information entered into the "Contact Us" page 
	//It retrieves the current time and saves it PLUS the other information in the contacts Table 
	public function saveContact() {

		//MBOYCE 1L: The $user variable is equal the the value collected from the registration form with method="post". 
		$contact = $_POST['contact'];

		//MBOYCE 2L: $valid is set to true, and $errors is set to an empty array
		$valid = true;
		$errors = [];

		

		//MBOYCE 4L: If the first_name field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($contact['first_name'])) {
			$valid = false;
			$errors[] = 'First Name cannot be blank';
		}
		
		//MBOYCE 4L: If the last_name field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($contact['last_name'])) {
			$valid = false;
			$errors[] = 'Last Name cannot be blank';
		}
		//MBOYCE 4L: If the email field is left blank, $valid will be set to false, and the error array will store the error message 
		if (empty($contact['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		//MBOYCE 6L: If the email is not left blank, the email will be validated to ensure it's in the correct format, if it is not an error message will be stored
		//in the error array ELSE the email will be stored to the contact's email 
		if (filter_var($contact['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}
		
		if (!$valid) { 
			//MBOYCE 9L: If errors are present, remain on (or return) the register page and display the errors 
			return [
				'template' => 'contact.html.php', 
				'title' => 'Contact',
				'variables' => [
					'errors' => $errors,
				]
			]; 
		}
			
	
		$contact['created_at'] = new \DateTime();

		$this->contactsTable->save($contact);

		header('Location: index.php?contact?thanks'); 
	}

	//MBOYCE NEW 9L: This function lists (or displays) all the 'messages' submitted through the "Contact Us" page 
	//It returns the template needed to display the messages to the admin users 
	public function list() {
		return [
			'template' => 'admin/contacts/index.html.php', 
			'title' => 'Legends Barbell - Messages', 
			'variables' => [
			    'contacts' => $this->contactsTable->findAll()
			]
		];
	}
	
	//MBOYCE 5L: This function allows users to delete messages in the contacts Table 
	public function delete() {
		$this->contactsTable->delete($_POST['id']);
		
		//1L: This header redirects the user to the contacts page once they've deleted a message 
		header('location: index.php?admin/contacts');  
	}
}
	
