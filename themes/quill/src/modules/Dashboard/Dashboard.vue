<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex xs12>
        <p>Dis the sd dashboard right here</p>

        <a href="#" @click.prevent="logout">Logout</a>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Cookies from 'js-cookie';
import store from '@/store'

export default {
  store,

  methods: {
    logout () {
      this.$store.dispatch('auth/AUTH_LOGOUT')
        .then(() => {
          this.$router.go({name: 'login.show'})
        })
    }
    // window.axios.get('/api/v1/users/all?token='+Cookies.get('user-token')).then(response => {
    //   console.log(response);
    // });
  }
}
</script>
