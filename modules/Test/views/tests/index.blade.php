@extends("Theme::layouts.admin")

@section("main-content")
  <v-container fluid>
    <v-flex sm4>
      <mediabox hide-toolbar>
        <template slot="no-image-text" slot-scope="{noImageText}">
          <p>@{{ noImageText }}</p>
        </template>
      </mediabox>
    </v-flex>
  </v-container>
@endsection
