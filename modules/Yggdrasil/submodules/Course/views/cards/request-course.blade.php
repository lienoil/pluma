<v-card flat class="mb-3">
    <div class="text-xs-center py-5 px-2">
        <img src="{{ assets('Frontier/images/placeholder/iso/image-table.png') }}"
            width="200px"
            alt="{{ __('Not enrolled') }}"
            style="max-width: 100%;-webkit-filter: grayscale(95%); filter: grayscale(95%);">
    </div>
    <v-card-text>
        <v-container fill-height class="pa-0 pb-4">
            <v-layout fill-height wrap column>
                <v-spacer></v-spacer>
                <div class="subheading text-xs-center grey--text">
                    @if ($resource->requested)
                        <div class="mb-3 subheading page-title success--text">{{ __("Your request to enroll to this course is being reviewed.") }}</div>
                    @else
                        <div class="mb-3 subheading page-title">{{ __("You are not enrolled to this course.") }}</div>
                        {{-- Dialog pop-up form --}}

                    <v-card-actions>
                        <v-dialog v-model="enroll.form.dialog" persistent width="500px">
                            <v-btn class="primary primary--text" outline large ripple slot="activator">{{ __("Request Course") }}</v-btn>
                            <v-card class="text-xs-center elevation-4">
                                <v-card-text class="pa-5">
                                    <p class="headline ma-2 mb-4"><v-icon round class="success--text display-4">check_circle</v-icon></p>
                                    <h2 class="display-1 grey--text text--darken-2 page-title"><strong>{{ __('Request Sent') }}</strong></h2>
                                    <div class="grey--text text--darken-2">
                                        <span class="mb-3 page-title">{{ __("Your request has been submitted successfully. You will receive an e-mail confirmation from us once our trainer for this course approves the request. We are excited to learn with you!") }}</span>
                                    </div>
                                </v-card-text>
                                <v-card-actions class="py-4">
                                    <v-spacer></v-spacer>
                                    <form action="{{ route('courses.request', $resource->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{ user()->id ?? null }}">
                                        <v-btn type="submit" depressed success large class="px-4 white--text elevation-0">{{ __('Okay') }}</v-btn>
                                    </form>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        {{-- Dialog pop-up form --}}
                    @endif
                    <v-spacer></v-spacer>
                    @if (! $resource->bookmarked)
                        <form action="{{ route("courses.bookmark.bookmark", $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            <v-btn type="submit" class="red red--text" flat ripple>
                                <v-icon left>bookmark_outline</v-icon>
                                {{ __("Add to Bookmark") }}
                            </v-btn>
                        </form>
                    @endif
                    </v-card-actions>
                </div>
            </v-layout>
        </v-container>
    </v-card-text>
</v-card>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    enroll: {
                        form: {
                            dialog: false,
                        }
                    }
                }
            }
        })
    </script>
@endpush
