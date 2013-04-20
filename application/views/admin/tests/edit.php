<form class="form-actions" action="<?php echo URL::site('admin/tests/edit') . '/' . $test->id ?>" method="POST">
    <legend>Edit Test</legend>
    <?php Helper_Alert::get_flash() ?>
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="title">Title</label>
            <div class="controls">
                <input type="text" id="title" placeholder="Title" class="validate[required]" name="title" value="<?php echo $test->title ?>">
            </div>
        </div>
        <hr>
        <?php foreach ($questions as $key => $question): ?>
            <div class="question">
                <div class="control-group">
                    <label class="control-label" for="question">Question #1</label>
                    <div class="controls">
                        <textarea name="questions[]" class="textarea validate[required]" placeholder="Enter text ..." style="width: 810px; height: 200px"><?php echo $question->question ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="answer">Answer #1</label>
                    <div class="controls">
                        <input type="text" class="validate[required]" placeholder="Answer" name="answers[]" value="<?php echo $question->answer ?>">
                        <button type="button" onclick="javascript: edit.remove_question(this)" class="btn btn-danger" style="float: right">Delete</button>
                    </div>
                </div>
                <hr>
            </div>
        <?php endforeach; ?>
        <div class="control-group">
            <div class="controls">
                <button class="btn" type="reset">Cancel</button>
                <button type="button" id="new-question" class="btn btn-info">Add new question</button>
                <input type="submit" id="create-test" class="btn btn-primary" value="Save" />
            </div>
        </div>
    </fieldset>
</form>
