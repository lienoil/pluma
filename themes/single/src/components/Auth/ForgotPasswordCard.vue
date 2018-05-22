<template>
  <v-form action="/password/send" method="POST">
    <input type="hidden" name="_token" :value="resource.item._token">
    <v-text-field v-title solo hide-details v-model="resource.item.email" prepend-icon="email" :placeholder="trans('email@domain.com')" class="mb-3" type="email"></v-text-field>
    <v-btn large type="submit" class="ma-0" color="primary" @click="send(resource.item)">@{{ trans("Send Reset Link") }}</v-btn>
  </v-form>
</template>

<script>
export default {
  name: 'ForgotPasswordCard',
  props: {
    logo: { type: String, default: '' },
    title: { type: String, default: '' },
    subtitle: { type: String, default: '' }
  },
  data () {
    return {
      resource: {
        form: {
          model: true,
          loading: false
        },
        item: {
          _token: this.$root.$token,
          email: ''
        }
      }
    }
  },
  methods: {
    send (credentials) {
      this.resource.form.loading = true
      this.$http.post('/password/send', credentials)
        .then(response => {
          this.resource.form.loading = false
          if (response.status === 200) {
            this.$root.$router.go({name: 'pages.create'})
          }
        })
    }
  }
}
</script>
