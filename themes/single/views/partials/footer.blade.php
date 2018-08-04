<v-footer app inset fixed height="auto">
  <v-layout row wrap>
    <v-flex tag="small" class="text-emphasis--medium">{!! $application->site->copyright !!}</v-flex>
    <v-spacer></v-spacer>
    <v-flex tag="small" class="text-emphasis--medium text-xs-right" justify-end>{{ $application->version }}</v-flex>
  </v-layout>
</v-footer>
