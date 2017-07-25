<v-breadcrumbs icons divider="chevron_right" class="grey lighten-4" style="justify-content: flex-start;">
    <v-breadcrumbs-item
        :disable="breadcrumb.active"
        :href="breadcrumb.url"
        :key="breadcrumb.name"
        v-for="breadcrumb in breadcrumbs"
    >
        <small>{{ breadcrumb.label }}</small>
    </v-breadcrumbs-item>
</v-breadcrumbs>

<?php $__env->startPush('pre-scripts'); ?>
    <script>
        mixins.push({
            data: {
                breadcrumbs: <?php echo json_encode($navigation->breadcrumbs->collect); ?>,
            }
        });
    </script>
<?php $__env->stopPush(); ?>
