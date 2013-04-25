<?php if (!empty($questions) && count($questions)): ?>
<form action="<?php echo URL::site('tests/result/') ?>" method="POST">
    <input type="hidden" value="<?php echo $test->id ?>" name="test[id]">
    <div class="tabbable">
        <ul class="nav nav-pills">
            <?php foreach ($questions as $key => $question): ?>
                <li <?php echo $key + 1 == 1 ? 'class="active"' : '' ?> ><a id="atab<?php echo $key + 1 ?>" href="#tab<?php echo $key + 1 ?>" data-toggle="tab"><?php echo $key + 1 ?></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($questions as $key => $question): ?>
                <div class="tab-pane hero-unit my-hero <?php echo $key + 1 == 1 ? 'active' : '' ?>" id="tab<?php echo $key + 1 ?>" class="hero-unit my-hero" data-id="<?php echo $key + 1 ?>">
                    <div class="row">
                        <div class="span6">
                            <p>Question:</p>
                            <?php echo html_entity_decode($question->question) ?>
                        </div>
                        <div class="span3">
                            <p>Your Answer:</p>
                            <input type="text" name="answers[]" class="span3" />
                            <?php if ($key < count($questions) - 1 && $key > 0): ?>
                                <button class="btn btn-success btn-block next">Next Question</button>
                                <button class="btn btn-danger btn-block prev">Previous Question</button>   
                            <?php elseif ($key == 0): ?>
                                <button class="btn btn-success btn-block next">Next Question</button>    
                            <?php else: ?>
                                <input type="submit" class="btn btn-info btn-block" value="Finish Test and Get Results" />
                                <button class="btn btn-danger btn-block prev">Previous Question</button> 
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</form>
<?php endif ?>