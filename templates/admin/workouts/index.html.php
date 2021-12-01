
<!--MBOYCE 1L: Inserting the style sheet for the video plug-in-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modal-video@2/css/modal-video.min.css">

<!--MBOYCE 1L: Rows are wrappers for columns. Padding inserted -->
    <div class="row py-lg-2">

    <!--MBOYCE 5L: Created and styled header, also displayed total workouts --> 
      <div class="d-flex justify-content-between">
        <div>
        <h2><b>My Workouts</b></h2>
        <div>There are <?= $totalWorkouts ?> Workouts</div>
        </div>

        <!--MBOYCE 3L: Within the header div, styled a 'Create workout' button -->
        <div>
           <a href="index.php?admin/workouts/edit"  class="btn btn-primary my-2">Create a Workout</a>
        </div>
    </div>
  <!--MBOYCE 3L: Using the same template as the public workouts page to display the admin workouts page-->
  <div class="py-3 mb-4">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($workouts as $key => $workout): ?>
          
        <div class="col">
          <div class="card shadow-sm">
            <img src="<?= $workout->image ?? "https://images.pexels.com/photos/669584/pexels-photo-669584.jpeg"; ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="Workout Image">

            <div class="card-body" style="min-height:24rem;">
              <p class="card-title"><strong><?= $workout->title; ?></strong></p>
              <p class="card-text"><pre><?= $workout->description; ?></pre></p>
              <p class="card-text"><span>Required Equipment:</span><br><pre><?= $workout->equipment; ?></pre></p>
              <div class="d-flex justify-content-between align-items-center">
               
                  <div class="btn-group">
                    <?php if($workout->video_id !== null): ?>
                      <button  data-video-id="<?= $workout->video_id; ?>" type="button" class="play-video btn btn-sm btn-outline-secondary">View Video</button>
                    <?php endif; ?>
                    <a role="button" href="index.php?admin/workouts/edit?id=<?= $workout->id ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form action="index.php?admin/workouts/delete" method="post" id="<?= $key ?>" 
                      onsubmit="if(!confirm('Are you sure you want to delete this workout?') ) { event.preventDefault(); }">
                      <input type="hidden" name="id" value="<?= $workout->id ?>">
                      <button type="submit"  class="btn btn-sm btn-outline-secondary">Delete</a>
                    </form>
                  </div>

                <small class="text-muted"><?= $workout->duration ?? 0 ?> mins</small>
              </div>
            </div>
          </div>
        </div>

        <?php endforeach; ?>

       

</div>
 <!--MBOYCE 8L: Creating previous and next buttons for the workouts -->
<div class="d-flex justify-content-between m-3">
    <?php if($currentPage > 1) : ?>
    <a class="btn btn-xs btn-info" href="index.php?admin/workouts?page=<?=$currentPage - 1?>">Previous</a> 
    <?php endif ?>
    <?php if($currentPage < $totalPages ) : ?>
    <a class="btn btn-xs btn-info" href="index.php?admin/workouts?page=<?=$currentPage + 1 ?>">Next</a>
    <?php endif ?> 
</div> 

<!--MBOYCE 5L: Javascript to display videos -->
<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/modal-video@2/js/jquery-modal-video.min.js"></script>
<script>
$(".play-video").modalVideo();
</script>