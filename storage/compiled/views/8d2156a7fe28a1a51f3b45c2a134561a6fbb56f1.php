<v-toolbar
    :class="theme.utilitybar"
    class="elevation-1 grey--text"
    :dark.sync="light" :light.sync="dark"
    fixed
>
    <v-toolbar-side-icon class="grey--text" @click.native.stop="setStorage('sidebar.drawer', (sidebar.drawer = !sidebar.drawer))">
        <v-icon :dark.sync="dark" :light.sync="light">{{ sidebar.drawer?'chevron_right':'chevron_left' }}</v-icon>
    </v-toolbar-side-icon>
    <v-toolbar-title><?php $__env->startSection("page-title"); ?><?php echo e($application->page->title); ?><?php echo $__env->yieldSection(); ?></v-toolbar-title>
    <v-spacer></v-spacer>
    <?php echo $__env->yieldPushContent("utilitybar"); ?>
    <v-btn icon class="grey--text" @click.native.stop="rightsidebar.model = !rightsidebar.model">
        <v-icon :dark.sync="dark" :light.sync="light">chevron_left</v-icon>
    </v-btn icon>
</v-toolbar>
