@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <v-flex sm12 class="pa-4">
            <p class="grey--text">Lorem ipsum dolor sit.</p>
            <p class="subheading">Test for Project-in-Project (PiP) approach</p>
            <p>Page starts after horizontal line.</p>
        </v-flex>
        <v-divider class="mb-4"></v-divider>

        <pluma-packages
            title="{{ __('Packages') }}"
            catalogue="package"
            :headers="[
                {text: '{{ __('ID') }}', value: 'id', align: 'left'},
                {text: '{{ __('Name') }}', value: 'name', align: 'left'},
                {text: '{{ __("File Type") }}', value: 'mimetype', align: 'left'},
                {text: '{{ __("File Size") }}', value: 'size', align: 'left'},
                {text: '{{ __("Uploaded") }}', value: 'created_at', align: 'left'},
                {text: '{{ __("Modified") }}', value: 'updated_at', align: 'left'},
            ]"
            :url="{
                GET: '{{ route('api.packages.paginated') }}',
                UPLOAD: '{{ route('api.packages.upload') }}',
            }"
            :dropzone-options="{url: '{{ route('api.packages.upload') }}', timeout: '120s', autoProcessQueue: true, parallelUploads: 1, acceptedFiles: 'application/zip,application/rar'}"
            :dropzone-params="{_token: '{{ csrf_token() }}'}"
            :items="{{ json_encode($resources->toArray()) }}"
        ></pluma-packages>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('package/packages/dist/packages.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('package/packages/dist/packages.min.js') }}"></script>
@endpush
