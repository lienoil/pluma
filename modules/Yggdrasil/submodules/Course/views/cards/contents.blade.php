<v-card flat class="white">
    <v-toolbar card class="white sticky">
        <v-toolbar-title class="subheading"><strong>{{ __('Part') }}</strong></v-toolbar-title>
        <v-spacer></v-spacer>


        <template>
            {{-- Expand --}}
            <v-btn
                flat
                ripple
                icon
                v-tooltip:left="{html: draggable.options.view ? 'Expand All Part' : 'Shrink All Part'}"
                @click="toolbar().expand().toggle(draggable.sections, 'active', draggable.options.view); draggable.options.view = !draggable.options.view">
                <v-icon>@{{ draggable.options.view ? 'fa-expand' : 'fa-compress' }}</v-icon>
            </v-btn>
        </template>

        <v-divider class="vertical"></v-divider>

        <v-btn
            flat
            secondary
            @click.native.stop="addSection(draggable.sections, 'Part')">
            {{ __('Add Part') }}
        </v-btn>

    </v-toolbar>

        {{-- empty-state --}}
        <template v-if="!draggable.sections.length">
            <v-card
                flat
                role="button"
                @click.stop="addSection(draggable.sections, 'Part')"
                class="text-xs-center grey lighten-3">
                <v-card-text class="pa-5 grey--text">
                    <p v-if="resource.errors[`lessons.${key}.contents`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents`].join(', ')"></p>
                    <div class="mb-3">
                        <img class="empty_states--opacity" width="80px" src="{{ assets('frontier/images/empty_states/part.svg') }}" alt="">
                    </div>
                    <div>{!! __('Click here to add Part.') !!}</div>
                </v-card-text>
            </v-card>
        </template>
        {{-- empty state --}}

        {{-- loop --}}
        <template v-else>
            <v-card-text class="grey lighten-3">
                <draggable
                    v-show="draggable.sections && draggable.sections.length"
                    class="sortable-container pa-0"
                    v-model="draggable.sections"
                    :options="{animation: 150, handle: '.sortable-handle', group: 'contents', draggable: '.draggable-child', forceFallback: true}">
                    <transition-group>
                        <v-card
                            v-for="(content, c) in draggable.sections"
                            :key="c"
                            tile
                            :id="content.resource.title"
                            class="draggable-child elevation-1 mb-3"
                            >

                            {{-- head --}}

                            {{-- border-top --}}
                            <div class="secondary" style="height: 3px;"></div>
                            {{-- border-top --}}

                            <v-toolbar
                                card
                                dense
                                role="button"
                                class="sortable-handle white"
                                @click.native.stop="content.active = !content.active"
                                >
                                {{-- <v-icon>drag_handle</v-icon> --}}
                                <v-icon>@{{ content.active ? 'keyboard_arrow_down' : 'keyboard_arrow_right' }}</v-icon>
                                <v-toolbar-title class="subheading">
                                    @{{ content.resource.title }}
                                </v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn
                                    icon
                                    v-tooltip:left="{html: 'Remove Part'}"
                                    @click.native.stop="draggable.sections.splice(c, 1)">
                                    <v-icon class="error--text">delete</v-icon></v-btn>
                                <v-icon class="grey--text">drag_indicator</v-icon>
                            </v-toolbar>
                            {{-- head --}}

                            {{-- Part --}}
                            {{-- <v-slide-y-transition> --}}
                            <v-card flat v-show="content.active" transition="slide-y-transition">
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex md3 xs12>
                                            {{-- Interactive Part --}}
                                            <v-card-text class="grey lighten-4 pa-0">
                                                {{-- <p class="subheading grey--text" @click.stop="content.mediabox = !content.mediabox">{{ __('Interactive Part') }}</p> --}}
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][interactive]`" :value="JSON.stringify(content.resource.interactive)">
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][library_id]`" :value="content.resource.interactive && content.resource.interactive.length ? content.resource.interactive[0].id : null">
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][contentable_id]`" :value="content.resource.interactive && content.resource.interactive.length ? content.resource.interactive[0].id : null">
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][contentable_type]`" :value="content.resource.interactive && content.resource.interactive.length ? content.resource.interactive[0].contentable_type : null">
                                                {{-- empty-state --}}
                                                <template v-if="!content.resource.interactive.length">
                                                    <v-card
                                                        class="grey lighten-3 text-xs-center grey--text"
                                                        ripple
                                                        flat
                                                        height="174px"
                                                        role="button"
                                                        v-tooltip:right="{html: 'Add interactive content'}"
                                                        @click.stop="content.mediabox = !content.mediabox">
                                                        <v-container fluid fill-height>
                                                            <v-layout align-center justify-center>
                                                                <v-card-text>
                                                                        <img class="empty_states--opacity" width="80px" src="{{ assets('frontier/images/empty_states/interactive-content.svg') }}" alt="">
                                                                    <div>
                                                                        <p v-if="resource.errors[`lessons.${key}.contents.${c}.library_id`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents.${c}.library_id`].join(', ')"></p>
                                                                    </div>
                                                                </v-card-text>
                                                            </v-layout>
                                                        </v-container>
                                                    </v-card>
                                                </template>
                                                {{-- empty-state --}}

                                                {{-- Preview --}}
                                                <v-card-actions class="pa-0">
                                                    <v-scale-transition>
                                                        <v-card
                                                            class="elevation-1 pa-0 ma-0"
                                                            v-show="content.resource.interactive.length"
                                                            :key="i"
                                                            v-for="(o, i) in content.resource.interactive"
                                                            @click.stop="content.mediabox = true"
                                                            v-tooltip:right="{html: o.name}"
                                                            role="button"
                                                            height="174px"
                                                            style="width: 100%;">
                                                            <v-card-media
                                                                :src="o.thumbnail" height="174px">
                                                                <v-card-text class="pa-0 text-xs-right">
                                                                    <v-btn class="blue-grey darken-2 white--text"
                                                                        light
                                                                        icon
                                                                        small
                                                                        @click.stop="content.resource.interactive = []">
                                                                        <v-icon class="subheading title white--text">close</v-icon>
                                                                    </v-btn>
                                                                </v-card-text>
                                                            </v-card-media>
                                                        </v-card>
                                                    </v-scale-transition>
                                                </v-card-actions>
                                                {{-- /Preview --}}
                                            </v-card-text>

                                            {{-- media-box dialog --}}
                                            <v-card-actions class="grey lighten-4 pa-0">
                                                <v-spacer></v-spacer>
                                                <v-mediabox
                                                    :categories="mediabox.media"
                                                    :multiple="false"
                                                    close-on-click
                                                    v-model="content.mediabox"
                                                    dropzone
                                                    :old="content.resource.interactive.length?content.resource.interactive:[]"
                                                    auto-remove-files
                                                    :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
                                                    :dropzone-params="{_token: '{{ csrf_token() }}'}"
                                                    @selected="value => { content.resource.interactive = value }"
                                                    @category-change="val => resource.feature.current = val"
                                                    {{-- @sending="({file, params}) => { params.catalogue_id = resource.feature.current.id; params.originalname = file.upload.filename; params.extract = true}" --}}
                                                >
                                                    <template slot="dropzone">
                                                        <span class="caption">{{ __('Uploads will be catalogued as ') }}<em>@{{ resource.feature.current ? resource.feature.current.name : 'Uncategorized' }}</em></span>
                                                    </template>

                                                    <template slot="media" scope="prop">
                                                        <v-card transition="scale-transition" class="accent" :class="prop.item.active?'elevation-10':'elevation-1'">
                                                            <v-card-media class="white" height="160px" :src="prop.item.thumbnail">
                                                                <v-container fill-height class="pa-0 white--text">
                                                                    <v-layout fill-height wrap column>
                                                                        <v-spacer></v-spacer>
                                                                        <v-slide-y-transition>
                                                                            <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="prop.item.active">check</v-icon>
                                                                        </v-slide-y-transition>
                                                                        <v-spacer></v-spacer>
                                                                    </v-layout>
                                                                </v-container>
                                                            </v-card-media>
                                                            <v-toolbar flat dense>
                                                                <v-toolbar-title class="mr-3 body-1" v-html="prop.item.originalname ? prop.item.originalname : prop.item.name">asas</v-toolbar-title>
                                                            </v-toolbar>
                                                            <v-card-actions class="px-2 white accent--text">
                                                                <v-icon class="grey--text caption" v-html="prop.item.icon"></v-icon>
                                                                <span class="grey--text caption" v-html="prop.item.mimetype"></span>
                                                                <v-spacer></v-spacer>
                                                                <span class="caption grey--text" v-html="prop.item.mime"></span>
                                                                <span class="caption grey--text" v-html="prop.item.filesize"></span>
                                                            </v-card-actions>
                                                        </v-card>
                                                    </template>
                                                </v-mediabox>
                                            </v-card-actions>
                                            {{-- media-box dialog --}}

                                            {{-- Interactive Part --}}
                                        </v-flex>

                                        <v-flex md9 xs12>
                                            {{-- part text-fields --}}
                                            <div>
                                                <input v-if="content.resource.id" type="hidden" :name="`lessons[${key}][contents][${c}][id]`" :value="content.resource.id">
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][sort]`" :value="c">
                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][delta]`" :value="JSON.stringify(content.resource.quill.delta)">

                                                <v-text-field
                                                    :name="`lessons[${key}][contents][${c}][title]`"
                                                    label="{{ __('Part Title') }}"
                                                    hide-details
                                                    :error-messages="resource.errors[`lessons.${key}.contents.${c}.title`]"
                                                    v-model="content.resource.title"
                                                    clearable
                                                ></v-text-field>

                                                {{-- icon --}}
                                                <v-menu full-width offset-y offset-x>
                                                    <v-text-field
                                                        label="{{ __('Icon') }}"
                                                        hint="{{ __('Click icon at the right to show list of default icons') }}"
                                                        persistent-hint
                                                        slot="activator"
                                                        v-model="content.resource.icon"
                                                        :name="`lessons[${key}][contents][${c}][icon]`"
                                                        :append-icon="content.resource.icon ? content.resource.icon : 'more_horiz'"
                                                        :error-messages="resource.errors[`lessons.${key}.contents.${c}.icon`]"
                                                    ></v-text-field>
                                                    <v-card>
                                                        <v-list>
                                                            <v-list-tile
                                                                ripple @click="content.resource.icon = icon" :key="i" v-for="(icon, i) in misc.icons">
                                                                <v-list-tile-avatar>
                                                                    <v-icon v-html="icon"></v-icon>
                                                                </v-list-tile-avatar>
                                                                <v-list-tile-content>
                                                                    <span v-html="icon"></span>
                                                                </v-list-tile-content>
                                                            </v-list-tile>
                                                        </v-list>
                                                    </v-card>
                                                </v-menu>
                                                {{-- icon --}}

                                                <v-text-field
                                                    rows="1"
                                                    multi-line
                                                    v-model="content.resource.body"
                                                    label="{{ __('Part Description') }}"
                                                    hide-details
                                                    :name="`lessons[${key}][contents][${c}][body]`"
                                                    hint="Drag down line at the bottom right to expand the text-field."
                                                    :error-messages="resource.errors[`lessons.${key}.contents.${c}.body`]"
                                                ></v-text-field>
                                            </div>
                                            {{-- part text-fields --}}
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>
                            {{-- </v-slide-y-transition> --}}
                            {{-- Part --}}
                        </v-card>
                    </transition-group>
                </draggable>
            </v-card-text>
        </template>
        {{-- loop --}}

    {{-- add part button --}}
    <v-card-actions>
        <v-btn
            block
            flat
            secondary
            large
            @click.stop="addSection(draggable.sections, 'Part')">
            {{ __('Add Part') }}
        </v-btn>
    </v-card-actions>
    {{-- add part button --}}
</v-card>
