<v-card class="mb-3 elevation-1">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="accent--text">{{ __('Avatar') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn
            flat
            icon
            active
            @click.native="resource.avatars.model = ''"
        ><v-icon>close</v-icon></v-btn>
    </v-toolbar>
    <v-card-text>
        <template v-if="resource.avatars.model">
            <template>
                <img width="100%" height="auto" :src="resource.avatars.model">
                <input type="hidden" name="avatar" :value="resource.avatars.model">
            </template>
        </template>
        <v-select
            chips
            autocomplete
            label="{{ __('Choose an avatar') }}"
            item-text="name"
            item-value="avatar"
            v-model="resource.avatars.model"
            v-bind:items="resource.avatars.items"
            hide-details
            search-input
        >
            <template slot="selection" scope="data">
                <v-chip
                    @input="data.parent.selectItem(data.item.avatar)"
                    @click.native.stop
                    class="chip--select-multi"
                    :key="data.item.avatar"
                >
                    <v-avatar>
                        <img :src="data.item.avatar">
                    </v-avatar>
                    @{{ data.item.name }}
                </v-chip>
            </template>
            <template slot="item" scope="data">
                <v-list-tile-avatar>
                    <img width="100%" v-bind:src="data.item.avatar"/>
                </v-list-tile-avatar>
                <v-list-tile-title>
                    @{{ data.item.name }}
                </v-list-tile-title>
            </template>
        </v-select>
    </v-card-text>
</v-card>


@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        avatars: {
                            model: '{{ isset($resource) ? $resource->avatar : old('avatar') }}',
                            items: {!! json_encode($avatars) !!},
                        },
                    }
                };
            }
        });
    </script>
@endpush
