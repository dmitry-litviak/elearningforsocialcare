<h2><?php echo $course->title ?></h2>
<hr>
<div class="span7 hero-unit my-hero">
    <h3 class="centered">Short Description</h3>
    <hr>
    <p><?php echo $course->description ?></p>
    <hr>
    <h3 class="centered">Learning Material</h3>
    <hr>
    <div class="justified"><?php echo html_entity_decode($course->material) ?></div>
    <hr>
    <a href="<?php echo URL::site('tests/index/' . $course->test_id) ?>" class="btn btn-block btn-large btn-success">Go to the Test</a>
</div>
<div class="span3 hero-unit my-hero">
    <p class="centered">Push the button to take the test immediately </p>
    <hr>
    <a href="<?php echo URL::site('tests/index/' . $course->test_id) ?>" class="btn btn-block btn-large btn-success">Go to the Test</a>
</div>