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
export default {
  mounted() {
    let token = window.localStorage.getItem('jwt');

    window.axios.defaults.headers.common['Content-Type'] = 'application/json'
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

    window.axios.get('/api/v1/users/all').then(response => {
      console.log(response);
    });
  }
}
</script>
