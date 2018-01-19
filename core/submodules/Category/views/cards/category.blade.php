<v-card class="mb-3 elevation-1">
    <v-toolbar dense card class="transparent">
    	<v-icon class="accent--text">label</v-icon>
        <v-toolbar-title class="subheading accent--text">{{ __('Category') }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
        <v-select
        	:items="resource.categories"
        	hint="{{ __('Select Category') }}"
        	label="{{ __('Category') }}"
        	persistent-hint
        	item-text="name"
        	item-value="id"
        	auto clearable
        	v-model="resource.item.category_id"
        ></v-select>
        <input type="hidden" name="category_id" :value="resource.item.category_id">
    </v-card-text>
</v-card>

@push('pre-scripts')
	<script>
		mixins.push({
			data () {
				return {
					resource: {
						item: {
							category_id: '{{ @(old('category_id') ?? $resource->category->id) }}',
						},
						categories: {!! json_encode($categories->toArray()) !!},
					}
				};
			},
		});
	</script>
@endpush
