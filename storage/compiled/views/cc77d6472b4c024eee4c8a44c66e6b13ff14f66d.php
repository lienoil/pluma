<?php $__env->startSection("content"); ?>
    <div class="mdl-layout mdl-js-layout mdl-color--grey-100 mdl-color--grey-100">
        <div class="mdl-layout__content">
            <main class="mdl-grid" role="presentation">
                <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">

                    <?php echo $__env->make("Frontier::partials.alert", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <form action="<?php echo e(route('register.register')); ?>" method="POST" class="mdl-card mdl-shadow--2dp">
                        <?php echo e(csrf_field()); ?>

                        <header class="mdl-card__title">
                            <h3 class="mdl-card__title-text"><?php echo e(__('Register')); ?>&nbsp;<span class="mdl-color-text--grey-500">| <?php echo e($application->site->title); ?></span></h3>
                        </header>

                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                
                                <input id="email" name="email" type="email" class="mdl-textfield__input" value="<?php echo e(old('email')); ?>">
                                <label for="email" class="mdl-textfield__label"><?php echo e(__('Email')); ?></label>
                                
                            </div>
                            <?php echo $__env->make('Frontier::errors.span', ['field' => 'email'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password" name="password" type="password" class="mdl-textfield__input" value="<?php echo e(old('password')); ?>">
                                <label for="password" class="mdl-textfield__label"><?php echo e(__('Password')); ?></label>
                            </div>
                            <?php echo $__env->make('Frontier::errors.span', ['field' => 'password'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="password_confirmation" name="password_confirmation" type="password" class="mdl-textfield__input" value="<?php echo e(old('password_confirmation')); ?>">
                                <label for="password_confirmation" class="mdl-textfield__label"><?php echo e(__('Confirm Password')); ?></label>
                            </div>
                            <?php echo $__env->make('Frontier::errors.span', ['field' => 'password_confirmation'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>

                        <div class="mdl-card__supporting-text">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect"><?php echo e(__('Register')); ?></button>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo e(route('login.show')); ?>"><small><?php echo e(__('Login')); ?></small></a>
                        </div>
                    </form>

                    <div class="copy">
                        <small class="mdl-color-text--blue-grey-400"><?php echo e($application->site->copyright); ?></small>
                    </div>

                </div>
                <div class="mdl-layout-spacer"></div>
            </main>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>