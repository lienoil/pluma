<template>
  <div>
    <v-toolbar light color="white" class="elevation-1 sticky">
      <v-toolbar-title class="grey--text text--darken-1">Create Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu>
        <v-btn slot="activator" icon small><v-icon small>settings</v-icon></v-btn>
        <v-list>
          <v-list-tile @click="">
            <v-list-tile-action>
              <v-icon>drafts</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Save as Draft</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-btn :loading="resource.saving" ripple color="primary" @click="save(resource.item)">Save</v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex xs12 sm8 md9>
          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </div>
</template>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
