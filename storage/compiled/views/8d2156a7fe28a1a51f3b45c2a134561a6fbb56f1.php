<?php echo $__env->yieldContent("pre-utilitybar"); ?>
<v-toolbar
    :class="theme.utilitybar"
    class="elevation-1 grey--text"
    fixed
    :dark.sync="light" :light.sync="dark"
>
    <v-toolbar-side-icon class="grey--text" @click.stop="setStorage('sidebar.drawer', (sidebar.drawer = !sidebar.drawer))">
        
    </v-toolbar-side-icon>
    <v-toolbar-title><?php $__env->startSection("page-title"); ?><?php echo e(__($application->page->title)); ?><?php echo $__env->yieldSection(); ?></v-toolbar-title>

    <v-spacer></v-spacer>

    <?php echo $__env->yieldPushContent("utilitybar"); ?>

    <?php $__env->startSection("utilitybar-menu"); ?>
        
        <v-menu offset-y origin="bottom right" min-width="180px">
            <v-list-tile-title slot="activator" flat :dark.sync="dark" :light.sync="light">
                <?php echo e(isset($application->greet) ? $application->greet : __("Hello, ") . user()->displayname); ?>

            </v-list-tile-title>
            <v-list>
                
                <v-list-tile href="<?php echo e('#'); ?>">
                    <v-list-tile-action>
                        <v-icon>account_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title><?php echo e(__('Profile')); ?></v-list-tile-title>
                </v-list-tile>

                <v-divider></v-divider>
                <v-list-tile href="<?php echo e(route('logout.logout')); ?>">
                    <v-list-tile-action>
                        <v-icon>backspace</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title><?php echo e(__('Logout')); ?></v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu>
    <?php echo $__env->yieldSection(); ?>

    <v-btn icon class="grey--text" @click.native.stop="rightsidebar.model = !rightsidebar.model">
        <v-icon :dark.sync="dark" :light.sync="light">chevron_left</v-icon>
    </v-btn icon>
</v-toolbar>
<?php echo $__env->yieldContent("post-utilitybar"); ?>
