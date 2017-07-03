<header class="mdl-layout__header mdl-layout__header--suppliment">
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title"><?php echo e($application->page->title); ?></span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
            <a role="button" class="mdl-navigation__link" href="">Some</a>
            <a role="button" class="mdl-navigation__link" href="">Utility</a>
            <a role="button" class="mdl-navigation__link" href="">Links</a>
            <a role="button" class="mdl-navigation__link" href="">Profile</a>
        </nav>

        <?php echo $__env->make("Frontier::partials.search", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</header>
