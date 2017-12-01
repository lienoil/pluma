<form action="{{ route('themes.upload') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <v-dialog width="100vw">
        <v-btn slot="activator" class="white primary--text elevation-1">{{ __('Upload Theme') }}</v-btn>
        <v-card class="elevation-1">
            <v-toolbar card class="transparent">
                <v-toolbar-title class="subheading primary--text">{{ __('Upload Theme') }}</v-toolbar-title>
            </v-toolbar>

            <v-dropzone auto-remove-files :options="{height:'300px',url:'{{ route('api.library.upload') }}', autoProcessQueue:false}" :params="{_token: '{{ csrf_token() }}'}"></v-dropzone>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn type="submit" class="primary white--text">{{ __('Upload') }}</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</form>

@push('css')
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    file: {
                        model: null,
                    }
                }
            }
        })
    </script>
@endpush
