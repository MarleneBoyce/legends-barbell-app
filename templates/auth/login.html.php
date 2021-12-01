<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container"  style="margin-bottom: 80px;">

<!--MBOYCE NEW 1L: Created a row, using the class "row" with a margin-bottom (mb-3), and styled the margin top with 20px so the wording wasn't 
so close to the header-->
	<div class="row mb-3" style="margin-top: 20px;">
	<!--MBOYCE NEW 4L: Opened a new div, with padding (p-6), margin (m-2), and gave the heading a <h2> tag-->
		<div class="p-6 m-2">
			<h2><b>Login or Create an Instructor Account</b></h2>
		</div>
	</div>

<!--MBOYCE MOD 5L: Used error handling from Joke Database-->
	<div class="row">
		<?php if (isset($error)):?>
			<div class="errors"><?=$error;?></div>
		<?php endif; ?>
	</div>

<!--MBOYCE NEW 32L used bootstrap classes to style webpages-->
	<div class="row">

		<!--MBOYCE 5L: Created a column (col-5), added padding(p-6), added a light background (bg-light), add margin to the left and right (mx-2) and added 
		additional padding to the top-->
		<div class="col-5 p-6 bg-light mx-2" style="padding-top:20px;">

		<!--MBOYCE 3L: Within the column text was added and was given padding-->
			<div class="p-4">
				<h2 class="font-weight-bold">Registered Users</h2>
				<p>Please login with your email and password</p>
			</div>
			<!--MBOYCE 5L: Created a form, padding left and right (px-4) was added, added margin to top and bottom (my-1) on line 36 and input 
			for the user's email address-->
			<form class="px-4" method="post" action=index.php?login>
				<div class="my-1">
					<label class="form-label" for="email">Your email address</label>
					<input required type="email"  class="form-control" id="email" name="email" placeholder= "eg. name@example.com" />
				</div>
			<!--MBOYCE 4L: Added margin to top and bottom (my-3), then created input for password-->
				<div class="my-3">
					<label class="form-label" for="password">Your password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder= "****************">
				</div>
			<!--MBOYCE 3L: Added margin to top and bottom (my-4), added extra padding to the bottom after the login button-->
				<div class="my-4" style="padding-bottom: 50px;">
					<button class="btn btn-primary btn-lg" type="submit" name="login" value="">Log in</button>
				</div>
				
			</form>
		</div>
		<!--MBOYCE 1L: Created another column (col-6), added padding (p-6), a light background (bg-light), 
		and margin to the left and right (mx-2). Added additional padding to the top-->
		<div class="col-6  p-6 bg-light mx-2" style="padding-top: 20px;">

		<!--MBOYCE 5L: Added padding (p-4), added text and a button so new users can be redirected to the registration page-->
			<div class="p-4">
				<h2>Create an Instructor Account</h2>
				<p>By creating an account, you will be able to start creating revolutionary workouts for thousands of LEGENDS athletes</p>
				<a href="index.php?register" class="btn btn-primary btn-lg" type="submit" name="login">Register Now</a>
			</div>
		</div>
	</div>
</div>	
