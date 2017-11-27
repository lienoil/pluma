<v-card class="elevation-1 mb-3">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="subheading accent--text">{{ __('Page Attributes') }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
        <v-select v-model="resource.template" item-value="value" item-text="name" label="{{ __('Page Template') }}" :items="templates"></v-select>
        <input type="hidden" name="template" :value="resource.template">
    </v-card-text>
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
        mixins.push({
            data () {
                return {
                    templates: [],
                }
            },
            mounted () {
                // templates
                this.templates = {!! json_encode($templates) !!};
            },
        });
    </script>
@endpush
