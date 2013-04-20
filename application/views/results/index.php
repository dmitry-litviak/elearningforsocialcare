<ul class="thumbnails">
    <?php foreach ($results as $key => $result): ?>
        <li class="span3">
            <div class="thumbnail test_block result-block">
                <h4><?php echo $result->test->title ?></h4>
                <div class="caption">
                    <h4>Score: <span class="label <?php echo $result->score > 70 ? "label-success" : "label-important" ?>"><?php echo $result->score > 70 ? "SUCCESS: " : "FAILURE: " ?><?php echo $result->score ?>%</span></p></h4>
                    <p><br>
                    <p><a class="btn btn-success btn-large" href="<?php echo URL::site('tests/index/' . $result->test_id) ?>">Retake Test</a></p>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>