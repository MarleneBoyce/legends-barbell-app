<?php
namespace Legends\Entity;

//MBOYCE 1L: The contact class is a class representation of the contacts table 
class Contact {
	//MBOYCE 8L: public variables 
	public $id;
	public $first_name;
	public $last_name; 
	public $email; 
	public $phone_number; 
	public $subject; 
	public $message; 
	public $created_at; 
}