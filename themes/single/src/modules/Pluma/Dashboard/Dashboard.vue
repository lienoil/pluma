<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm6 md4 v-for="(w, i) in widgets" :key="i">
        <v-card>Dasdasd</v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'Dashboard',
  data () {
    return {
      widgets: [1, 2, 3, 4]
    }
  }
}
</script>
