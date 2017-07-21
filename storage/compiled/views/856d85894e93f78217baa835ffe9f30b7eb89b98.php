<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(isset($menu->is_header) && $menu->is_header): ?>
        <v-layout
            row
            align-center
        >
            <v-flex xs6>
                <v-subheader><?php echo e(isset($menu->text) ? $menu->text : ''); ?></v-subheader>
            </v-flex>
        </v-layout>

    <?php else: ?>

        <?php if($menu->has_children): ?>
            <v-list-group v-model="navigation">
                <v-list-tile slot="item" class="<?php echo e($menu->active ? 'list--group__header--active' : ''); ?>">
                    <?php if(isset($menu->icon)): ?>
                        <v-list-tile-action>
                            <v-icon :dark.sync="dark" :light.sync="light"><?php echo e($menu->icon); ?></v-icon>
                        </v-list-tile-action>
                    <?php endif; ?>

                    <v-list-tile-content>
                        <v-list-tile-title>
                            <?php if(isset($menu->has_children) && $menu->has_children): ?>
                                <?php echo e($menu->labels->title); ?>

                            <?php else: ?>
                                <a role="button" href="<?php echo e($menu->slug); ?>"><?php echo e(isset($menu->labels) ? $menu->labels->title : ''); ?></a>
                            <?php endif; ?>
                        </v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <v-icon @click="() => {menu.open = !menu.open}">{{ menu.open ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                    </v-list-tile-action>
                </v-list-tile>

                <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <v-list-tile href="<?php echo e($menu->slug); ?>" class="<?php echo e($menu->active ? 'primary' : ''); ?>">
                        <?php if(isset($menu->icon)): ?>
                            <v-icon :dark.sync="dark" :light.sync="light"><?php echo e($menu->icon); ?></v-icon>
                        <?php endif; ?>
                        <?php echo e($menu->labels->title); ?>

                    </v-list-tile>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </v-list-group>

        <?php else: ?>

            <v-list-tile href="<?php echo e($menu->slug); ?>" class="<?php echo e($menu->active ? 'primary' : ''); ?>">
                <?php if(isset($menu->icon)): ?>
                    <v-list-tile-action>
                        <v-icon :dark.sync="dark" :light.sync="light"><?php echo e($menu->icon); ?></v-icon>
                    </v-list-tile-action>
                <?php endif; ?>

                <v-list-tile-content>
                    <v-list-tile-title <?php echo e(isset($menu->has_children) && ! $menu->has_children ? 'slot="item"' : ''); ?>>
                        <?php echo e($menu->labels->title); ?>

                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

        <?php endif; ?>

    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->startPush('post-css'); ?>
    <style>
        .application .navigation-drawer a {
            text-decoration: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>
