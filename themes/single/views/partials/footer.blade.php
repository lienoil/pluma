<v-footer app inset absolute height="auto">
  <v-container fluid>
    <v-layout row wrap>
      <v-flex tag="small" class="grey--text">{!! $application->site->copyright !!}</v-flex>
      <v-spacer></v-spacer>
      <v-flex tag="small" class="grey--text text-xs-right" justify-end>{{ $application->version }}</v-flex>
    </v-layout>
  </v-container>
</v-footer>
