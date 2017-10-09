<template>
  <div id="app">
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <v-card class="elevation-1 grey lighten-4">
            <vue-component paper source v-model="quill.content" class="white" :fonts="['Roboto']" :toolbar-options="['bold']"></vue-component>
          </v-card>
          <div class="ql-editor" v-html="quill.content.html"></div>
          <span v-html="quill.content.delta"></span>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Vue from 'vue'
import Quill from '../src/Quill.vue'

export default {
  name: 'app',
  components: { 'vue-component': Quill },
  data () {
    return {
      quill: {
        content: {}
      }
    }
  }
}
</script>

<style lang="scss">
@import "~vuetify/dist/vuetify.min.css";
@import "~quill/dist/quill.snow.css";
</style>
