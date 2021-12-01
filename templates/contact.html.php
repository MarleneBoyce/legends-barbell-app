<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point-->
<div class="container">

<!--MBOYCE MOD 5L: Used error handling from Joke Database-->
<div class="row">
		<?php if (!empty($errors)): ?>
			<div class="errors">
				<p>Your message could not be sent, please check the following:</p>
				<ul>
				<?php foreach ($errors as $error): ?>
					<li><?= $error ?></li>
				<?php endforeach; 	?>
				</ul>
			</div>
		<?php endif; ?>
	</div>

    <!--MBOYCE NEW 1L: Added banner to top of page-->
    <img style="width: 100%;" src="../public/img/banner-large.jpg" alt="Homepage Banner">

    <!--MBOYCE NEW 1L: Added row (rows are wrappers for columns ), and added margin top & bottom-->
    <div class="row"  style="margin-top: 50px; margin-bottom: 60px;">

        <!--MBOYCE NEW 6L: If the user fills out and submits a contact form, they will see "Thanks for sending a message"--> 
           <?php if(($_SERVER['QUERY_STRING'] === 'contact?thanks')): ?> 
            <div style = "border: 1px solid #ccc; border-radius: 4px; padding: 10px 10px; color: white; margin-bottom: 10px; background: brown;" 
            class="mt-2 col-12 col-md-6 text-center">
                <h5> Thanks for sending a message! &nbsp; &#10084;</h5> 
            </div>
            <?php endif ?>
       
            <!--MBOYCE NEW 1L: Created header and subtext -->
            <h2><b>Question? Contact us here.</b></h2>
            <p>Use the form below if you have any further questions. We will contact you as soon as possible.</p>

            <!--MBOYCE NEW 7L: Created two columns for users to input first name and last name-->
            <div class="mt-4 col-12 col-md-6">
                <form action="index.php?contact" method="post">
                    <!--MBOYCE NEW 1L: Created row because rows are wrappers for columns-->
                    <div class="row">
                        <div class=" col-12 col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input name="contact[first_name]" type="text" class="form-control" id="first_name" placeholder="eg. John">
                        </div>

                        <div class=" col-12 col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input name="contact[last_name]" type="text" class="form-control" id="last_name" placeholder="eg. Doe">
                        </div>
                    </div>
                   <!--MBOYCE NEW 1L: Created row because rows are wrappers for columns-->
                    <div class="row">
                        <!--MBOYCE NEW 7L: Created two columns for users to input email and phone number-->
                        <div class=" col-12 col-md-6 mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="contact[email]" type="email" class="form-control" id="email" placeholder="eg. name@example.com">
                        </div>

                        <div class=" col-12 col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input name="contact[phone_number]" type="tel" class="form-control" id="phone" placeholder="eg. +1 234-456-5678">
                        </div>
                    </div>

                    <!--MBOYCE NEW 4L: Created longer input for subject line-->
                    <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input name="contact[subject]" type="text" class="form-control" id="subject" placeholder="eg. Class Schedule">
                        </div>
                    <!--MBOYCE NEW 4L: Created textarea for message box-->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="contact[message]" class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <!--MBOYCE 3L: Added submit button-->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>

                </form>
            </div>
    </div>
</div>