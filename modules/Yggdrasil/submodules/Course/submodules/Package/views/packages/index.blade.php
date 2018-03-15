@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <pluma-packages
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
            :dropzone-options="{url: '{{ route('api.packages.upload') }}', timeout: '120s', autoProcessQueue: true, parallelUploads: 1, acceptedFiles: 'application/zip,application/rar,application/octet-stream,application/x-rar-compressed,application/x-zip-compressed'}"
            :dropzone-params="{_token: '{{ csrf_token() }}'}"
            :items="{{ json_encode($resources->toArray()) }}"
            catalogue="package"
            title="{{ __('Packages') }}"
        >
            <template slot="empty-state">
                <v-layout row wrap align-end justify-center>
                    <v-flex xs12>
                        <div class="text-xs-center grey--text">
                            <img src="{{ assets('frontier/images/placeholder/zip.png') }}" width="120">
                            <div class="headline">Your library is empty</div>
                            <div class="subheading mb-3">Everything you've uploaded will be here.</div>
                        </div>
                    </v-flex>
                </v-layout>
            </template>
        </pluma-packages>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('package/packages/dist/packages.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('package/packages/dist/packages.min.js') }}"></script>
@endpush
