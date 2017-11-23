{{-- Inline template --}}
<script type="text/x-template" id="template-draggable">
    <draggable @change="end" :list="items" :options="options" class="sortable-container">
        <div :key="i" v-for="(t,i) in items" :data-id="t.id" class="mb-3 draggable sortable-handle">
            <v-card tile class="elevation-1">
                <v-card-text>
                    <div class="subheading" v-html="t.title"></div>
                    <div class="caption" v-html="`{{ __('ID:') }} ${t.id}`"></div>
                    <div class="caption" v-html="`{{ __('Parent:') }} ${t.parent_id}`"></div>
                    <div class="caption"><a target="_blank" :href="`{{ url('/') }}/${t.slug}`">{{ url('/') }}/<span v-html="t.slug"></span></a></div>
                </v-card-text>
            </v-card>
            <div class="bordered--ant ml-4">
                {{-- <span v-html="t.children"></span> --}}
                <local-draggable @change="end" :items="t.children" :options="options"></local-draggable>
            </div>
        </div>
    </draggable>
</script>

<draggable @change="end" v-model="items" :options="options" class="sortable-container">
    {{-- <transition-group> --}}
        <div :key="i" v-for="(t,i) in items" :data-id="t.id" class="mb-3 draggable sortable-handle">
            <v-card tile class="elevation-1">
                <v-card-text>
                    <div class="subheading" v-html="t.title"></div>
                    <div class="caption" v-html="`{{ __('ID:') }} ${t.id}`"></div>
                    <div class="caption" v-html="`{{ __('Parent:') }} ${t.parent_id}`"></div>
                    <div class="caption"><a target="_blank" :href="`{{ url('/') }}/${t.slug}`">{{ url('/') }}/<span v-html="t.slug"></span></a></div>
                </v-card-text>
            </v-card>
            <div class="bordered--ant ml-4">
                <local-draggable @change="end" v-model="t.children" :options="options"></local-draggable>
            </div>
        </div>
    {{-- </transition-group> --}}
</draggable>

@push('css')
    <style>
        .bordered--ant {
            border-left: 1px dashed rgba(0,0,0, 0.2) !important;
            border-bottom: 1px dashed rgba(0,0,0, 0.2) !important;
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
            props: ['items', 'options'],
            methods: {
                end (items) {
                    items = this.items.length ? this.items : items;
                    for (var i = 0; i < items.length; i++) {
                        // items[i].parent_id = 'root';
                        for (var j = 0; j < items[i].children.length; j++) {
                            items[i].children[j].parent_id = items[i].title;
                        }
                    }
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
                }
            },
            methods: {
                end (items) {
                    items = this.items.length ? this.items : items;
                    for (var i = 0; i < items.length; i++) {
                        items[i].parent_id = 'root';
                        for (var j = 0; j < items[i].children.length; j++) {
                            items[i].children[j].parent_id = items[i].title;
                        }
                    }
                },
                change (evt) {
                    if (evt.moved) {
                        let moved = evt.moved;
                        moved.element.parent_id = 9;
                    } else if (evt.removed) {
                        // it was removed
                    } else {
                        let added = evt.added;
                        added.element.parent_id = 'root';
                    }
                    // commit(cat.id, cat);
                    console.log(evt);
                }
            },
            mounted () {
                this.items = {!! json_encode($items) !!};
                console.log(this.items);
            }
        });
    </script>
@endpush
