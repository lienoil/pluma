<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f2f3;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="col-sm-8 offset-sm-2">
            <header class="header">
                <h2 class="header-title mt-5">Pluma&trade; | <span class="text-muted">Finish</span></h2>
                <p class="lead">Done! you may still edit additional configurations in settings.</p>
            </header>

            <main class="content">
                <p>You may now visit the <a href="<?php echo e(url('admin')); ?>">Admin Dashboard</a> and login with the following credentials:</p>

                <ul>
                    <li><strong>Username: <?php echo e($user->email); ?></strong></li>
                    <li><strong>Password: <em>Your password</em></strong></li>
                </ul>

                <a href="<?php echo e(route('login.show')); ?>" class="btn btn-primary">Login</a>
                <a href="<?php echo e(url('home')); ?>" class="btn btn-secondary">Home</a>

            </main>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Install::layouts.installation", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>