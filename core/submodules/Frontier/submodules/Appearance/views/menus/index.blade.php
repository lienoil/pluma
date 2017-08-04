@extends("Frontier::layouts.admin")

@section("content")
    <v-layout row wrap>
        <v-flex sm5>
            <draggable v-model="menus" @start="drag=true" @end="drag=false">
                <div v-for="menu in menus">
                    @{{menu.title}}
                </div>
            </draggable>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script src="{{ present('frontier/components/Draggable/dist/vuedraggable.min.js') }}"></script>
    <script>
        // Vue.use(VueResource);
        // Vue.use(draggable);
        mixins.push({
            data () {
                return {
                    menus: {!! json_encode($menus) !!}
                };
            },
            components: {
                draggable,
            },
            methods: {},
            mounted () {},
        });
    </script>
@endpush
