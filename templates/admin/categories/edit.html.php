<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point
Added additional margin-bottom-->
<div class="container"  style="margin-bottom: 80px;">

<!--MBOYCE NEW 6L: Added a row, margin bottom (mb-3), margin top, within the row added padding (p-6), and margin (m-2)-->
	<div class="row mb-3" style="margin-top: 60px;">
		<div class="p-6 m-2">
			<h2><b>Manage Category</b></h2>
			<p> Use the form below to update your category</p>
		</div>
	</div>

	<!--MBOYCE NEW 1L: Rows are wrappers for columns-->
	<div class="row"> 
		<!--MBOYCE NEW 1L: Created column with padding (p-6), made the background light, with margin left and right (mx-2) and additional padding to the top-->
		<div class="col-8 p-6 bg-light mx-2" style="padding-top: 50px;">

		<!--MBOYCE NEW 1L: If the categoryid is empty (creating a new category), or the user has the "edit_category" permission then the user can create/edit--> 
		<?php if (empty($category->id) || $user->hasPermission('edit_category')): ?>

			<!--MBOYCE NEW 6L: Input for category-->
			<form class="px-4" method="post" action="">
				<input type="hidden" name="category[id]" value="<?=$category->id ?? ''?>">
				<div class="my-3 col-8">
					<label  class="form-label" for="name">Category Name </label>
					<input  class="form-control " name="category[name]" id="name" type="text" placeholder= "eg. FRAN" value="<?=$category->name ?? ''?>">
				</div>
				<div class="my-3 col-8" style="padding-bottom: 50px;">
					<!--MBOYCE NEW 1L: Submit button -->
					<button class="btn btn-primary btn-lg" type="submit"">Submit</button>
				</div>

				<?php endif ?>
			</form>
		</div>
	</div>
</div>