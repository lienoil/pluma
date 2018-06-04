<template>
  <v-card :dark="dark">
    <v-card-text class="text-xs-center">
      <img class="mb-3" width="100px" :src="logo" :alt="title">
      <h4 class="headline" v-html="title"></h4>
      <p class="subheading" v-html="subtitle"></p>
    </v-card-text>
    <v-card-text>
      <v-form lazy-validation v-model="resource.form.model" method="POST" autocomplete="off" @keyup.enter="login" @submit.prevent="login">

        <input type="hidden" v-model="resource.item._token" name="_token">

        <v-text-field
          :box="box"
          :data-vv-as="trans('Username or Email')"
          :dark="dark"
          :error-messages="errors.collect('username')"
          :label="trans('Username or Email')"
          autocomplete="off"
          name="username"
          v-focus
          v-model="resource.item.username"
          v-validate="'required'"
          >
        </v-text-field>

        <v-text-field
          :box="box"
          :append-icon-cb="() => (resource.item.passwordVisible = !resource.item.passwordVisible)"
          :append-icon="resource.item.passwordVisible ? 'visibility' : 'visibility_off'"
          :data-vv-as="trans('Password')"
          :dark="dark"
          :error-messages="errors.collect('password')"
          :label="trans('Password')"
          :type="resource.item.passwordVisible ? 'text': 'password'"
          autocomplete="off"
          name="password"
          v-model="resource.item.password"
          v-validate="'required'"
          >
        </v-text-field>

        <v-btn
          :color="color"
          :loading="resource.form.loading"
          @click.prevent="login(resource.item)"
          block
          class="mx-0 mb-4"
          large
          type="submit"
          >
          {{ 'Login' }}
        </v-btn>

        <v-checkbox
          :color="color"
          :label="trans('Remember me')"
          hide-details
          name="remember"
          v-model="resource.item.remember"
          >
        </v-checkbox>
      </v-form>

    </v-card-text>
    <v-card-actions>
      <a class="caption grey--text" exact :href="api.forgotPassword" v-html="trans('Forgot password?')"></a>
      <v-spacer></v-spacer>
      <a class="caption grey--text" :href="api.register" v-html="trans('Create Account')"></a>
    </v-card-actions>
  </v-card>
</template>

<script>
import { _$api } from './api'
import { errors } from '@/utils/forms'

export default {
  $_veeValidate: {
    validator: 'new'
  },
  name: 'LoginCard',
  props: {
    box: { type: String, default: false },
    color: { type: String, default: 'primary' },
    dark: { type: Boolean, default: false },
    logo: { type: String, default: '' },
    subtitle: { type: String, default: '' },
    title: { type: String, default: '' }
  },
  data () {
    return {
      api: _$api,
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
          remember: true
        }
      }
    }
  },
  methods: {
    login (credentials) {
      this.resource.form.loading = true
      this.$validator.reset()
      this.$validator.validateAll()
        .then(result => {
          if (result) {
            this.$http.post(this.api.login, credentials)
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
        })
    }
  },
  mounted () {
    //
  }
}
</script>
