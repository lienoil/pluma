@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark extended class="light-blue elevation-0">
        <v-btn
            href="{{ route('submissions.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card flat class="transparent">
                    <v-layout row wrap>
                        <v-flex md8 offset-md2 xs12>
                            <v-card class="card--flex-toolbar">
                                <v-toolbar card prominent class="transparent">
                                    <v-toolbar-title class="title">{{ __($resource->form->name) }}</v-toolbar-title>
                                </v-toolbar>
                                <v-divider></v-divider>
                                <v-card-text class="body-1">
                                    <v-card-actions class="pa-0">
                                        <div>
                                            <v-avatar size="25px">
                                                <img src="{{ $resource->user->avatar }}">
                                            </v-avatar>
                                            <span class="pl-2">{{ $resource->user->displayname }}</span>
                                        </div>
                                        <v-spacer></v-spacer>
                                        <v-icon>schedule</v-icon>
                                        <span>{{ $resource->created }}</span>
                                    </v-card-actions>
                                </v-card-text>

                                {{-- questions --}}
                                <v-card-text class="pa-4">
                                    @foreach ($resource->fields() as $field)
                                        <div><strong>{{ $field->question->label }}</strong></div>
                                        <div class="pa-3">{{ $field->answer }}</div>
                                    @endforeach
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                       item: {!! json_encode(old() ?? []) !!},
                       errors: {!! json_encode($errors->getMessages()) !!},
                       results: {!! json_decode('results') !!}
                   },
                };
            },
        });
    </script>
@endpush
