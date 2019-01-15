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
            <v-text-field
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
            </v-text-field>

            <v-textarea
              name="input-7-1"
              box
              label="Username"
              v-model="dataset.username"
              auto-grow
            ></v-textarea>

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

  // created () {
  //   console.log(this.categories.items, 'data')
  //   axios.get('/api/v1/categories/announcements/all').then(response => {
  //     this.categories.items = response.data.data
  //   })
  // },

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

    remove (item) {
      const index = this.categoryModel.indexOf(item.name)
      if (index >= 0) this.categoryModel.splice(index, 1)
    }
  },
}
</script>
