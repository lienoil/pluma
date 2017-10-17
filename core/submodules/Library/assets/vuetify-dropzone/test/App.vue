<template>
  <div id="app">
    <v-app>
      <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex sm6 offset-sm3>
            <v-card>
              <vue-component fallback-url="http://localhost:8000/upload.php" :options="{url:'http://localhost:8000/upload.php', params: {name: name}}">
                <template>
                  <v-text-field label="Name" v-model="name"></v-text-field>
                  <v-text-field label="Catalogue"></v-text-field>
                  <v-text-field label="Test"></v-text-field>
                </template>
              </vue-component>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import Component from '../src/Component.vue'

export default {
  name: 'app',
  components: { 'vue-component': Component },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      name: 'lorem'
    }
  }
}
</script>

<style>
  @import "~vuetify/dist/vuetify.min.css";
</style>
