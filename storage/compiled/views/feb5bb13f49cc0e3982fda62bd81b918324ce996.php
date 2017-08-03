<?php $__env->startSection("head-title", __('Permissions')); ?>
<?php $__env->startSection("page-title", __('Permissions')); ?>

<?php $__env->startPush("utilitybar"); ?>
    <a class="btn btn--raised primary white--text" href="<?php echo e(route('permissions.refresh')); ?>">Refresh</a>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <v-layout row wrap>
        <v-flex>

            <v-card>
                <v-card-title>
                    <span><?php echo e(__('Permissions')); ?></span>
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                    <a class="btn btn--raised primary white--text" href="<?php echo e(route('permissions.refresh')); ?>">Refresh</a>
                </v-card-title>
                <v-data-table
                    v-bind:headers="headers"
                    v-bind:items="items"
                    v-bind:search="search"
                >
                    <template slot="items" scope="prop">
                        <td><strong>{{ prop.item.name }}</strong></td>
                        <td>{{ prop.item.code }}</td>
                        <td>{{ prop.item.description }}</td>
                        <td>{{ prop.item.created }}</td>
                    </template>
                </v-data-table>
            </v-card>

        </v-flex>
    </v-layout>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('pre-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    search: '',
                    pagination: {},
                    headers: [
                        { text: '<?php echo e(__("Title")); ?>', align: 'left', value: 'title' },
                        { text: '<?php echo e(__("Slug")); ?>', align: 'center', value: 'slug' },
                        { text: '<?php echo e(__("Excerpt")); ?>', align: 'center', value: 'excerpt' },
                        { text: '<?php echo e(__("Last Modified")); ?>', align: 'center', value: 'modified' },
                    ],
                    items: [],
                    permissions: null,
                };
            },
            methods: {
                getAllPermissions: function () {
                    this.$http.get('/api/permissions/all?paginate=15&next=1').then((response) => {
                        this.items = response.data.data;
                    });
                },
            },
            mounted () {
                this.getAllPermissions();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>