<!--MBOYCE NEW 1L : Used bootstrap default container, this container is responsive, fixed-with, and it's max-width changes at each break point
also added margin-bottom so the form has space before the footer -->
<div class="container"  style="margin-bottom: 80px;">

<!--MBOYCE 6L: Styled and inserted header-->
<div class="row mb-3" style="margin-top: 20px;">
    <div class="p-6 m-2">
        <h2><b>Manage Workout</b></h2>
        <p> Use the form below to update your workout</p>
    </div>
</div>

<!--MBOYCE 1L: Rows are wrappers for columns-->
<div class="row">

    <!--MBOYCE 1L: Styling form-->
    <div class="col-7 p-6 bg-light mx-2" style="padding-top: 20px;">
    <!--MBOYCE 1L: If the workout_id is empty (creating a new workout), OR the user_id matches the workout_id, OR the user has the permission to 
    edit_workout, then the following can occur-->
    <?php if (empty($workout->id) || $user->id == $workout->user_id || $user->hasPermission('edit_workout')): ?>
        <form class="px-4" method="post" action="">
            <input type="hidden" name="workout[id]" value="<?=$workout->id ?? ''?>">
            <div class="my-3 col-10">
                <label  class="form-label" for="title">Workout Title *</label>
                <input  class="form-control " name="workout[title]" id="title" type="text" placeholder= "eg. FRAN" value="<?=$workout->title ?? ''?>">
            </div>

            <div class="my-3  col-10">
                <label class="form-label" for="name">Duration *</label>
                <input  class="form-control" name="workout[duration]" id="duration" type="number" min="0" max="120" placeholder="eg. 20" value="<?=$workout->duration ?? ''?>">
            </div>
	
            <div class="my-3  col-10">
                <label  class="form-label" for="description">Type your workout here:</label>
                <textarea class="form-control" id="description" name="workout[description]" rows="3" cols="40"><?=$workout->description ?? ''?></textarea>
            </div>

            <div class="my-3  col-10">
                <label  class="form-label" for="equipment">Equipment: </label>
                <textarea class="form-control" id="equipment" name="workout[equipment]" rows="3" cols="40"><?=$workout->equipment ?? ''?></textarea>
            </div>

            <div class="my-3 col-10">
                <label  class="form-label" for="video_id">Youtube Video id: </label>
                <input  class="form-control " name="workout[video_id]" id="video_id" type="text" placeholder= "eg. 8i1ZC7TBa8Y" value="<?=$workout->video_id ?? ''?>">
            </div>

            <div class="my-3 col-10">
                <label  class="form-label" for="image">Image URL: </label>
                <input  class="form-control" name="workout[image]" id="image" type="text" placeholder= "eg. https://images.pexels.com/photos/2247179/pexels-photo-2247179.jpeg" value="<?=$workout->image ?? ''?>">
            </div>

            <!--MBOYCE 13L: If the workout 'hasCategory' display them when editing the form--> 
            <div class="my-3 col-10">
                <p>Select categories for this workout:</p>
                <?php foreach ($categories as $key => $category): ?>
                <div class="form-check form-check-inline">
                    <?php if ($workout && $workout->hasCategory($category->id)): ?>
                     <input class="form-check-input" id="<?= $key ?>" type="checkbox" checked name="category[]" value="<?=$category->id?>" /> 
                    <?php else: ?>
                     <input class="form-check-input"  id="<?= $key ?>" type="checkbox" name="category[]" value="<?=$category->id?>" /> 
                    <?php endif; ?>

                    <label for="<?= $key ?> class="form-check-label"><?=$category->name?></label>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!--MBOYCE 3L: Styled and inserted submit button -->
            <div class="my-3 col-10" style="padding-bottom: 50px;">
                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
            </div>

        </form>
        <?php endif; ?>
    </div>

    <!--MBOYCE 15L: Created and Styled Notes area so users have direction on how to fill out the workout form -->
    <div class="col-4 py-6 px-4 bg-light" style="padding-top: 50px;">
        <h2>Notes</h2>
        <p>
            <b>Youtube Video ID </b> - Copy the value AFTER the '=' in the youtube video link<br><br>
            <b>Image URL </b> - Right click on the image you desire, click "copy image link" and paste in the 'Image URL' field <br><br>
            <b>CATEGORY MEANING </b> <br><br>
            <b>AMRAP</b> - As Many Rounds As Possible<br><br>
            <b>FOR TIME</b> - Complete the workout as quickly as possible<br><br>
            <b>EMOM</b> - Every Minute on the Minute<br><br>
            <b>HERO WOD's</b> - Workouts tributed to a fallen first responder or member of the military who died while serving honorably in the line of duty<br><br>
            <b>Tabata</b> - Workouts that have 20 seconds of a very high intensity exercise, and 10 seconds of rest<br><br>
            <b>Crossfit</b> -  A strength and conditioning workout that is made up of functional movement performed at a high intensity level <br><br>
            <b>BootCamp</b> - Workouts that are designed to build strength and fitness through a variety of types of exercise <br><br>
        </p>
    </div>
</div>