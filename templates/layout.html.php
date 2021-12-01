<!doctype html>
<html lang="en">
	<head>
		<!--MBOYCE 7L: Linking style sheets to entire webpage-->
		<meta charset="utf-8">
 		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
		<link rel="stylesheet" href="css/app.css">
		<title><?=$title?></title>
	</head>
	<body>
	<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
	<div class="container">

	    <!--MBOYCE 4L: Aligning the logo, navigation, and buttons in the header-->
		<header class=" d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
		<a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
			<img src="../public/img/logo2.png" style = "width: 200px; height: 100px" alt="Legends Barbell Logo">
		</a>

		<!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
		aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>-->

		<!--MBOYCE 1L: Styling nav-->
		<ul style="font-size: 20px;" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 collapsge navbar-collagpse" id="navbarSupportedContent">
			
		<!--MBOYCE 32L: If the user is logged in, they will see the Admin pages, Else they will see public pages-->
		<?php if (!$loggedIn): ?> 
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "" ? "link-secondary active" : "link-dark"?>" aria-current="page" href="index.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "schedule" ? "link-secondary active" : "link-dark"?>" href="index.php?schedule">Schedule</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "workouts" ? "link-secondary active" : "link-dark"?>" href="index.php?workouts">Workouts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "about" ? "link-secondary active" : "link-dark"?>" href="index.php?about">About Us</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "contact" ? "link-secondary active" : "link-dark"?>" href="index.php?contact">Contact Us</a>
			</li>
		<?php else: ?>
			<li class="nav-item">
			<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "" ? "link-secondary active" : "link-dark"?>" aria-current="page" href="index.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/workouts" ? "link-secondary active" : "link-dark"?>" href="index.php?admin/workouts">Your Workouts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/categories" ? "link-secondary active" : "link-dark"?>" href="index.php?admin/categories">Categories</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/users" ? "link-secondary active" : "link-dark"?>" href="index.php?admin/users">Instructor Roles</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/contacts" ? "link-secondary active" : "link-dark"?>" href="index.php?admin/contacts">Messages</a>
			</li>
		<?php endif; ?>

		</ul>
		
		<!--MBOYCE 11L: When a user logs in, it will display their name in the right corner and the login button will change to log out-->
		<div class="col-md-3 text-end">
			
			<?php if ($loggedIn): ?> 
				<span>Hi, <?= $user->first_name ?></span>  
				<a href="index.php?logout" class="btn btn-light" role="button">Logout</a>
				<?php else: ?>
					<a href="index.php?login" class="btn btn-light" role="button">Login</a>
					<a href="index.php?register" class="btn btn-primary" role="button">Register</a>
			<?php endif; ?>
	
		</div>
		</header>
	</div>

	<!--MBOYCE 5L: Outputting content onto each template-->
	<main class="flex-shrink-0" style="min-height: 75vh;">
		<div class="container">
			<?=$output?>
		</div>
	</main>

	<!--MBOYCE 39L: Styling footer. If user is logged in, will see Admin pages, else user will see public pages-->
	<footer class="footer footer-dark bg-dark mt-auto py-3 mt-6" style="width: 100%">
		<div class="container">
			<div class="row">
				<div class="d-flex justify-content-between">
					<nav class="mb-4">
						<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 collapsge navbar-collagpse text-light" id="navbarSupportedContent">
						
						<?php if (!$loggedIn): ?> 
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "" ? "link-secondary active" : "link-light"?>" aria-current="page" href="index.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "schedule" ? "link-secondary active" : "link-light"?>" href="index.php?schedule">Schedule</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "workouts" ? "link-secondary active" : "link-light"?>" href="index.php?workouts">Workouts</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "about" ? "link-secondary active" : "link-light"?>" href="index.php?about">About Us</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "contact" ? "link-secondary active" : "link-light"?>" href="index.php?contact">Contact Us</a>
							</li>
						<?php else: ?>
							<li class="nav-item">
							<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "" ? "link-secondary active" : "link-light"?>" aria-current="page" href="index.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/workouts" ? "link-secondary active" : "link-light"?>" href="index.php?admin/workouts">Your Workouts</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/categories" ? "link-secondary active" : "link-light"?>" href="index.php?admin/categories">Categories</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/users" ? "link-secondary active" : "link-light"?>" href="index.php?admin/users">Instructor Roles</a>
							</li>
							<li class="nav-item">
								<a class="nav-link px-2 <?= $_SERVER['QUERY_STRING'] === "admin/contacts" ? "link-secondary active" : "link-light"?>" href="index.php?admin/contacts">Messages</a>
							</li>
						<?php endif; ?>
						</ul>
					</nav>

					<!--MBOYCE 26L: Adding social media icons-->
					<div>
						<span class="p-2">
							<a target="_blank" style="text-decoration: none" href="https://www.facebook.com/LegendsBarbell/">
								<img src="../public/img/social/facebook.png" alt="Facebook">
							</a>
						</span>

						<span class="p-2">
							<a target="_blank" style="text-decoration: none" href="https://twitter.com/CrossFit?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">
								<img src="../public/img/social/twitter.png" alt="Twitter">
							</a>
						</span>

						<span class="p-2">
							<a target="_blank" style="text-decoration: none" href="https://www.instagram.com/legendsbarbell/?hl=en">
								<img src="../public/img/social/instagram.png" alt="Instagram">
							</a>
						</span>

						<span class="p-2">
							<a target="_blank" style="text-decoration: none" href="https://www.youtube.com/channel/UCtcQ6TPwXAYgZ1Mcl3M1vng">
								<img src="../public/img/social/youtube.png" alt="Youtube">
							</a>
						</span>
					</div>
				</div>
			</div>
			
			<!--MBOYCE 8L: Adding text below social media icons-->
			<div class="row">
				<div class="d-flex justify-content-between">
					<span class="text-light">&copy; 2021 Legends Barbell. All Rights Reserved.</span>
					<span class="text-light">Made with 💗 by Marlene Boyce.</span>
				</div>
			</div>
		</div>
	</footer>
	
	<!--MBOYCE 2L: Adding bootstrap JS-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="js/app.js"></script>
	</body>
</html>