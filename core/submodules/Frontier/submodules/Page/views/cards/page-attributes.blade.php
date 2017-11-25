{{-- Inline template --}}
<script type="text/x-template" id="template-draggable">
    <draggable :move="moved" @change="move" :list="items" :options="options" class="sortable-container">
        <div :key="i" v-for="(t,i) in items" class="draggable" :class="{'sortable-handle': (t.new?t.new:false)}">
            <v-card tile class="elevation-1" :dark="t.new" :class="{'accent white--text': t.new}">
                <v-card-text>
                    <input type="hidden" v-if="t.new" name="parent_id" :value="t.parent_id">
                    <input type="hidden" v-if="t.new" name="sort" :value="i">
                    <input type="hidden" v-if="t.new" :value="t.slug">
                    <strong class="subheading"><v-icon dark left>drag_handle</v-icon><span v-html="`${t.title?t.title:'No Title'}`"></span></strong>
                    <div v-if="t.new" class="caption"><span v-html="`{{ __('Parent:') }} ${t.parent_name}`"></span></div>
                    <em v-if="t.new" class="caption">{{ __("Drag to set parent") }}</em>
                </v-card-text>
            </v-card>
            <div class="bordered--ant ml-4">
                <local-draggable @changed="changed" :resource="resource" :items="t.children" :options="options"></local-draggable>
            </div>
        </div>
    </draggable>
</script>

<v-card class="elevation-1 mb-3">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="subheading accent--text">{{ __('Page Attributes') }}</v-toolbar-title>
    </v-toolbar>
    <v-expansion-panel class="grey lighten-4 elevation-0">
        <v-expansion-panel-content>
            <div slot="header" class="subheading">{{ __('Parent and Order') }}</div>
            <v-card-text class="grey lighten-4">
                <local-draggable @changed="changed" :resource="resource" :items="items" :options="options"></local-draggable>
                <template v-if="!items.length">
                    <div class="grey--text caption text-xs-center">{{ __('No other pages yet') }}</div>
                </template>
                <template v-else>
                    <div class="grey--text caption text-xs-right">
                        <a target="_blank" href="{{ route('menus.index') }}">{{ __('Manage Menus') }}</a>
                    </div>
                </template>
            </v-card-text>
        </v-expansion-panel-content>

        <v-expansion-panel-content>
            <div slot="header" class="subheading">{{ __('Page Template') }}</div>
            <v-card-text>
                <v-select v-model="resource.template" item-value="value" item-text="name" label="{{ __('Template') }}" :items="templates"></v-select>
                <input type="hidden" name="template" :value="resource.template">
            </v-card-text>
        </v-expansion-panel-content>
    </v-expansion-panel>
    {{-- <v-card-text class="grey lighten-4">

    </v-card-text> --}}
</v-card>

@push('css')
    <style>
        .sortable-container {
            min-height: 20px !important;
        }

        .bordered--ant {
            border-left: 1px dashed rgba(0,0,0, 0.2) !important;
            /*border-bottom: 1px dashed rgba(0,0,0, 0.2) !important;*/
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script>
        let localDraggable = {
            name: 'local-draggable',
            model: {prop: 'items'},
            template: '#template-draggable',
            props: ['items', 'options', 'resource'],
            methods: {
                moved (evt) {
                    if (! evt.draggedContext.element.new) {
                        return false;
                    }
                },
                changed (items, evt) {
                    this.$emit('changed', this.items, evt);
                    this.$emit('input', this.items);
                },
                move (evt, origEvt) {
                    this.$emit('changed', this.items, evt);
                    this.$emit('input', this.items);
                },
            }
        }

        mixins.push({
            components: {'local-draggable': localDraggable},
            data () {
                return {
                    options: {
                        animation: 150,
                        draggable: '.draggable',
                        group: {name: 'pages'},
                        forceFallback: true,
                    },
                    items: [],
                    templates: [],
                }
            },
            methods: {
                update (items, parent) {
                    let branch = [];

                    items = items ? items : this.items;
                    parent = parent ? parent : {id: null, title: 'root', slug: ''};

                    for (var i = 0; i < items.length; i++) {
                        let current = items[i];
                        if (current.children) {
                            current.children = this.update(current.children, {id: current.id, title: current.title, slug: current.slug});
                        }

                        current.parent_id = parent.id;
                        current.parent_name = parent.title;
                        current.slug = parent.slug + (parent.slug?'/':'') + current.code;

                        branch.push(current);
                    }

                    return branch;
                },
                changed (items, evt) {
                    this.items = this.update(items);
                },
            },
            mounted () {
                let items = {!! json_encode($items) !!};
                items = items.length ? [this.resource].concat(items) : [];
                this.items = this.update(items);

                // templates
                this.templates = {!! json_encode($templates) !!};
            },
        });
    </script>
@endpush
