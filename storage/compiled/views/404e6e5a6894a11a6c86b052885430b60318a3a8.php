<v-list-tile>
    <?php if(isset($menu->icon)): ?>
        <v-list-tile-action>
            <v-icon :dark.sync="dark" :light.sync="light"><?php echo e($menu->icon); ?></v-icon>
        </v-list-tile-action>
    <?php endif; ?>

    <v-list-tile-content>
        <v-list-tile-title <?php echo e(isset($menu->has_children) && ! $menu->has_children ? 'slot="item"' : ''); ?>>
            <?php if(isset($menu->has_children) && $menu->has_children): ?>
                <?php echo e($menu->labels->title); ?>

            <?php else: ?>
                <span role="button" href="<?php echo e(isset($menu->slug) ? $menu->slug : ''); ?>"><?php echo e(isset($menu->labels) ? $menu->labels->title : ''); ?></span>
            <?php endif; ?>
        </v-list-tile-title>
    </v-list-tile-content>

    <?php if(isset($menu->has_children) && $menu->has_children): ?>
        <v-list-tile-action>
            <v-icon :dark.sync="dark" :light.sync="light">keyboard_arrow_down</v-icon>
        </v-list-tile-action>
    <?php endif; ?>

</v-list-tile>

<!-- if -->
<?php if(isset($menu->has_children) && $menu->has_children): ?>

    <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make("Frontier::templates.navigations.nav-item", ['menu' => collect($child->children), 'depth' => ++$depth], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
