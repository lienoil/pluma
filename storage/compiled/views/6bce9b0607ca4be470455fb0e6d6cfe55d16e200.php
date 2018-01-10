<v-breadcrumbs icons divider="chevron_right" class="grey lighten-4 caption" style="justify-content: flex-start;">
    <?php $__env->startSection("breadcrumbs"); ?>
    <v-breadcrumbs-item
        :disable="! breadcrumb.active"
        :href="breadcrumb.url"
        :key="breadcrumb.name"
        v-for="breadcrumb in breadcrumbs"
        class="caption inline"
        ripple
    >
        <small class="ma-0 caption" :class="breadcrumb.active && !breadcrumb.last ? 'info--text' : 'grey--text'">{{ breadcrumb.label }}</small>
    </v-breadcrumbs-item>
    <?php echo $__env->yieldSection(); ?>
</v-breadcrumbs>

<?php $__env->startPush('pre-scripts'); ?>
    <script>
        <?php if(isset($navigation)): ?>
        mixins.push({
            data: {
                breadcrumbs: <?php echo json_encode($navigation->breadcrumbs->collect); ?>,
            }
        });
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
