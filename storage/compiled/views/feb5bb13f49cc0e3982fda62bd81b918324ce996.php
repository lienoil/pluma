<?php $__env->startSection("head-title", __('Permissions')); ?>
<?php $__env->startSection("page-title", __('Permissions')); ?>

<?php $__env->startPush("utilitybar"); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Frontier::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <v-layout row wrap>
        <v-flex sm8>
            <v-card class="mb-3">
                <v-card-title>
                    
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permissions')): ?>
                    <v-btn icon light v-tooltip:bottom="{'html': 'Bulk Delete'}"><v-icon>delete</v-icon></v-btn>
                    <?php endif; ?>
                </v-card-title>
                <v-data-table
                    :loading="loading"
                    :total-items="totalItems"
                    class="elevation-0"
                    
                    selected-key="id"
                    v-bind:headers="headers"
                    v-bind:items="dataset"
                    v-bind:pagination.sync="pagination"
                    v-model="selected"
                >
                    <template slot="headerCell" scope="props">
                        <span v-tooltip:bottom="{'html': props.header.text}">
                            {{ props.header.text }}
                        </span>
                    </template>
                    <template slot="items" scope="prop">
                        
                        <td>{{ prop.item.id }}</td>
                        <td><strong>{{ prop.item.name }}</strong></td>
                        <td>{{ prop.item.code }}</td>
                        <td>{{ prop.item.description }}</td>
                        <td>{{ prop.item.created }}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
        <v-flex sm4>
            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong><?php echo e(__("Refresh Permissions")); ?></strong></v-card-title>
                <v-card-text>
                    <form action="<?php echo e(route('permissions.refresh.refresh')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <p class="grey--text"><?php echo e(__("Refreshing will add and/or update all new permissions specified by the modules you've installed. Existing permissions will not be removed. Doing this action is relatively safe.")); ?></p>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">Refresh</button>
                        </div>
                        
                    </form>
                </v-card-text>
            </v-card>

            <v-card class="error mb-3" dark>
                <v-card-title><strong><v-icon>priority_high</v-icon><?php echo e(__("Reset Permissions")); ?></strong></v-card-title>
                <v-card-text>
                    <form action="<?php echo e(route('permissions.refresh.refresh')); ?>" method="POST" class="text-sm-right">
                        <?php echo e(csrf_field()); ?>

                        <p><?php echo e(__("Resetting will remove all existing permissions from the database. Then it will re-populate the database with all of the permissions defined from the modules you've installed. Doing this will not reset the roles you've created - you have to manually redefine each roles again. Proceed with caution!")); ?></p>
                        <button type="submit" class="btn btn--raised white ma-0">Reset</button>
                    </form>
                </v-card-text>
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
                    loading: true,
                    totalItems: 0,
                    search: null,
                    selected: [],
                    pagination: {
                        rowsPerPage: 5,
                    },
                    headers: [
                        { text: '<?php echo e(__("ID")); ?>', align: 'left', value: 'id' },
                        { text: '<?php echo e(__("Title")); ?>', align: 'left', value: 'name' },
                        { text: '<?php echo e(__("Code")); ?>', align: 'left', value: 'code' },
                        { text: '<?php echo e(__("Excerpt")); ?>', align: 'left', value: 'description' },
                        { text: '<?php echo e(__("Last Modified")); ?>', align: 'left', value: 'updated_at' },
                    ],
                    dataset: [],
                };
            },
            watch: {
                search (filter) {
                    setTimeout(() => {
                        let self = this;
                        this.searchFromAPI('<?php echo e(route('api.permissions.search')); ?>', filter)
                            .then((data) => {
                                console.log("watch.search", data);
                                self.dataset = data.items;
                                self.totalItems = data.total;
                            });
                    }, 1000);
                },

                pagination: {
                    handler () {
                        this.getDataFromAPI('<?php echo e(route('api.permissions.all')); ?>')
                            .then((data) => {
                                console.log("watch.pagination", data);
                                self.dataset = data.items;
                                self.totalItems = data.total;
                            });
                    },
                    deep: true
                },
            },
            methods: {
                searchFromAPI (url, query) {
                    return new Promise((resolve, reject) => {
                        const {
                            sortBy,
                            descending,
                            page,
                            rowsPerPage,
                            totalItems
                        } = this.pagination;

                        url = url+'?take='+(rowsPerPage)+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+'&q='+(query);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.totalItems;

                        resolve({items, total});
                    });
                },

                getDataFromAPI (url) {
                    return new Promise((resolve, reject) => {
                        const {
                            sortBy,
                            descending,
                            page,
                            rowsPerPage,
                            totalItems
                        } = this.pagination;

                        url = url+'?take='+rowsPerPage+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.totalItems;

                        resolve({items, total});
                    });
                },

                getDataset () {
                    return this.dataset;
                },

                setDataset (url) {
                    let self = this;
                    this.loading = true;

                    this.$http.get(url)
                        .then((response) => {
                            // console.log("setDataset", response);
                            self.dataset = response.body.data;
                            self.totalItems = response.body.total;

                            setTimeout(() => {
                                this.loading = false;
                            }, 1000);
                        });
                },
            },
            mounted () {
                let self = this;
                this.getDataFromAPI('<?php echo e(route('api.permissions.all')); ?>')
                    .then((data) => {
                        self.dataset = data.items;
                        self.totalItems = data.total;
                    });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>