<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container"  style="margin-bottom: 80px;">

<!--MBOYCE 5L: Styling header of page-->
<div class="row mb-3" style="margin-top: 20px;">
    <div class="p-6 m-2">
	<h2>Manage User</h2>
        <p> Use the form below to update user</p>
    </div>
</div>

<!--MBOYCE NEW 11L: Displaying errors in form-->
<div class="row">
    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
            <?php foreach ($errors as $error): ?>
                <li style="color:red;"><?= $error ?></li>
            <?php endforeach; 	?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!--MBOYCE NEW 1L: Rows are wrappers for columns-->
<div class="row">

    <div class="col-7 p-6 bg-light mx-2" style="padding-top: 50px;">

    <!--MBOYCE NEW 1L: If the userid is empty (creating a new user), or the user has the "edit_user" permission, then they can create/edit a user-->
    <?php if (empty($user->id) || $loggedInUser->hasPermission('edit_user')): ?>

        <!--MBOYCE 2L: Creating form to edit/create user information-->
        <form class="px-4" method="post" action="">
            <input type="hidden" name="user[id]" value="<?=$user->id ?? ''?>">
            
            <!--MBOYCE 4L: Displaying input for user's first name-->
            <div class="my-3 col-8">
                <label  class="form-label" for="first_name">First Name: *</label>
                <input  class="form-control " name="user[first_name]" id="first_name" type="text" placeholder= "eg. Jane" value="<?=$user->first_name ?? ''?>">
            </div>

            <!--MBOYCE 4L: Displaying input for user's last name-->
			<div class="my-3 col-8">
                <label  class="form-label" for="last_name">Last Name: *</label>
                <input  class="form-control " name="user[last_name]" id="last_name" type="text" placeholder= "eg. Doe" value="<?=$user->last_name ?? ''?>">
            </div>
            
	        <!--MBOYCE 4L: Displaying input for user's email-->
            <div class="my-3 col-8">
                <label  class="form-label" for="email">Email: *</label>
                <input  class="form-control " name="user[email]" id="email" type="email" placeholder= "eg. smith@example.com" value="<?=$user->email ?? ''?>">
            </div>

            <!--MBOYCE 6L: If the user is being created (i.e. the user id is empty) the password input will be displayed-->
			<?php if (empty($user->id)): ?>
            <div class="my-3 col-8">
                <label  class="form-label" for="password">Password: *</label>
                <input  class="form-control " name="user[password]" id="password" type="password" placeholder= "eg. **********">
            </div>
			<?php endif ?>

			<!--MBOYCE 7L: Input control for selecting user "role", instructor or Admin--> 
            <div class="my-3 col-8">
                <label  class="form-label" for="role_id">Role: *</label>
                <select  class="form-control " name="user[role_id]" id="role_id" placeholder= "Please Select role">
					<option value="1" <?= $user && ((int) $user->role_id === 1) ? 'selected' : '' ?>>Admin</option>
					<option value="2" <?= $user && ((int) $user->role_id === 2) ? 'selected' : '' ?>>Instructor</option>
				</select>
            </div>

            <!--MBOYCE 1L: Styling permissions, margin top and bottom (my-3) and setting the column length (col-10)-->
            <div class="my-3 col-10">
                <p>Select permissions for this user:</p>

                <!--MBOYCE NEW 1L: Rows are wrappers for columns--> -
                <div class="row">
                
                <!--MBOYCE NEW 1L: Created foreach to display permission names-->
                <?php foreach ($permissions as $key => $name): ?>
                    <div class="div col-4">
                        <div class="form-check form-check-inline">
                            <?php if ($user && $user->hasPermission($name)): ?>
                            <input class="form-check-input" id="<?= $key ?>" type="checkbox" checked name="permissions[]" value="<?=$name?>" /> 
                            <?php else: ?>
                            <input class="form-check-input"  id="<?= $key ?>" type="checkbox" name="permissions[]" value="<?=$name?>" /> 
                            <?php endif; ?>

                            <label for="<?= $key ?> class="form-check-label"><?= ucwords(strtolower(str_replace('_', ' ', $name))) ?></label>
                        </div>
                    </div>
               
                <?php endforeach; ?>
                </div>
            </div>

            <!--MBOYCE 3L: Created div to style Submit button -->
            <div class="my-3 col-8" style="padding-bottom: 50px;">
                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
            </div>

        </form>
        
        <?php endif; ?>
    </div>
</div>