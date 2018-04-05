<form data-type="image/png" class="interactive-content" action="{{ $resource->action ?? route('submissions.submit') }}" method="{{ $resource->method }}" {!! $resource->attributes !!} onunload="window.API.LMSFinish('')" onbeforeunload="window.API.LMSFinish('')">
    {{ csrf_field() }}
    <input type="hidden" name="form_id" value="{{ $resource->id }}">
    <input type="hidden" name="type" value="courses">

    <v-card flat>
        <v-card-title>{{ $resource->name }}</v-card-title>

        <v-card-text>{!! $resource->body !!}</v-card-text>

        @foreach ($resource->fields()->orderBy('sort')->get() as $label => $field)
            <v-card-text>
                <div class="mb-2">{!! html_entity_decode($field->template()->render()) !!}</div>
            </v-card-text>
        @endforeach

        <v-divider></v-divider>

        <v-card-text class="text-xs-right">
            <v-btn primary class="elevation-1" type="submit">{{ __('Submit') }}</v-btn>
        </v-card-text>
    </v-card>
</form>

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
                    },
                };
            },
        });
    </script>
@endpush
