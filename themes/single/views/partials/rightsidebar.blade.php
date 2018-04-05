<v-navigation-drawer
  :dark="theme.dark"
  fixed
  hide-overlay
  right
  temporary
  v-model="rightsidebar.model"
>
  <v-toolbar card class="transparent">
    <v-icon left>flash_on</v-icon>
    <v-toolbar-title class="body-2 grey--text">{{ __('Quick Settings') }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon ripple @click="rightsidebar.model = false"><v-icon color="grey">keyboard_arrow_right</v-icon></v-btn>
  </v-toolbar>

  <v-card flat tile class="transparent">
    <v-subheader>{{ __('Appearance') }}&nbsp;<v-divider></v-divider></v-subheader>
    <v-subheader class="caption">{{ __('Theming') }}</v-subheader>
    <v-card-text>
      <v-switch
        :label="theme.dark ? `{{ __('Dark Theme') }}` : `{{ __('Light Theme') }}`"
        @change="localstorage('single.theme.dark', theme.dark)"
        class="caption"
        hide-details
        v-model="theme.dark"
      ></v-switch>
    </v-card-text>

    <v-subheader class="caption">{{ __('Font Size') }}</v-subheader>
    <v-card-text>
      <v-slider
        :max="40"
        :min="-1"
        :prepend-icon-cb="() => { localstorage('single.settings.fontsize', (settings.fontsize=1)) }"
        :prepend-icon="settings.fontsize === 1 ? 'font_download' : 'refresh'"
        @input="localstorage('single.settings.fontsize', settings.fontsize)"
        hide-details
        role="button"
        step="1"
        thumb-label
        v-model="settings.fontsize"
      ></v-slider>
    </v-card-text>

    <v-subheader class="">{{ __('Sidebar') }}&nbsp;<v-divider></v-divider></v-subheader>

    <v-subheader class="caption">{{ __('Background') }}</v-subheader>
    <v-container grid-list-lg>
      <v-layout row wrap>
        <v-flex xs3>
          <v-card ripple height="80px" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/double-exposure-effect.jpg') }})'">
            <v-card-media src="{{ theme('static/img/placeholders/double-exposure-effect.jpg') }}" height="80px"></v-card-media>
          </v-card>
        </v-flex>
        <v-flex xs3>
          <v-card ripple height="80px" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/double-exposure-effect-01.jpg') }})'">
            <v-card-media src="{{ theme('static/img/placeholders/double-exposure-effect-01.jpg') }}" height="80px"></v-card-media>
          </v-card>
        </v-flex>
        <v-flex xs3>
          <v-card ripple height="80px" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/mountains-01.jpeg') }})'">
            <v-card-media src="{{ theme('static/img/placeholders/mountains-01.jpeg') }}" height="80px"></v-card-media>
          </v-card>
        </v-flex>
        <v-flex xs3>
          <v-card ripple height="80px" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/beach-01.jpeg') }})'">
            <v-card-media src="{{ theme('static/img/placeholders/beach-01.jpeg') }}" height="80px"></v-card-media>
          </v-card>
        </v-flex>
    </v-container>

    <v-card flat>
      <v-subheader class="caption">{{ __('Color') }}</v-subheader>
      <v-card-text>
        <v-slider hide-details @input="localstorage('sidebar.style.color', (sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`))" label="R" :max="255" v-model="sidebar.style.rgba.r"></v-slider>
        <v-slider hide-details @input="localstorage('sidebar.style.color', (sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`))" label="G" :max="255" v-model="sidebar.style.rgba.g"></v-slider>
        <v-slider hide-details @input="localstorage('sidebar.style.color', (sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`))" label="B" :max="255" v-model="sidebar.style.rgba.b"></v-slider>
        <v-slider hide-details @input="localstorage('sidebar.style.color', (sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`))" label="A" :max="100" v-model="sidebar.style.rgba.a"></v-slider>
      </v-card-text>
    </v-card>
  </v-card>
</v-navigation-drawer>
