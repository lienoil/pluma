{{-- <v-card flat class="white lighten-4"> --}}
    <v-toolbar card class="white">
        <v-icon left>details</v-icon>
        <v-toolbar-title class="subheading body-2 accent--text">{{ __('Survey Form') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>

    <v-card-text>
        <v-select
            :items="resource.surveys"
            auto clearable
            hint="{{ __('This Survey Form will be answered by the students') }}"
            item-text="name"
            item-value="id"
            label="{{ __('Survey Form') }}"
            persistent-hint
            v-model="resource.item.form_id"
        ></v-select>
        <input type="hidden" name="survey_id" :value="resource.item.survey_id">
    </v-card-text>
{{-- </v-card> --}}
