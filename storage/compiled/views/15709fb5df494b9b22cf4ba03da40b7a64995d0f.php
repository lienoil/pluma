<?php $__env->startSection("content"); ?>
    <div class="mdl-layout mdl-js-layout mdl-color--grey-100 mdl-color--grey-100">
        <div class="mdl-layout__content">
            <main class="mdl-grid" role="presentation">
                <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">

                    <?php echo $__env->make("Frontier::partials.alert", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <form action="<?php echo e(route('login.login')); ?>" method="POST" class="mdl-card mdl-shadow--2dp">
                        <?php echo e(csrf_field()); ?>

                        <header class="mdl-card__title">
                            <h3 class="mdl-card__title-text"><?php echo e(__('Login')); ?>&nbsp;<span class="mdl-color-text--grey-500">| <?php echo e($application->site->title); ?></span></h3>
                        </header>

                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                
                                <input id="username" name="username" type="text" class="mdl-textfield__input" value="<?php echo e(old('username')); ?>">
                                <label for="username" class="mdl-textfield__label"><?php echo e(__('Email')); ?> <?php echo e(__('or')); ?> <?php echo e(__('username')); ?></label>
                                
                            </div>
                            <?php echo $__env->make('Frontier::errors.span', ['field' => 'username'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password" name="password" type="password" class="mdl-textfield__input" value="<?php echo e(old('password')); ?>">
                                <label for="password" class="mdl-textfield__label"><?php echo e(__('Password')); ?></label>
                            </div>
                            <?php echo $__env->make('Frontier::errors.span', ['field' => 'password'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                                <input id="remember" type="checkbox" name="remember" checked="checked" class="mdl-checkbox__input">
                                <span class="mdl-checkbox__label"><?php echo e(__('Remember Me')); ?></span>
                            </label>
                        </div>

                        <div class="mdl-card__supporting-text">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect"><?php echo e(__('Login')); ?></button>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo e(route('register.show')); ?>"><small><?php echo e(__('Register')); ?></small></a>
                            <span class="mdl-layout-spacer"></span>
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="#"><small><?php echo e(__('Forgot Password')); ?>?</small></a>
                        </div>
                    </form>

                    <div class="copy">
                        <small class="mdl-color-text--blue-grey-400"><?php echo e(__($application->site->copyright)); ?></small>
                    </div>

                </div>
                <div class="mdl-layout-spacer"></div>
            </main>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        let dialog = document.querySelector('dialog');
        dialog.showDialog();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>