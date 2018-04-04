<template>
  <div>
    <v-toolbar light color="white" class="elevation-1 sticky">
      <v-toolbar-title class="grey--text text--darken-1">Show Page</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12 sm8 md9>
          <scorm-player version="1.2" src="http://pluma/storage/public/package/2018-02-27/7/course/index.html?type=scorm" :debug="true"></scorm-player>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import ScormPlayer from '@/components/Play/SCORMPlayer.vue'

export default {
  name: 'Show',
  components: {
    'scorm-player': ScormPlayer
  }
}
</script>
