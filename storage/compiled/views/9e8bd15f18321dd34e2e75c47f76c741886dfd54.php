<?php $__env->startSection("content"); ?>

    <div class="mdl-layout mdl-layout--fixed-header mdl-js-layout  mdl-color--grey-100">
        <main class="mdl-layout__content main_content" role="presentation">
            <div class="mdl-card mdl-grid mdl-shadow--2dp">
                <header class="mdl-card__title mdl-card--expand">
                    <h3 class="mdl-card__title-text">Login</h3>
                </header>
                <div class="mdl-cell mdl-cell--12-col cell_con">
                    <i class="material-icons">person</i>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        
                        <input id="username" class="mdl-textfield__input" type="text">
                        <label for="username" class="mdl-textfield__label">Username</label>
                        
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--12-col cell_con">
                    <i class="material-icons">lock</i>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input id="password" class="mdl-textfield__input" type="password">
                        <label for="password" class="mdl-textfield__label">Enter Password</label>
                    </div>
                </div>

                <div class="mdl-cell cell_con">
                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
                        <input type="checkbox" id="checkbox-2" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Remember Me</span>
                    </label>
                </div>

                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary btn">Login</button>
                </div>

                <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
                    <a class="mdl-button--primary">Register now !</a>
                </div>

                <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
                    <a class="mdl-button--primary">Forgot password ?</a>
                </div>

            </div>
        </main>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>