<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo URL::base() ?>"><?php echo Kohana::$config->load('config')->get('Site Keywords') ?></a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php echo Helper_Mainmenu::render() ?>
                    <?php if (Auth::instance()->get_user()): ?>
                        <?php $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name ?>
                        <?php if ($role == 'admin'): ?>
                            <li><a href="<?php echo URL::site('admin/dashboard') ?>">Admin Panel</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <?php if (!Auth::instance()->logged_in()): ?>
                    <form class="navbar-form pull-right" action="<?php echo URL::site('session/login') ?>" method="POST">
                        <input class="span2" type="text" placeholder="Email" name="email">
                        <input class="span2" type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn">Sign in</button>
                    </form>
                <?php else: ?>
                    <p class="navbar-text pull-right">
                        Logged in as <a href="<?php echo URL::site('user/profile') ?>" class="navbar-link"><?php echo Auth::instance()->get_user()->first_name ?></a>
                    </p>
                <?php endif ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>