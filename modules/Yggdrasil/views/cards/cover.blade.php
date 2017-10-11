<v-card class="mb-3 elevation-1">
    <v-toolbar card dense class="transparent">
        <v-icon class="accent--text">landscape</v-icon>
        <v-toolbar-title class="subheading accent--text">{{ __('Cover') }}</v-toolbar-title>
    </v-toolbar>

    <v-mediabox :multiple="false" close-on-click :categories="resource.feature.catalogues" v-model="resource.cover.model" :old="resource.item.cover ? [resource.item.cover] : []" @selected="value => { resource.item.cover = value[0] }">
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

    <v-card-text v-if="!Object.keys(resource.item.cover?resource.item.cover:{}).length" class="text-xs-center">
        <v-fade-transition>
            <div v-show="!resource.item.cover" class="my-2">
                <v-icon x-large class="grey--text text--lighten-2">perm_media</v-icon>
                <p class="ma-0 caption grey--text text--lighten-2">{{ __('No Image') }}</p>
            </div>
        </v-fade-transition>
    </v-card-text>

    <v-card-media
        v-else
        :src="resource.item.cover ? resource.item.cover.thumbnail : ''"
        height="200px"
        role="button"
        @click.stop="resource.cover.model = !resource.cover.model">
        <v-container fill-height fluid class="pa-0 white--text">
            <v-layout column>
                <v-card-title class="pa-0 subheading">
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click.stop="resource.item.cover = null"><v-icon>close</v-icon></v-btn>
                    <input type="hidden" name="cover_obj" :value="JSON.stringify(resource.item.cover)">
                    <input type="hidden" name="backdrop" :value="resource.item.cover ? resource.item.cover.thumbnail : ''">
                </v-card-title>
            </v-layout>
        </v-container>
    </v-card-media>

    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat @click.stop="resource.cover.model = !resource.cover.model" v-html="resource.item.cover ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></v-btn>
    </v-card-actions>
</v-card>
