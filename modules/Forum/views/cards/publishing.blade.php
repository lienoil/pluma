<v-card class="mb-3 elevation-1">
    <v-toolbar card class="transparent">

        @stack("cards.saving.pre-title")

        @section("cards.saving.title")
        <v-toolbar-title class="accent--text">{{ __('Publishing') }}</v-toolbar-title>
        @show

        @stack("cards.saving.post-title")

    </v-toolbar>

    <v-card-text class="grey--text">

        <v-select
            :items="resource.categories"
            hint="{{ __('Select a category for this question') }}"
            label="{{ __('Category') }}"
            persistent-hint
            item-text="name"
            item-value="id"
            auto clearable
            v-model="resource.item.category_id"
        >
            <template slot="selection" scope="data">
                <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)"
                >
                    <v-avatar v-if="data.item.icon">
                        <v-icon class="primary primary--text" v-html="data.item.icon"></v-icon>
                    </v-avatar>
                    <span v-html="data.item.name"></span>
                </v-chip>
            </template>
            <template slot="item" scope="data">
                <template v-if="typeof data.item !== 'object'">
                    <v-list-tile-content v-text="data.item"></v-list-tile-content>
                </template>
                <template v-else>
                    <v-list-tile-avatar v-if="data.item.icon">
                        <v-icon v-html="data.item.icon"></v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                        <v-list-tile-sub-title v-html="data.item.description"></v-list-tile-sub-title>
                    </v-list-tile-content>
                </template>
            </template>
        </v-select>
        <input type="hidden" name="category_id" :value="resource.item.category_id">

    </v-card-text>

    <v-card-text class="text-xs-right">
        @stack("cards.saving.pre-actions")

        <v-btn primary type="submit" class="elevation-1">{{ __('Post') }}</v-btn>

        @stack("cards.saving.post-actions")

    </v-card-text>
</v-card>
