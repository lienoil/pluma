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

  <v-divider></v-divider>

  <v-card flat tile :dark="theme.dark">
    <v-tabs
      :dark="theme.dark"
      v-model="rightsidebar.tabs.model"
      slider-color="secondary"
      >
      <v-tab ripple href="#appearance-tab">
        <v-icon>fa-paint-brush</v-icon>
      </v-tab>
      <v-tab ripple href="#datatable-tab">
        <v-icon>edit</v-icon>
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="rightsidebar.tabs.model">

      <v-tab-item id="appearance-tab">
        <v-card-text>
          <p class="body-2" v-html="trans('Theme')"></p>
          <v-switch
          :label="theme.dark ? `{{ __('Dark Theme') }}` : `{{ __('Light Theme') }}`"
          @change="localstorage({'single.theme.dark': theme.dark})"
          class="caption"
          v-model="theme.dark"
          ></v-switch>
          <p class="body-2" v-html="trans('Font size')"></p>
          <v-slider
            :max="40"
            :min="-1"
            :prepend-icon-cb="() => { localstorage({'single.settings.fontsize': (settings.fontsize=1)}) }"
            :prepend-icon="settings.fontsize === 1 ? 'font_download' : 'refresh'"
            @input="localstorage({'single.settings.fontsize': settings.fontsize})"
            role="button"
            step="1"
            thumb-label
            v-model="settings.fontsize"
            ></v-slider>
        </v-card-text>
      </v-tab-item>

      <v-tab-item id="datatable-tab">
        <v-card-text>
          <v-select :label="trans('Items per page')" :items="[5, 10, 25, {'-1': 'All'}]"></v-select>
        </v-card-text>
      </v-tab-item>
    </v-tabs-items>


  </v-card>

  {{-- <v-card flat tile :dark="theme.dark">
    <v-toolbar dense card :dark="theme.dark">
      <v-toolbar-title class="subheading">{{ __('Sidebar') }}</v-toolbar-title>
    </v-toolbar>

    <v-subheader>{{ __('Background') }}&nbsp;<v-divider></v-divider></v-subheader>
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
  </v-card> --}}
</v-navigation-drawer>
