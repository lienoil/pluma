<v-breadcrumbs icons divider="chevron_right" class="grey lighten-4">
    <v-breadcrumbs-item
        :disable="breadcrumb.active"
        :href="breadcrumb.url"
        :key="breadcrumb.name"
        v-for="breadcrumb in breadcrumbs"
    >
        <small>@{{ breadcrumb.label }}</small>
    </v-breadcrumbs-item>
</v-breadcrumbs>

@push('pre-scripts')
    <script>
        mixins.push({
            data: {
                breadcrumbs: {!! json_encode($navigation->breadcrumbs->collect) !!},
            }
        });
    </script>
@endpush
