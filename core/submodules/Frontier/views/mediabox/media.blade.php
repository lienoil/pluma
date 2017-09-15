<mediabox :toolbar-items="[
        {code:'all', count:100,title:'All',icon:'perm_media', url: '{{ route('api.library.all') }}' },
        {code:'albums', count:69,title:'Albums',icon:'album'},
        {code:'collections', count:99,title:'Collections',icon:'collections'},
    ]"
    url="{{ route('api.library.all') }}"
    {{-- multiple --}}
>
    <template slot="item" scope="props">
        <v-card-media :src="props.item.thumbnail" height="200px">
            <v-container fill-height fluid class="pa-0 white--text">
                <v-layout column>
                    <v-slide-y-transition>
                        <v-icon ripple class="display-4 pa-4 success--text" v-if="props.item.active">check</v-icon>
                    </v-slide-y-transition>
                    <v-card-title>@{{ props.item.originalname }}</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-actions>
                        <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                        <v-spacer></v-spacer>
                        <span>@{{ props.item.mime }}</span>
                        <span>@{{ props.item.filesize }}</span>
                    </v-card-actions>
                </v-layout>
            </v-container>
        </v-card-media>
    </template>
</mediabox>
