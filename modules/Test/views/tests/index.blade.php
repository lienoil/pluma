@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="elevation-1">
                    <v-card-text>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet qui quidem, placeat! Molestias assumenda sit numquam, praesentium obcaecati, provident. Doloribus praesentium quibusdam explicabo hic nihil magni ea ex eligendi distinctio?
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
<v-card>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/js/test.js') }}"></script>
@endpush
