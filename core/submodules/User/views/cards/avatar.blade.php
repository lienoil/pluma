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
            auto
            chips
            clearable
            hide-details
            item-text="name"
            item-value="avatar"
            label="{{ __('Choose an avatar') }}"
            search-input
            v-bind:items="resource.avatars.items"
            v-model="resource.avatars.model"
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
                            model: '{{ old('avatar') ? old('avatar') : (isset($resource) ? $resource->avatar : '') }}',
                            {{-- items: {!! json_encode($avatars) !!}, --}}
                        },
                    }
                };
            }
        });
    </script>
@endpush
