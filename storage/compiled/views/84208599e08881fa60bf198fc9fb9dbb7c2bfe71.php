<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f1f1;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="col-sm-8 offset-sm-2">
            <header class="header">
                <h2 class="header-title mt-5">Pluma&trade; | <span class="text-muted">Welcome</span></h2>
                <p class="lead">Thank you for using <strong>Pluma&trade;</strong> CMS. This page will guide you through the installation process.</p>
            </header>

            <main class="content">
                <p>Before getting started, the application needs some information on the database from you. You will need to know the following items before proceeding:</p>

                <ul>
                    <li>Database name (can be non-existent)</li>
                    <li>Hostname</li>
                    <li>User</li>
                    <li>Password</li>
                </ul>

                <p>These must be pre-configured on your <code>.env</code> file. If the database does not exist, the application will try to create one based on the name given in the <code>.env</code> file. Note that the <em>database user</em> must have the appropriate permissions.</p>

                <p>If you don't have the information above, you may have to contact your Web Host to supply them for you.</p>

                <hr>
                <a href="<?php echo e(route('installation.next')); ?>" class="btn btn-primary">Proceed</a>
                <p><small><em><strong>By clicking the button</strong>, you agree to <strong>Pluma&trade;</strong>'s <a href="#">Terms and Conditions</a>.</em></small></p>
                <hr>

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