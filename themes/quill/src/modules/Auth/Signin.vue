<template>

  <v-container fluid fill-height>
    <v-layout row wrap fill-height align-center justify-center>
      <v-flex xs12 sm8 md4 lg3 fill-height align-center justify-center>

        <login-form></login-form>

      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import LoginForm from './cards/LoginForm';

export default {
  components: {
    LoginForm,
  },
}
</script>
