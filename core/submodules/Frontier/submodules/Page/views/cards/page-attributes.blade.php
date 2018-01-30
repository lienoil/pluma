<v-card class="elevation-1 mb-3">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="subheading accent--text">{{ __('Page Attributes') }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
        <v-select v-model="resource.item.template" item-value="value" item-text="name" label="{{ __('Page Template') }}" :items="attributes.templates"></v-select>
        <input type="hidden" name="template" :value="resource.item.template">

        {{-- <v-select auto clearable v-model="resource.item.category_id" :input-value="resource.item.category_id" item-value="id" item-text="name" label="{{ __('Category') }}" :items="attributes.categories"> --}}

            {{-- <template slot="selection" scope="data">
                <v-chip
                    :key="JSON.stringify(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    close
                    @input="data.parent.selectItem(data.item)">
                    <v-avatar>
                        <v-icon v-html="data.item.icon"></v-icon>
                    </v-avatar>
                    <span v-html="data.item.name"></span>
                </v-chip>
            </template> --}}
            {{-- <template slot="item" scope="data">
                <template>
                    <v-list-tile-avatar>
                        <v-icon v-html="data.item.icon"></v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                    </v-list-tile-content>
                </template>
            </template> --}}

        </v-select>
        <input type="text" name="category_id" :value="resource.item.category_id">
    </v-card-text>
</v-card>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    attributes: {
                        templates: {!! json_encode($templates) !!},
                        categories: JSON.parse('{!! json_encode($categories) !!}'),
                    },
                }
            },
        });
    </script>
@endpush
