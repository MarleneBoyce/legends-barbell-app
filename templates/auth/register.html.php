
<!--MBOYCE NEW 1L: Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container"  style="min-height: 70vh; margin-bottom: 80px;">

<!--MBOYCE 6L: Created a row (rows are wrappers for columns) and added margin-bottom (mb-3). Added additional margin-top.
	Then added padding (p-6) and more margin (m-2) for the header of the page-->
	<div class="row mb-3" style="margin-top: 20px;">
		<div class=" p-6 m-2">
			<h1><b>Create An Account</b></h2>
			<p> Use the form below to create your account</p>
		</div>
	</div>

	<!--MBOYCE 12L: Used error handling from the joke database-->
	<div class="row">
		<?php if (!empty($errors)): ?>
			<div class="errors">
				<p style="color: red;">Your account could not be created, please check the following:</p>
				<ul>
				<?php foreach ($errors as $error): ?>
					<li style="color:red;"><?= $error ?></li>
				<?php endforeach; 	?>
				</ul>
			</div>
		<?php endif; ?>
	</div>

	<!--MBOYCE 2L: Created a row (rows are wrappers for columns), created a column (col-8), added padding (p-6), and made the bg light (bg-light)
	and added margin to the left and right (mx-2). Added additional padding to the top-->
	<div class="row">
		<div class="col-8 p-6 bg-light mx-2" style="padding-top: 30px;">
		
			<!--MBOYCE 5L: Created a form, added padding to left and right (px-4), created another column (col-8) and addded margin to top and bottom (my-3)
			Created input for user email-->
			<form class="px-4" method="post" action="index.php?register">
				<div class="my-3 col-8">
					<label  class="form-label" for="email">Your email address *</label>
					<input  class="form-control " name="user[email]" id="email" type="text" placeholder= "eg. name@example.com" value="<?=$user['email'] ?? ''?>">
				</div>
			
				<!--MBOYCE 4L: Created another column (col-8), added margin to top and bottom (my-3) and added input for the user's first name-->
				<div class="my-3  col-8">
					<label class="form-label" for="name">Your first name *</label>
					<input  class="form-control" name="user[first_name]" id="first_name" type="text" placeholder="eg. John" value="<?=$user['first_name'] ?? ''?>">
				</div>

				<!--MBOYCE 4L: Created another column (col-8), added margin to top and bottom (my-3) and added input for the user's last name-->
				<div class="my-3 col-8">
					<label class="form-label" for="name">Your last name *</label>
					<input  class="form-control" name="user[last_name]" id="last_name" type="text" placeholder="eg. Doe" value="<?=$user['last_name'] ?? ''?>">
				</div>

				<!--MBOYCE 4L: Created another column (col-8), added margin to top and bottom (my-3) and added input for the user's password-->
				<div class="my-3 col-8">
					<label class="form-label" for="password">Password *</label>
					<input  class="form-control" name="user[password]" id="password" type="password" placeholder="***************" value="<?=$user['password'] ?? ''?>">
				</div>

				<!--MBOYCE 8L: Created another column (col-8), added margin to top and bottom (my-3) added additional padding for bottom of button
				inserted text and "register" button (btn btn-primary btn-lg)-->
				<div class="my-3 col-8" style="padding-bottom: 50px;">
					<div class="row">
						<div class="">
							<p>By clicking Create & Login, you agree to Legends Barbell’s privacy policy and terms of use</p>
						</div>
					</div>
					<button class="btn btn-primary btn-lg" type="submit"">Register</button>
				</div>

			</form>
		</div>
	</div>
</div>	