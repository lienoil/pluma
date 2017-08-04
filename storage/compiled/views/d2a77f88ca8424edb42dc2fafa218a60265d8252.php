<?php $__env->startSection("content"); ?>
    <v-layout row wrap>
        <v-flex sm5>
            <draggable v-model="menus" @start="drag=true" @end="drag=false">
                <div v-for="menu in menus">
                    {{menu.title}}
                </div>
            </draggable>
        </v-flex>
    </v-layout>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('pre-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script src="<?php echo e(present('frontier/components/Draggable/dist/vuedraggable.min.js')); ?>"></script>
    <script>
        // Vue.use(VueResource);
        // Vue.use(draggable);
        mixins.push({
            data () {
                return {
                    menus: <?php echo json_encode($menus); ?>

                };
            },
            components: {
                draggable,
            },
            methods: {},
            mounted () {},
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>