<?php $__env->startSection("head-title", __('Grants')); ?>
<?php $__env->startSection("page-title", __('Grants')); ?>

<?php $__env->startPush("utilitybar"); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <?php echo $__env->make("Frontier::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <v-layout row wrap>
        <v-flex sm4 xs12>
            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong><v-icon class="primary--text">build</v-icon><?php echo e(__("Automatic Grant-Permission Provisioning")); ?></strong></v-card-title>
                <v-card-text>
                    <form action="<?php echo e(route('grants.refresh.refresh')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <p class="grey--text"><?php echo e(__("Performing this action will automate most of the process of creating and grouping a collection of permissions into Grants. It will base its provisioning on the permissions configuration on each Modules installed.")); ?></p>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">
                                <span v-tooltip:bottom="{'html': 'Doing this action is relatively safe'}">
                                    Start
                                </span>
                            </button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>

            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong><?php echo e(__("New Grant")); ?></strong></v-card-title>
                <v-card-text>
                    <form action="<?php echo e(route('grants.store')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <p class="grey--text"><?php echo e(__("Need to add a new fine-tuned Grant? Use the form below.")); ?></p>
                        <v-text-field
                            label="<?php echo e(_('Name')); ?>"
                            value="<?php echo e(old('name')); ?>"
                            name="name"
                            v-model="resource.name"
                        ></v-text-field>
                        <v-text-field
                            label="<?php echo e(_('Code')); ?>"
                            :value="resource.name | slugify"
                            name="code"
                            persistent-hint
                            hint="<?php echo e(__('Will be used as an ID for Granting Roles. Make sure the code is unique.')); ?>"
                        ></v-text-field>
                        <v-text-field
                            label="<?php echo e(_('Short Description')); ?>"
                            value="<?php echo e(old('description')); ?>"
                            name="description"
                        ></v-text-field>

                        <v-dialog v-model="dialog.model" width="50%">
                            <a role="button" white flat slot="activator" class="ma-0 pa-0">Choose Permissions...</a>
                            <v-card>
                                <v-card-title class="headline">
                                    <span><?php echo e(_("Permissions List")); ?></span>
                                    <v-spacer></v-spacer>
                                    <v-text-field
                                        append-icon="search"
                                        label="<?php echo e(__('Search')); ?>"
                                        single-line
                                        hide-details
                                        v-model="permissions.search"
                                    ></v-text-field>
                                    <v-slide-x-transition>
                                        <v-btn
                                            @click.native="permissions.search = ''"
                                            icon
                                            light
                                            v-show="permissions.search"
                                            v-tooltip:bottom="{'html': 'Clear Search'}"
                                        >
                                            <v-icon>clear</v-icon>
                                        </v-btn>
                                    </v-slide-x-transition>
                                </v-card-title>
                                <v-data-table
                                    :loading="loading"
                                    class="elevation-0"
                                    no-data-text="<?php echo e(_('No resource found')); ?>"
                                    select-all
                                    selected-key="id"
                                    v-bind:search="permissions.search"
                                    v-bind:headers="permissions.headers"
                                    v-bind:items="permissions.items"
                                    v-model="permissions.selected"
                                >
                                    <template slot="items" scope="prop">
                                        <td>
                                            <v-checkbox
                                                primary
                                                hide-details
                                                v-model="prop.selected"
                                                class="pa-0"
                                                
                                                
                                            ></v-checkbox>
                                        </td>
                                        <td>{{ prop.item.name }}</td>
                                        <td>{{ prop.item.code }}</td>
                                        <td>{{ prop.item.description }}</td>
                                    </template>
                                </v-data-table>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn class="grey--text darken-1" flat @click.native="dialog.model = false">Cancel</v-btn>
                                    <v-btn class="primary--text darken-1" flat @click.native="dialog.model = false">Okay</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>

                        <template v-if="permissions.selected">
                            <span v-for="(item, i) in permissions.selected">
                                <input type="hidden" name="permissions[]" :value="item.id">
                                <v-chip close v-model="item.selected" @input="permissions.selected.splice(i, 1)"><strong>{{ item.name }}</strong> - {{ item.code }}</v-chip>
                            </span>
                        </template>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">
                                Submit
                            </button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>

        </v-flex>
        <v-flex sm8 xs12>
            <v-card class="mb-3">
                <v-card-title>
                    
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="<?php echo e(_('Search')); ?>"
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
                    select-all
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
                        <td>
                            <v-checkbox
                                primary
                                hide-details
                                v-model="prop.selected"
                            ></v-checkbox>
                        </td>
                        <td>{{ prop.item.id }}</td>
                        <td><strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">{{ prop.item.name }}</strong></td>
                        <td>{{ prop.item.code }}</td>
                        <td>{{ prop.item.description }}</td>
                        <td class="text-xs-right">
                            <span v-tooltip:bottom="{'html': 'Number of permissions associated'}">{{ prop.item.permissions.length }}</span>
                        </td>
                        <td>{{ prop.item.created }}</td>
                        <td width="30%">
                            
                            <v-btn @click.native="route(urls.grants.edit, (prop.item.id))" icon flat v-tooltip:bottom="{'html': 'Edit'}"><v-icon>edit</v-icon></v-btn>

                            <form :action="route(urls.grants.destroy, (prop.item.id))" method="POST" class="inline">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('DELETE')); ?>

                                <button type="submit" v-tooltip:bottom="{'html': 'Move to Trash'}" class="btn btn--icon btn--flat"><span class="btn__content"><v-icon>delete</v-icon></span></button>
                            </form>
                        </td>
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
                    urls: {
                        grants: {
                            edit: '<?php echo e(route('grants.edit', 'null')); ?>',
                            destroy: '<?php echo e(route('grants.destroy', 'null')); ?>',
                        },
                    },
                    grants: {
                        dialog: {
                            model: false,
                        },
                    },
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
                        { text: '<?php echo e(__("Permissions")); ?>', align: 'left', value: 'permissions' },
                        { text: '<?php echo e(__("Last Modified")); ?>', align: 'left', value: 'updated_at' },
                        { text: '<?php echo e(__("Actions")); ?>', align: 'center', sortable: false, value: 'updated_at' },
                    ],
                    dataset: [],
                    resource: {
                        name: '',
                        code: '',
                        description: '',
                        model: '',
                    },
                    permissions: {
                        headers: [
                            { text: '<?php echo e(__("Name")); ?>', align: 'left', value: 'name' },
                            { text: '<?php echo e(__("Code")); ?>', align: 'left', value: 'code' },
                            { text: '<?php echo e(__("Excerpt")); ?>', align: 'left', value: 'description' },
                        ],
                        search: '',
                        selected: [],
                        items: [],
                    },
                };
            },
            watch: {
                search (filter) {
                    setTimeout(() => {
                        let self = this;
                        this.searchFromAPI('<?php echo e(route('api.grants.search')); ?>', filter)
                            .then((data) => {
                                console.log("watch.search", data);
                                self.dataset = data.items;
                                self.totalItems = data.total;
                            });
                    }, 1000);
                },

                pagination: {
                    handler () {
                        this.getDataFromAPI('<?php echo e(route('api.grants.all')); ?>')
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
                test () {
                    console.log("TEST", this.permissions.selected);
                },

                submit (url, query) {
                    url = url.split('null').join(query);
                    this.target.submit();
                },

                route (url, query) {
                    return url.split('null').join(query);
                    // window.location = url;
                },

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

                postResource (url, query) {
                    return new Promise((resolve, reject) => {
                        query = query ? query : {};
                        this.$http.post(url, query).then((response) => {
                            let items = response.body;
                            let total = response.body.total ? response.body.total : response.body.length;
                            resolve({items, total});
                        });
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
                this.getDataFromAPI('<?php echo e(route('api.grants.all')); ?>')
                    .then((data) => {
                        self.dataset = data.items;
                        self.totalItems = data.total;
                    });

                this.postResource('<?php echo e(route('api.grants.permissions')); ?>')
                    .then((data) => {
                        // let items = [];
                        // for (var i = data.items.length - 1; i >= 0; i--) {
                        //     console.log(data.items[i].name);
                        //     items.push({header: data.items[i].name});
                        //     for (var j = data.items[i].permissions.length - 1; j >= 0; j--) {
                        //         items.push(data.items[i].permissions[j]);
                        //     }
                        // }
                        self.permissions.items = data.items;
                    });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>