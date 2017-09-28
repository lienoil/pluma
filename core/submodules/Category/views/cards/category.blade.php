<v-category @search="" class="mb-3" v-model="resource.item.category" :multiple="false" label="{{ __('Category') }}" icon="fa-tag" :list="{{ json_encode($categories) }}">
    <template scope="prop">
        {{-- <span v-html="prop"></span> --}}
        <input type="hidden" name="category" :value="JSON.stringify(prop.item)">
        <input type="hidden" name="category_id" :value="JSON.parse(prop.item ? prop.item : '[]').id">
    </template>
</v-category>

@push('css')
    <link rel="stylesheet" href="{{ assets('category/vuetify-category-card/dist/vuetify-category-card.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('category/vuetify-category-card/dist/vuetify-category-card.min.js') }}"></script>
@endpush
