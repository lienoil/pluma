<?php if($menus->count()): ?>
    <nav role="navigation" class="mdl-navigation" data-depth="<?php echo e(isset($depth) ? $depth : $depth = 1); ?>">
        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="mdl-navigation__link" href="<?php echo e(url($menu->slug)); ?>"><?php echo e($menu->labels->title); ?></a>
            <?php if($menu->has_children): ?>
                <?php echo $__env->make("Frontier::templates.navigations.sidebar", ['menus' => collect($menu->children), 'depth' => ++$depth], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
<?php endif; ?>
