<div class="text-xs-center py-5">
    <img src="{{ assets('Frontier/images/placeholder/iso/image-table.png') }}"
        width="100%"
        alt="{{ __('Not enrolled') }}"
        style="-webkit-filter: grayscale(95%); max-width: 200px; filter: grayscale(95%);">
</div>
<v-container fill-height class="pa-0 pb-4">
    <v-layout fill-height wrap column>
        <v-spacer></v-spacer>
        <div class="subheading text-xs-center grey--text">
            <div class="mb-3 subheading page-title">{{ __("You are not enrolled to this course.") }}</div>
            {{-- Dialog pop-up form --}}
            <v-dialog v-model="enroll.form.dialog" persistent width="500px">
                <v-btn class="primary primary--text px-4" large outline ripple slot="activator">{{ __("Request Course") }}</v-btn>
                <v-card class="text-xs-center elevation-4">
                    <v-card-text class="pa-5">
                        <p class="headline ma-2 mb-4"><v-icon round class="success--text display-4">check_circle</v-icon></p>
                        <h2 class="display-1 grey--text text--darken-2 page-title"><strong>{{ __('Thank you!') }}</strong></h2>
                        <div class="grey--text text--darken-2">
                            <span class="mb-3 page-title">{{ __("Your request has been submitted successfully. You will receive an e-mail confirmation from us once our trainer for this course approves the request. We are excited to learn with you!") }} <strong></span>
                        </div>
                    </v-card-text>
                    <v-card-actions class="py-4">
                        <v-spacer></v-spacer>
                        <v-btn depressed success large class="px-4 white--text elevation-0" @click.native="enroll.form.dialog = false">Okay</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            {{-- Dialog pop-up form --}}

        </div>
    </v-layout>
</v-container>

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    {{-- <script src="{{ assets('course/scorm/scormdriver.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.6.0.0.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.js') }}"></script> --}}
    <script src="{{ assets('course/scorm/scorm.adapter.api-1.2-2004.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    enroll: {
                        form: {
                            dialog: false,
                        }
                    },
                }
            }
        })
    </script>
@endpush
