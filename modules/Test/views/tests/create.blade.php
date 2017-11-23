@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <v-flex sm12 class="pa-4">
            <p class="grey--text">Lorem ipsum dolor sit.</p>
            <p class="subheading">Test for Project-in-Project (PiP) approach</p>
            <p>Page starts after horizontal line.</p>
        </v-flex>
        <v-divider class="mb-4"></v-divider>

        <v-container fluid>
            <v-flex sm12>
                <script type="text/x-template" id="template-dra">
                    <draggable :list="items" :options="options" class="sortable-container">
                        {{-- <transition-group> --}}
                        <div :key="i" v-for="(t,i) in items" class="mb-3 draggable sortable-handle">
                            <v-card tile class="mb-1">
                                <v-card-text>
                                    <div class="headline" v-html="t.slug"></div>
                                    <div class="caption" v-html="t.title"></div>
                                </v-card-text>
                            </v-card>
                            <v-card tile class="bordered--ant transparent ml-4 sortable-container">
                                <local v-if="t.children" v-model="t.children" :options="options"></local>
                            </v-card>
                        </div>
                        {{-- </transition-group> --}}
                    </draggable>
                </script>

                <v-card flat class="transparent">
                    <draggable v-model="items" :options="options" class="sortable-container">
                        <transition-group name="page1">
                            <div :key="i" v-for="(t,i) in items" class="mb-3 draggable sortable-handle">
                                <v-card tile class="mb-2">
                                    <v-card-text>
                                        <div class="headline" v-html="t.slug"></div>
                                        <div class="caption" v-html="t.title"></div>
                                    </v-card-text>
                                </v-card>
                                <v-card flat tile class="bordered--ant transparent ml-4 sortable-container">
                                    <local v-if="t.children" v-model="t.children" :options="options"></local>
                                </v-card>
                            </div>
                        </transition-group>
                    </draggable>
                    {{-- <local v-model="items" :options="{animation: 150, group: 'pages'}"></local> --}}
                </v-card>
            </v-flex>
        </v-container>
    </v-container>
@endsection

@push('css')
    <style>
        .mh-100,
        .mh-100 div > span {
            min-height: 50px;
        }
        .odd {
            background-color: rgba(255,0,0,0.5) !important;
        }
        .even {
            background-color: rgba(0,0,255,0.5) !important;
        }
        .bordered--ant {
            max-width: 100%;
            padding: 10px;
            border: 2px dashed rgba(0,20,88,0.3) !important;
        }
        .sortable-container {
            padding-bottom: 30px;
        }
        .sortable-container > span,
        .sortable-container > div > span {
            display: block;
            padding: 10px;
            min-height: 50px;
            /*background-color: rgba(255,0,0,0.2);*/
        }
    </style>
    {{-- <link rel="stylesheet" href="{{ assets('page/traverser/dist/traverser.min.css') }}"> --}}
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    {{-- <script src="{{ assets('page/traverser/dist/traverser.min.js') }}"></script> --}}
    <script>
        var local = {
            name: 'local',
            model: { prop: 'items' },
            template: '#template-dra',
            props: ['items', 'options']
        }
        mixins.push({
            components: {local: local},
            data () {
                return {
                    options: {
                        animation: 150,
                        draggable: '.draggable',
                        group: {name: 'page1'},
                        forceFallback: true,
                    },


                    items: [
                        {slug:'1', title:'One', children:[]},
                        {slug:'2', title:'Two', children:[]},
                        {slug:'3', title:'Three', children:[]},
                    ],
                    items2: [
                        {slug:'1', title:'One', children:[]},
                        {slug:'2', title:'Two', children:[
                            {slug:'2.1', title:'Two.1', children:[
                                {slug:'2.1.1', title:'Two.1.1', children:[]},
                                {slug:'2.1.2', title:'Two.1.2', children:[]},
                                {slug:'2.1.3', title:'Two.1.3', children:[
                                    {slug:'2.1.3.1', title:'Two.1.3.1'},
                                    {slug:'2.1.3.2', title:'Two.1.3.2'},
                                ]},
                            ]},
                            {slug:'2.2', title:'Two.2', children:[]},
                        ]},
                        {slug:'3', title:'Three', children:[]},
                    ],
                }
            }
        })
    </script>
@endpush
