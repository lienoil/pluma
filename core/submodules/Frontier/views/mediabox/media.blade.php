<v-dialog
    v-model="mediabox.model"
    fullscreen
    lazy
    transition="dialog-bottom-transition"
    hide-overlay
>
    <v-card flat tile class="grey lighten-4">
        <v-toolbar card dark class="accent">
            <v-progress-circular v-if="mediabox.loading" indeterminate class="primary--text"></v-progress-circular>
            <v-spacer></v-spacer>
            <v-btn icon v-tooltip:left="{'html': '{{ __('Close Media') }}'}" @click.native="mediabox.model = false" dark><v-icon>close</v-icon></v-btn>
        </v-toolbar>

        @stack('mediabox.content')
    </v-card>
</v-dialog>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    mediabox: {
                        loading: true,
                        model: true,
                        tabs: {
                            active: '',
                        }
                    },
                };
            },

            mounted () {
                this.mediabox.loading = false;
            }
        });
    </script>
@endpush
