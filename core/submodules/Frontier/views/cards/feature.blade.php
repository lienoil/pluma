<v-card class="mb-3 elevation-1">
    <v-toolbar card dense class="transparent">
        <v-icon class="accent--text">perm_media</v-icon>
        <v-toolbar-title class="subheading accent--text">{{ __('Featured Image') }}</v-toolbar-title>
    </v-toolbar>

    <v-mediabox search="mime:image" :multiple="false" close-on-click :categories="resource.feature.catalogues" v-model="resource.feature.model" :old="resource.item.feature ? resource.item.feature : []" @selected="value => { resource.item.feature = value[0] }">
        <template slot="media" scope="props">
            <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                <v-card-media height="250px" :src="props.item.thumbnail">
                    <v-container fill-height class="pa-0 white--text">
                        <v-layout fill-height wrap column>
                            <v-card-title class="subheading" v-html="props.item.originalname"></v-card-title>
                            <v-slide-y-transition>
                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                            </v-slide-y-transition>
                            <v-spacer></v-spacer>
                            <v-card-actions class="px-2 white--text">
                                <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                                <v-spacer></v-spacer>
                                <span v-html="props.item.mime"></span>
                                <span v-html="props.item.filesize"></span>
                            </v-card-actions>
                        </v-layout>
                    </v-container>
                </v-card-media>
            </v-card>
        </template>
    </v-mediabox>

    <v-card-text v-if="!resource.item.feature" class="text-xs-center">
        <v-fade-transition>
            <div v-show="!resource.item.feature" class="my-2">
                <v-icon x-large class="grey--text text--lighten-2">perm_media</v-icon>
                <p class="ma-0 caption grey--text text--lighten-2">{{ __('No Image') }}</p>
            </div>
        </v-fade-transition>
    </v-card-text>

    <v-card-media
        v-else
        :src="resource.item.feature ? resource.item.feature.thumbnail : ''"
        height="200px"
        role="button"
        @click.stop="resource.feature.model = !resource.feature.model">
        <v-container fill-height fluid class="pa-0 white--text">
            <v-layout column>
                <v-card-title class="pa-0 subheading">
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click.stop="resource.item.feature = null"><v-icon>close</v-icon></v-btn>

                    <input type="hidden" name="feature_obj" :value="JSON.stringify(resource.item.feature?resource.item.feature:[])">
                    <input type="hidden" name="feature" :value="resource.item.feature ? resource.item.feature.thumbnail : ''">
                </v-card-title>
            </v-layout>
        </v-container>
    </v-card-media>

    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat @click.stop="resource.feature.model = !resource.feature.model" v-html="resource.item.feature ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></v-btn>
    </v-card-actions>
</v-card>
