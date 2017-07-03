<nav role="navigation" class="mdl-navigation">
    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="mdl-navigation__link" href="<?php echo e(url($menu->slug)); ?>"><?php echo e($menu->labels->title); ?></a>
        <?php if($menu->has_children): ?>
            <?php echo e($this->generateSidebar($menu->children)); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>