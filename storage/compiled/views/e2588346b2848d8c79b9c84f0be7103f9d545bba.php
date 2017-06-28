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
                <h2 class="header-title mt-5">Pluma&trade; | <span class="text-muted">Install</span></h2>
                <p class="lead">You are about to install <strong>Pluma&trade;</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque mollitia architecto omnis quae! Debitis, laboriosam, quos. Quae, et dignissimos est voluptate quo temporibus recusandae voluptatem at! Voluptatem illum ea quidem..</p>
            </header>

            <main class="content">
                <?php echo $__env->make("Install::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <form action="<?php echo e(route('installation.install')); ?>" class="form" method="POST">
                    <hr>

                    <div class="form-block p-b-3">
                        <legend>All right, Sparky!</legend>
                        <p class="text-muted">Choose your email and password, then install.</p>
                    </div>

                    <div class="form-block">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Email</strong></label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Password</strong></label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-block">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <small class="text-muted">Installing will also migrate and seed the database. It may take several minutes.</small>
                            </div>
                            <div class="col-md-6">
                                <button role="button" type="submit" class="btn btn-primary float-right">Install</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>

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