<v-card class="elevation-1 mb-3">
    <v-toolbar flat class="transparent">
        <v-toolbar-title class="subheading accent--text"><v-icon class="accent--text" left>fa-tags</v-icon>{{ __('Category') }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text class="grey--text">
        <v-text-field
            name="category"
            single-line
            hide-details
            label="{{ __('Search or add') }}"
        ></v-text-field>
    </v-card-text>

    <v-card-text style="max-height: 300px; overflow-y:auto; border-top: 1px solid rgba(0,0,0,0.05); border-bottom: 1px solid rgba(0,0,0,0.05)">
        <v-radio-group v-model="resource.title" :mandatory="false">
            <v-radio v-for="item in 10" :key="item" class="mb-2" :label="`Radio # ${item}`" :value="item"></v-radio>
        </v-radio-group>
    </v-card-text>


    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn accent flat>{{ __('Add') }}</v-btn>
    </v-card-actions>
</v-card>
