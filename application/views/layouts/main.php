<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <script type="text/javascript">
            var SYS = {baseUrl: '<?php echo URL::base() ?>'}
        </script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo URL::site('libs/html5shiv.js') ?>"></script>
        <![endif]-->

        <?php echo Helper_Output::renderCss(); ?>

    </head>
    <body>
        <!--<div style="max-width: 100%">-->
        <div id="wrap">
            <?php echo View::factory('layouts/partials/header')->render(); ?>
            <div class="container">
                <?php Helper_Alert::get_flash() ?>
                <?php echo $content; ?>
            </div>
            <div id="push"></div>
        </div>

        <?php echo View::factory('layouts/partials/footer')->render(); ?>
        <?php echo Helper_Output::renderJs(); ?>
    </body>
</html>