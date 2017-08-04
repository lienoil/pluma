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
                <h2 class="header-title text-danger mt-5">Oops!</span></h2>
                <p class="lead">Something went wrong :(</p>
                <p>Below are the likely cause of the error. If none could work, try looking at the error logs, or contacting your Host Provider</p>
            </header>

            <main class="content">
                <?php echo $__env->make("Install::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <ol>
                    <li>
                        <div class="text-muted">Error: <?php echo e($e->getMessage()); ?></div>
                    </li>
                    <li>
                        <div class="text-muted">
                            <strong>Write Permissions</strong> | Make sure you have the right permissions to write in the <code>/storage</code> folder.
                            From your terminal, try: <br>
                            <code>$ chmod -R 755 /path/to/pluma</code><br>
                            <code>$ chmod -R 777 /path/to/pluma/storage</code>
                            <br>
                        </div>
                    </li>
                </ol>

            </main>

            <aside class="footnote mb-3">
                <small>&copy; Pluma&trade; 2017. Licensed under the MIT.</small>
            </aside>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Install::layouts.installation", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>