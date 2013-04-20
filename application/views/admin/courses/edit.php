<form class="form-actions" action="<?php echo URL::site('admin/courses/edit') . '/' . $course->id  ?>" method="POST">
    <legend>Edit Course</legend>
    <?php Helper_Alert::get_flash() ?>
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="title">Title</label>
            <div class="controls">
                <input type="text" id="title" placeholder="Title" class="validate[required]" name="title" value="<?php echo $course->title ?>">
            </div>
        </div>
        <hr>
        <div class="control-group">
            <label class="control-label" for="description">Short Description</label>
            <div class="controls">
                <textarea class="validate[required]" placeholder="Description" name="description"><?php echo $course->description ?></textarea>
            </div>
        </div>
        <hr>
        <div class="control-group">
            <label class="control-label" for="material">Training Material</label>
            <div class="controls">
                <textarea name="material" class="textarea validate[required]" placeholder="Enter text ..." style="width: 810px; height: 200px"><?php echo $course->material ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="test_id">Assigned Test</label>
            <div class="controls">
                <select name="test_id">
                    <?php foreach ($tests as $test): ?>
                        <option <?php echo $course->test->id == $test->id ? "selected" : "" ?> value="<?php echo $test->id ?>"><?php echo $test->title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="control-group">
            <div class="controls">
                <button class="btn" type="reset">Cancel</button>
                <input type="submit" id="create-test" class="btn btn-primary" value="Save" />
            </div>
        </div>
    </fieldset>
</form>
