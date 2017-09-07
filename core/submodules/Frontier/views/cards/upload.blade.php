<v-card class='elevation-1'>
    <v-toolbar card class="transparent">
        <v-toolbar-title>{{ __('Upload Files') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click.native="bulk.upload.model = false"><v-icon>close</v-icon></v-btn>
    </v-toolbar>
    <v-card-text>
        {{-- Dropzone --}}
        <dropzone parallel-uploads="-1" url="{{ route('library.store') }}" :upload-multiple="true" :params="{'_token': '{{ csrf_token() }}'}" :auto-process-queue="false" v-on:complete="complete" v-on:success="success">
            <template slot="header"></template>

            <template slot="preview">
                <v-card class="elevation-1 dz-preview dz-file-preview well ma-2">
                    <img data-dz-thumbnail width="200px" height="200px">
                    <div class="dz-details pa-0">
                        <v-toolbar card dense class="transparent">
                            <v-spacer></v-spacer>
                            <v-btn small icon data-dz-remove class="closebutton error"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>
                        <v-card-text>
                            <div class="dz-filename">
                                <span data-dz-name class="accent white--text"></span>
                            </div>
                            <div class="dz-size white" data-dz-size></div>
                        </v-card-text>
                    </div>
                    <v-card-text>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                        <div class="dz-success-mark"><span></span></div>
                        <div class="dz-error-mark"><span></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    </v-card-text>
                </v-card>
                {{-- <div class="dz-preview dz-file-preview well" id="dz-preview-template">
                    <img data-dz-thumbnail>
                    <div class="dz-details">
                        <div role="button" class="closebutton" data-dz-remove>
                            <i class="fa fa-close"></i>
                        </div>
                        <div class="dz-filename">
                            <span data-dz-name></span>
                        </div>
                        <div class="dz-size" data-dz-size></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-success-mark"><span></span></div>
                    <div class="dz-error-mark"><span></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                </div> --}}
            </template>
        </dropzone>
        {{-- /Dropzone --}}
    </v-card-text>
</v-card>

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/dropzone/Dropzone.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/dist/dropzone/Dropzone.js') }}"></script>
    <script>
        Vue.use(Dropzone);

        mixins.push({
            components: {Dropzone},

            methods: {
                complete: function (file, dropzone) {
                    // console.log(file, 'uploaded completed');
                },

                success: function (file, response, dropzone) {
                    console.log(dropzone, 'A successfully uploaded');
                },

                // upload () {
                //     alert('asd');
                // },
            },
        });
    </script>
@endpush

