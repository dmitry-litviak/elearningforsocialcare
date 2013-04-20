<ul class="thumbnails">
    <?php foreach ($courses as $key => $course): ?>
        <li class="span3">
            <div class="thumbnail test_block">
                <h3><?php echo Helper_Output::cut_string($course->title, 20) ?></h3>
                <div class="caption">
                    <h4>Description</h4>
                    <p><?php echo Helper_Output::cut_string($course->description, 100) ?></p>
                    <p><a href="<?php echo URL::site('courses/take/' . $course->id) ?>" class="btn btn-primary">Go to Course</a></p>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>