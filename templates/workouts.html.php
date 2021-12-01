
<!--MBOYCE 1L: Added style sheet for plug in-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modal-video@2/css/modal-video.min.css">

<!--MBOYCE 5L: Styled page header-->
<section class="py-2 text-center container">
    <div class="row py-lg-2">
      <div class="col-lg-8 col-md-10 mx-auto">

        <h1><b>FIT FOR ANY CHALLENGE</b></h1>
        <p class="lead text-muted">Functional fitness workouts and daily training programs</p>

        <!--MBOYCE 3L: Displayed total workouts in the database-->
        <div class="text-center">
           There are <?= $totalWorkouts ?> Workouts 
        </div>

        <!--MBOYCE 10L: Display categories with foreach statement-->
        <p>
          <a href="index.php?workouts" class="btn btn-light my-2">All</a>
          <?php 
          $colors = ["red", "orange", "yellow", "green", "blue","purple","teal","cyan"];
          foreach ($categories as $key => $category):
            $color = isset($colors[$key]) ? $colors[$key] : "dark";
          ?> 
             <a href="index.php?workouts?page=1&category=<?= $category->id ?>" class="btn btn-light my-2 text-<?= $color ?>  mx-1">
             <?= $category->name ?>
            </a>
         <?php endforeach; ?>

        </p>
      </div>
    </div>
  </section>

  <!--MBOYCE 4L: Creating container to hold workout cards. Use foreach to extract workout information-->
  <div class="py-3 mb-4">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($workouts as $key => $workout): ?>
          
        <!--MBOYCE 19L: Displaying workout title, text, equipment, youtube video and duration-->
        <div class="col">
          <div class="card shadow-sm">
            <img src="<?= $workout->image ?? "https://images.pexels.com/photos/669584/pexels-photo-669584.jpeg"; ?>" class="bd-placeholder-img card-img-top" 
            width="100%" height="225" alt="Workout Image">
            <div class="card-body" style="min-height:24rem;">
              <p class="card-title"><strong><?= $workout->title; ?></strong></p>
              <p class="card-text"><pre><?= $workout->description; ?></pre></p>
              <p class="card-text"><span>Required Equipment:</span><br><pre><?= $workout->equipment; ?></pre></p>
              <div class="d-flex justify-content-between align-items-center">
                <?php if($workout->video_id !== null): ?>
                  <div class="btn-group">
                    <button  data-video-id="<?= $workout->video_id; ?>" type="button" class="play-video btn btn-sm btn-outline-secondary">View Video</button>
                  </div>
                <?php endif; ?>
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
    <a class="btn btn-xs btn-info" href="index.php?workouts?page=<?=$currentPage - 1?>">Previous</a> 
    <?php endif ?>
    <?php if($currentPage < $totalPages ) : ?>
    <a class="btn btn-xs btn-info" href="index.php?workouts?page=<?=$currentPage + 1 ?>">Next</a>
    <?php endif ?> 
    </div>
</div>

<!--MBOYCE 5L: JS to display youtube video-->
<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/modal-video@2/js/jquery-modal-video.min.js"></script>
<script>
$(".play-video").modalVideo();
</script>