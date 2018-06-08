<template>
  <v-app :dark="theme.dark">
    <v-content>
      <v-jumbotron class="grey lighten-3" :xgradient="`to top right, #022242 10%, #420224 100%`" height="100%">
        <v-container fluid fill-height>
          <v-layout row wrap justify-center align-center>
            <v-flex lg3 md4 sm8 xs12 justify-center align-center>
              <router-view></router-view>
            </v-flex>
          </v-layout>
        </v-container>
      </v-jumbotron>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'Auth'
}
</script>
