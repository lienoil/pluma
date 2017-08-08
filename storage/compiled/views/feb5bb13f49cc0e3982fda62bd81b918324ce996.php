<?php $__env->startSection("head-title", __('Permissions')); ?>
<?php $__env->startSection("page-title", __('Permissions')); ?>

<?php $__env->startPush("utilitybar"); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Frontier::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <v-layout row wrap>
        <v-flex sm8 xs12>
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
                    <v-slide-x-transition>
                        <v-btn
                            @click.native="search = ''"
                            icon
                            light
                            v-show="search"
                            v-tooltip:bottom="{'html': 'Clear Search'}"
                        >
                            <v-icon>clear</v-icon>
                        </v-btn>
                    </v-slide-x-transition>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permissions')): ?>
                    <v-btn icon light v-tooltip:bottom="{'html': 'Bulk Delete'}"><v-icon>delete</v-icon></v-btn>
                    <?php endif; ?>
                </v-card-title>
                <v-data-table
                    :loading="loading"
                    :total-items="totalItems"
                    class="elevation-0"
                    no-data-text="<?php echo e(_('No resource found')); ?>"
                    
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
                        <td><strong v-tooltip:bottom="{'html': prop.item.description}">{{ prop.item.name }}</strong></td>
                        <td>{{ prop.item.code }}</td>
                        <td>{{ prop.item.description }}</td>
                        <td>{{ prop.item.created }}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
        <v-flex sm4 xs12>
            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong><v-icon class="primary--text">refresh</v-icon><?php echo e(__("Refresh Permissions")); ?></strong></v-card-title>
                <v-card-text>
                    <form action="<?php echo e(route('permissions.refresh.refresh')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <p class="grey--text text-sm-right"><?php echo e(__("Refreshing will add and/or update all new permissions specified by the modules you've installed. Existing permissions will not be removed. Doing this action is relatively safe.")); ?></p>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">Refresh</button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>

            
            <v-card class="error mb-3" dark>
                <v-card-title><strong><v-icon>priority_high</v-icon><?php echo e(__("Reset Permissions")); ?></strong></v-card-title>
                <v-card-text>
                    <form id="reset-permissions-form" action="<?php echo e(route('permissions.reset.reset')); ?>" method="POST" class="text-sm-right">
                        <?php echo e(csrf_field()); ?>

                        <p><?php echo e(__("Resetting will remove all existing permissions from the database. Then it will re-populate the database with all of the permissions defined from the modules you've installed. Doing this will not reset the roles you've created - you have to manually redefine each roles again. Proceed with caution!")); ?></p>

                        <v-dialog v-model="dialog.model" width="80%">
                            <v-btn white slot="activator">Reset</v-btn>
                            <v-card class="text-xs-center">
                                <v-card-title class="error white--text headline"><?php echo e(_("Warning, here be dragons")); ?><v-spacer></v-spacer><v-icon class="white--text">priority_high</v-icon></v-card-title>
                                <v-card-text >
                                    <?php echo e(__("Performing this action will completely remove all Permissions data. The Application might not work properly after this action. You might need to setup the Users' Roles, Grants, and Permissions manually again. If you do not know what the message means, then for the love of Talos, DO NOT PROCEED!")); ?>

                                </v-card-text>
                                <v-card-text class="text-xs-center"><strong><?php echo e(__("Would you like to proceed?")); ?></strong></v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn class="green--text darken-1" flat @click.native="dialog.model = false">Cancel</v-btn>
                                    <v-btn class="error--text darken-1" flat @click.native="proceed()">Yes, Proceed</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>

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
                        { text: '<?php echo e(__("Name")); ?>', align: 'left', value: 'name' },
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

                        let query = this.search;
                        url = url+'?take='+rowsPerPage+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+'&q='+(query);
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

                proceed () {
                    document.getElementById("reset-permissions-form").submit();
                }
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