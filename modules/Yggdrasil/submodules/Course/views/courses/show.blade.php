@extends("Theme::layouts.admin")

@section("head-title", __($resource->title))
@section("utilitybar", '')

@php
    // dd($resource->lessons[2]->contents[0]->current);
@endphp

@section("content")
    <v-parallax class="elevation-1 mb-3" :src="resource.feature" height="350">
        <v-layout row wrap align-end justify-center>
            <v-flex md8 xs12 pa-0>
                <v-card tile flat class="mt-5">
                    <v-toolbar dense card class="white">
                        <v-spacer></v-spacer>
                        <v-chip small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
                        <v-btn icon ripple v-tooltip:left="{ html: 'Add to Bookmark' }">
                            <v-icon light>bookmark_border</v-icon>
                        </v-btn>

                        @can('edit-course')
                        <v-btn icon><v-icon>more_vert</v-icon></v-btn>
                        @endcan
                    </v-toolbar>
                    <v-container fluid grid-list-lg>
                        <v-flex sm12>
                            <v-layout row wrap>
                                <v-flex md3 sm2>
                                    <v-card-media :src="resource.feature" height="125px" cover class="elevation-0"></v-card-media>
                                </v-flex>
                                <v-flex md9 sm10>
                                    <v-card-title primary-title class="pa-0">
                                        <strong class="headline td-n accent--text" v-html="resource.title"></strong>
                                    </v-card-title>
                                    <v-footer class="transparent">
                                        <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">class</v-icon><span v-html="resource.code"></span></v-chip>

                                        <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;<span v-html="`${resource.lessons.length} Parts`"></span></v-chip>

                                        <v-chip v-if="resource.category" label class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">label</v-icon><span v-html="resource.category.name"></span></v-chip>

                                        <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span v-html="resource.created"></span></v-chip>
                                    </v-footer>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-container>
                </v-card>
            </v-flex>
        </v-layout>
    </v-parallax>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex flex md3 xs12 order-lg1>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __('Overview') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text class="grey--text text--darken-2" v-html="resource.body"></v-card-text>
                </v-card>
            </v-flex>
            <v-flex flex md6 xs12 order-lg2>
                <v-card class="elevation-1">
                    <v-toolbar card class="purple lighten-3 white--text transparent">
                        <v-toolbar-title class="white--text">{{ __('Course Content') }}</v-toolbar-title>
                    </v-toolbar>
                    <template v-for="(lesson, i) in resource.lessons">
                        <v-card-text>
                            <v-card flat tile class="elevation-0" :key="i">
                                <v-toolbar card class="transparent">
                                    <v-toolbar-title class="accent--text" v-html="lesson.title"></v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-chip label class="success white--text" v-if="lesson.icon"><v-icon class="white--text" v-html="lesson.icon"></v-icon></v-chip>
                                    <v-chip label class="success white--text" v-else>1/10</v-chip>
                                </v-toolbar>
                                <v-card-text class="grey--text text--darken-2" v-html="lesson.body"></v-card-text>
                                <v-card-actions v-if="lesson.contents.length">
                                    <v-spacer></v-spacer>
                                    <v-dialog lazy v-model="lesson.dialog" fullscreen transition="dialog-bottom-transition" :overlay=false>
                                        <v-btn slot="activator" round outline class="success success--text">{{ __('Start') }}</v-btn>
                                        <v-card flat tile class="application application--light">
                                            <v-parallax class="elevation-0" src="http://source.unsplash.com/800x400?night" height="400">
                                                <v-layout row wrap align-center justify-center>
                                                    <div class="overlay-bg-black"></div>
                                                    <v-layout column class="media">
                                                        <v-card-title class="pa-0">
                                                            <v-spacer></v-spacer>
                                                            <v-btn dark flat ripple @click.stop="lesson.dialog = !lesson.dialog">{{ __('Done') }}</v-btn>
                                                        </v-card-title>
                                                        <v-card-text class="white--text text-xs-center mb-5">
                                                            <div class="pb-3"><strong class="display-2" v-html="lesson.title"></strong></div>
                                                            <v-flex md6 offset-md3 class="subheading mb-5" v-html="lesson.body">{{ __('Loading content...') }}</v-flex>
                                                        </v-card-text>
                                                        <v-card>
                                                    </v-layout>
                                                </v-layout>
                                            </v-parallax>

                                            <v-container fluid grid-list-lg>
                                                <v-layout row wrap>
                                                    <v-flex order-lg1 order-md1 order-sm3 order-xs3 md3 xs12>
                                                        <v-card class="elevation-1 card--filed-on-top">
                                                            <v-toolbar card class="transparent">
                                                                <v-toolbar-title class="accent--text">{{ __('Assignment') }}</v-toolbar-title>
                                                                <v-spacer></v-spacer>
                                                                <v-btn icon ripple><v-icon>file_download</v-icon></v-btn>
                                                            </v-toolbar>
                                                            <v-divider></v-divider>
                                                            <v-card-text v-if="! lesson.assignment">
                                                                <v-layout row wrap justify-center>
                                                                    <img height="auto" src="http://192.168.1.213/pluma/~assets/frontier/images/placeholder/empty_assignment.jpg" alt="">
                                                                </v-layout>
                                                                <div class="body-1 text-xs-center grey--text text--ligthen-1">{{ __('No assignment for this lesson.') }}</div>
                                                            </v-card-text>
                                                            {{-- v-if="lesson.assignment" --}}
                                                            <v-card-actions>
                                                                <v-spacer></v-spacer>
                                                                <v-btn fab small class="red lighten-3"><v-icon>add</v-icon></v-btn>
                                                                <v-spacer></v-spacer>
                                                            </v-card-actions>
                                                        </v-card>
                                                    </v-flex>

                                                    <v-flex order-lg2 order-md2 order-sm1 order-xs1 md6 xs12>
                                                        <v-card class="elevation-1 card--filed-on-top">
                                                            <v-toolbar card class="deep-purple lighten-2">
                                                                <v-toolbar-title class="white--text">{{ __('Lesson Content') }}</v-toolbar-title>
                                                            </v-toolbar>
                                                            <v-divider></v-divider>
                                                            <v-card-text>
                                                                <v-card class="elevation-1 mb-3" v-for="(content, i) in lesson.contents" :key="i">
                                                                    <v-list two-line subheader class="pb-0">
                                                                        <v-list-tile avatar :ripple="content.unlocked" :href="content.unlocked?content.url:null" target="__blank" >
                                                                            <v-list-tile-avatar>
                                                                                <v-icon v-if="content.current" primary>play_circle_outline</v-icon>
                                                                                <v-icon v-else-if="content.completed" success>check</v-icon>
                                                                                <v-icon v-else class="grey--text">lock</v-icon>
                                                                            </v-list-tile-avatar>
                                                                            <v-list-tile-content :class="{'grey--text': content.locked}">
                                                                                <v-list-tile-title class="title" v-html="content.title"></v-list-tile-title>
                                                                                <v-list-tile-sub-title>Finished</v-list-tile-sub-title>
                                                                            </v-list-tile-content>
                                                                        </v-list-tile>
                                                                    </v-list>
                                                                </v-card>
                                                            </v-card-text>


                                                        </v-card>
                                                    </v-flex>

                                                </v-layout>
                                            </v-container>

                                        </v-card>
                                    </v-dialog>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-card-text>
                        <v-divider></v-divider>
                    </template>
                </v-card>
            </v-flex>
            <v-flex flex md3 xs12 order-lg3>
                pto
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {!! json_encode($resource->with(['lessons', 'lessons.contents'])->first()->toArray()) !!}
                }
            },

            mounted () {
                for (var j = 0; j < this.resource.lessons.length; j++) {
                    this.resource.lessons[j].dialog = false;
                }
            }
        });
    </script>
@endpush
