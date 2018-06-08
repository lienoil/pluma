<template>
  <login-card :title="app.title" :logo="app.logo"></login-card>
</template>

<script>
import { app } from '@/api/app.js'

export default {
  name: 'Login',
  data () {
    return {
      app
    }
  }
}
</script>
