<!DOCTYPE HTML>
<html lang="en-US">
    <head>
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
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php echo Helper_Output::renderCss(); ?>
    </head>
    <body>
        <div id="wrap">
            <?php echo View::factory('layouts/partials/admin/header')->render(); ?>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span3">
                        <?php echo View::factory('layouts/partials/admin/site_bar')->render(); ?>
                    </div>
                    <div class="span9">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <?php echo View::factory('layouts/partials/admin/footer')->render(); ?>
        <?php echo Helper_Output::renderJs(); ?>
    </body>
</html>