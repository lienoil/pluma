<template>
  <div>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex sm6 xs12>
          <v-form
            method="POST"
            action="/api/v1/users/store"
            @submit.prevent="storeData"
            >
            <!-- <v-text-field
              label="First Name"
              box
              v-model="dataset.firstname"
              >
            </v-text-field>

            <v-text-field
              label="Last Name"
              box
              v-model="dataset.lastname"
              >
            </v-text-field>

            <v-text-field
              label="Username"
              box
              v-model="dataset.username"
              >
            </v-text-field>

            <v-text-field
              label="Email Address"
              box
              v-model="dataset.email"
              >
            </v-text-field>

            <v-text-field
              label="Password"
              box
              v-model="dataset.password"
              >
            </v-text-field> -->

            <v-text-field
              :data-vv-as="trans('First Name')"
              :error-messages="errors.collect('firstname')"
              v-validate="'required'"
              outline
              autofocus
              label="First Name"
              name="firstname"
              v-model="dataset.firstname"
            ></v-text-field>

            <v-text-field
              :data-vv-as="trans('Last Name')"
              :error-messages="errors.collect('lastname')"
              v-validate="'required'"
              outline
              autofocus
              label="Last Name"
              name="lastname"
              v-model="dataset.lastname"
            ></v-text-field>

            <v-text-field
              :data-vv-as="trans('Username')"
              :error-messages="errors.collect('username')"
              v-validate="'required'"
              outline
              autofocus
              label="Username"
              name="username"
              v-model="dataset.username"
            ></v-text-field>

            <v-text-field
              :data-vv-as="trans('Avatar')"
              :error-messages="errors.collect('avatar')"
              outline
              autofocus
              label="Avatar"
              name="avatar"
              v-model="dataset.avatar"
              >
            </v-text-field>

            <v-text-field
              :data-vv-as="trans('Email Address')"
              :error-messages="errors.collect('email')"
              v-validate="'required'"
              outline
              autofocus
              label="Email Address"
              name="email"
              v-model="dataset.email"
            ></v-text-field>

            <v-text-field
              :data-vv-as="trans('Password')"
              :error-messages="errors.collect('password')"
              v-validate="'required'"
              outline
              autofocus
              label="Password"
              name="password"
              type="password"
              v-model="dataset.password"
            ></v-text-field>
            <v-btn class="secondary" type="submit">{{ __('Create') }}</v-btn>
          </v-form>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import store from '@/store'

export default {
  $_veeValidate: {
    validator: 'new'
  },

  store,
  name: 'Create',

  data () {
    return {
      dataset: []
    }
  },

  methods: {
    beforeFormSubmit () {
      this.$validator.reset()
      this.$validator.validateAll()
        .then(ok => {
          if (ok) {
            this.storeData()
          }
        })
    },

    storeData () {
      axios.post('/api/v1/users/store', this.dataset).then((response) => {
        this.$router.push({name: 'users'})
      })
    },
  },
}
</script>
