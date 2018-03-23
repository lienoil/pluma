<v-layout row wrap>
    <v-flex xs4>
        <v-subheader>{{ __('Description') }}</v-subheader>
    </v-flex>
    <v-flex xs8>
        <v-select
            auto
            clearable
            append-icon="keyboard_arrow_down"
            v-model="resource.item.category_id"
            :input-value="resource.item.category_id"
            item-value="id"
            item-text="name"
            label="{{ __('Category') }}"
            :items="attributes.categories">
        </v-select>
        <input type="hidden" name="category_id" :value="resource.item.category_id">
    </v-flex>
</v-layout>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    attributes: {
                        categories: JSON.parse('{!! json_encode($categories) !!}'),
                    },
                    item: {
                        //
                    }
                }
            },
        });
    </script>
@endpush
