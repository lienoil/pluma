<template>
  <v-app id="app">
    <sidebar></sidebar>
    <utilitybar class="white elevation-1"></utilitybar>

    <main role="main">
      <v-container fluid grid-list-lg>
        <component :is="component.current"></component>
      </v-container>
    </main>

  </v-app>
</template>

<script>
  import Sidebar from './components/Sidebar.vue';
  import Utilitybar from './components/Utilitybar.vue'

  export default {
    name: 'app',
    components: {
      Sidebar,
      Utilitybar,
    },
    data () {
      return {
        component: {
          current: ''
        },

        sidebar: {
          items: [{title:'Courses'}]
        }
      }
    }
  }
</script>

<style scoped>
  @import '~vuetify/dist/vuetify.min.css';
</style>
