<?php
namespace Legends\Entity;

class Permission {
	
	//MBOYCE 14L: This function holds all the permissions available to users 
	public static function all() {
		return  [
			"create_workout",
			"edit_workout",
			"delete_workout",
			"create_category",
			"edit_category",
			"delete_category",
			"edit_user",
			"delete_user",
			"view_messages",
			"delete_messages"
		];
	}

	//MBOYCE 9L: This function sets default permissions for new instructors 
	public static function instructorPermissions() {

		return [
			"create_workout",
			"edit_workout",
			"delete_workout",
		];
	}
}