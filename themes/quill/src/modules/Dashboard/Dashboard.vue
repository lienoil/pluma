<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex xs12>
        <p>Dis the sd dashboard right here</p>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Cookies from 'js-cookie';

export default {
  mounted() {

    window.axios.get('/api/v1/users/all?token='+Cookies.get('user-token')).then(response => {
      console.log(response);
    });
  }
}
</script>
