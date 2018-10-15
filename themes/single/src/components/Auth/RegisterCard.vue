<template>
  <v-card :dark="dark">
    <slot name="header" props="{logo, title, subtitle}">
      <v-card-title v-if="title">
        <img v-if="logo" class="mb-3" width="100px" :src="logo" :alt="title">
        <h4 v-if="title" class="headline" v-html="title"></h4>
        <p v-if="subtitle" class="subheading" v-html="subtitle"></p>
      </v-card-title>
    </slot>
    <v-card-text>
      <div v-if="description" v-html="description"></div>

      <v-form lazy-validation v-model="resource.form.model" method="POST" autocomplete="off" @submit.prevent="register">

        <input type="hidden" v-model="resource.item._token" name="_token">

        <v-layout row wrap align-top>
          <v-flex xs6 align-top>
            <v-text-field
              :box="box"
              :data-vv-as="trans('First Name')"
              :error-messages="errors.collect('firstname')"
              :label="trans('First Name')"
              name="firstname"
              v-model="resource.item.firstName"
              v-validate="'required|alpha_spaces'"
              >
            </v-text-field>
          </v-flex>
          <v-flex xs6 align-top>
            <v-text-field
              :box="box"
              :data-vv-as="trans('Last Name')"
              :error-messages="errors.collect('lastname')"
              :label="trans('Last Name')"
              name="lastname"
              v-model="resource.item.lastname"
              v-validate="'required|alpha_spaces'"
              >
            </v-text-field>
          </v-flex>
        </v-layout>

        <v-text-field
          :box="box"
          :data-vv-as="trans('Email')"
          :error-messages="errors.collect('email')"
          :label="trans('Email')"
          autocomplete="off"
          name="email"
          type="email"
          v-model="resource.item.email"
          v-validate="'required|email'"
          >
        </v-text-field>

        <v-text-field
          :box="box"
          :append-icon-cb="() => (resource.item.passwordVisible = !resource.item.passwordVisible)"
          :append-icon="resource.item.passwordVisible ? 'visibility' : 'visibility_off'"
          :data-vv-as="trans('Password')"
          :error-messages="errors.collect('password')"
          :label="trans('Password')"
          :type="resource.item.passwordVisible ? 'text': 'password'"
          autocomplete="off"
          name="password"
          v-model="resource.item.password"
          v-validate="'required'"
          >
        </v-text-field>
        <v-text-field
          :box="box"
          :append-icon-cb="() => (resource.item.passwordVisible = !resource.item.passwordVisible)"
          :append-icon="resource.item.passwordVisible ? 'visibility' : 'visibility_off'"
          :data-vv-as="trans('Password Confirmation')"
          :error-messages="errors.collect('password_confirmation')"
          :label="trans('Password Confirmation')"
          :type="resource.item.passwordVisible ? 'text': 'password'"
          name="password_confirmation"
          v-model="resource.item.password_confirmation"
          v-validate="'required'"
          >
        </v-text-field>

        <v-checkbox
          :color="color"
          :data-vv-as="trans('Terms and Conditions')"
          :error-messages="errors.collect('terms_and_conditions')"
          name="terms_and_conditions"
          v-model="resource.item.terms_and_conditions"
          v-validate="'required'"
          >
          <span slot="label">
            {{trans('I accept the ')}}
            <a :href="api.termsAndConditions">{{trans('Terms of use')}}</a>
            {{trans('and')}}
            <a :href="api.privacyPolicy">{{trans('Privacy Policy')}}</a>
          </span>
        </v-checkbox>


      </v-form>

    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn
        :color="color"
        :loading="resource.form.loading"
        @click.prevent="register(resource.item)"
        type="submit"
        >
        {{ trans('Sign Up') }}
      </v-btn>
  </v-card-actions>
    <!-- <v-card-actions>
      <v-spacer></v-spacer>
      <a class="caption grey--text" exact :href="api.privacyPolicy" v-html="trans('Privacy and Policy')"></a>
    </v-card-actions> -->
  </v-card>
</template>

<script>
import { _$api } from './api'
import { errors } from '@/utils/forms'

export default {
  name: 'RegisterCard',
  $_veeValidate: {
    validator: 'new'
  },
  props: {
    box: { type: String, default: false },
    color: { type: String, default: 'primary' },
    dark: { type: Boolean, default: false },
    logo: { type: String, default: '' },
    subtitle: { type: String, default: '' },
    title: { type: String, default: '' },
    description: { type: String, default: '' }
  },
  data () {
    return {
      api: _$api,
      resource: {
        form: {
          model: false,
          loading: false
        },
        item: {
          _token: this.$root.$token,
          firstname: null,
          lastname: null,
          email: null,
          password: null,
          password_confirmation: null,
          passwordVisible: false,
          terms_and_conditions: false
        }
      }
    }
  },
  methods: {
    register (credentials) {
      if (this.errors.any()) {
        return
      }

      this.resource.form.loading = true
      this.$http.post(this.api.register, credentials)
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
