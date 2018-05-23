<template>
  <v-card class="elevation-8">
    <v-card-text class="text-xs-center">
      <img class="mb-3" width="100px" :src="logo" :alt="title">
      <h4 class="headline" v-html="title"></h4>
      <p class="subheading" v-html="subtitle"></p>
    </v-card-text>
    <v-card-text>
      <v-form method="POST" v-model="resource.form.model">
        <input type="hidden" v-model="resource.item._token" name="_token">
        <v-text-field
          :error-messages="errors.collect('username')"
          :label="trans('Username or Email')"
          name="username"
          v-focus
          v-model="resource.item.username"
          v-validate="'required'"
          >
        </v-text-field>
        <v-text-field
          :append-icon-cb="() => (resource.item.passwordVisible = !resource.item.passwordVisible)"
          :append-icon="resource.item.passwordVisible ? 'visibility' : 'visibility_off'"
          :error-messages="errors.collect('password')"
          :label="trans('Password')"
          :type="resource.item.passwordVisible ? 'text': 'password'"
          name="password"
          v-model="resource.item.password"
          v-validate="'required'"
          >
        </v-text-field>
        <v-checkbox :color="color" v-model="resource.item.rememberMe" :label="trans('Remember me')"></v-checkbox>
        <v-btn :loading="resource.form.loading" :color="color" class="mx-0 mb-4" @click="login(resource.item)">{{ trans('Login') }}</v-btn>
      </v-form>

      <v-card-actions class="px-0">
        <a class="caption grey--text" exact href="/password/request" v-html="trans('Forgot password?')"></a>
        <v-spacer></v-spacer>
        <a class="caption grey--text" href="/register" v-html="trans('Create Account')"></a>
      </v-card-actions>
    </v-card-text>
  </v-card>
</template>

<script>
import { api } from '@/utils/api'
import { errors } from '@/utils/forms'

export default {
  name: 'LoginCard',
  props: {
    color: { type: String, default: 'primary' },
    logo: { type: String, default: '' },
    subtitle: { type: String, default: '' },
    title: { type: String, default: '' }
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
          username: null,
          password: null,
          passwordVisible: false,
          rememberMe: true
        }
      }
    }
  },
  methods: {
    login (credentials) {
      this.resource.form.loading = true
      this.$http.post(api.auth.login, credentials)
        .then(response => {
          if (response.status === 200) {
            this.$router.go({name: 'pages.create'})
          }
          this.resource.form.loading = false
        })
        .catch(error => {
          errors(error.response, this.errors)
          this.resource.form.loading = false
        })
    }
  },
  mounted () {
    //
  }
}
</script>
