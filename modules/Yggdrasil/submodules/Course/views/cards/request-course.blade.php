<v-card flat class=" mb-3">
    <v-card flat class="text-xs-center grey lighten-4">
        <v-card-text class="pa-2 grey--text">
            {{-- <div class="mb-3">
                <img
                    width="150px"
                    src="{{ assets('frontier/images/empty_states/online-education.svg') }}"
                    style="opacity: 0.08"
                    alt="">
            </div> --}}
            @if ($resource->requested)
                <div class="mb-3">{{ __("Your request to enroll to this course is being reviewed.") }}</div>
            @else
                <div class="mb-3">{{ __("You are not enrolled in this course.") }}</div>
            <v-card-text class="pa-5">
                {{-- Dialog pop-up form --}}
                <v-dialog persistent width="500px">
                    <v-btn primary large ripple slot="activator">{{ __("Request Course") }}</v-btn>

                    <v-card class="text-xs-center elevation-4">
                        <v-card-text class="pa-5">
                            <p class="headline ma-2 mb-4"><v-icon round class="success--text display-4">✔</v-icon></p>
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

            {{-- add to bookmark
                {{ route("courses.bookmark.bookmark", $resource->id) }}--}}
            @if (! $resource->bookmarked)
                <form action="{{ route("courses.bookmark.bookmark", $resource->id) }}" method="POST">
                    {{ csrf_field() }}
                    <v-btn type="submit" class="red red--text" flat ripple>
                        {{ __("Add to Bookmark") }}
                    </v-btn>
                </form>
            @endif
            {{-- add to bookmark --}}
            </v-card-text>
        </v-card-text>
    </v-card>
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
