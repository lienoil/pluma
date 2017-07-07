<aside class="mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
    
    <span class="mdl-layout-title"><?php echo e(__($application->site->title)); ?></span>

    
    <?php echo $__env->make("Frontier::templates.navigations.sidebar", ['menus' => collect($navigation->sidebar->collect)], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</aside>
