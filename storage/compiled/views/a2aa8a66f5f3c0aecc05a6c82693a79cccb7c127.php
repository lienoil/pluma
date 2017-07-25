<?php $__env->startPush('utilitybar'); ?>
    <v-btn to="<?php echo e(route('pages.create')); ?>" white primary>Create</v-btn>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <v-layout row wrap>
        <v-flex>
            <v-card>
                <v-card-title>
                    <span><?php echo e(__('All Pages')); ?></span>
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                        v-bind:headers="headers"
                        v-bind:items="items"
                        v-bind:search="search"
                    >
                    <template slot="items" scope="page">
                        <td><strong>{{ page.item.title }}</strong></td>
                        <td>{{ page.item.slug }}</td>
                        <td>{{ page.item.excerpt }}</td>
                        <td>{{ page.item.created }}</td>
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
                    { text: 'Title', align: 'left', value: 'title' },
                    { text: 'Slug', value: 'slug' },
                    { text: 'Excerpt', value: 'excerpt' },
                    { text: 'Last Modified', value: 'updated_at' },
                ],
                items: [],
                body: null,
            };
        },
        methods: {
            allPages: function () {
                this.$http.get('/api/pages/all?paginate=15&next=1').then((response) => {
                    console.log(response);
                    this.items = response.data.data;
                    this.body = response.body;
                });
            },
        },
        mounted () {
            this.allPages();
        }
    });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>