<html>
    <body>
        <p>Hi, <?php echo $obj['user']->first_name ?></p>
        <p>You <?php echo $obj['score'] > 70 ? "successfully" : "poorly" ?> passed "<?php echo $obj['test']->title ?>" on <?php echo $obj['score'] ?>%</p>
        <a href="<?php echo URL::site('results') ?>">Link to the results page</a>
    </body>
</html>
