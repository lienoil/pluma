<template>
  <div>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex sm6 xs12>
          <v-form
            method="POST"
            action="/api/v1/pages/store"
            @submit.prevent="storePage"
            >
            <v-text-field
               :data-vv-as="trans('Title')"
                :error-messages="errors.collect('title')"
                v-validate="'required'"
                outline
                autofocus
                label="Title"
                name="title"
                v-model="dataset.title"
            ></v-text-field>

            <v-text-field
               :data-vv-as="trans('Code')"
                :error-messages="errors.collect('code')"
                v-validate="'required'"
                outline
                autofocus
                label="Code"
                name="code"
                v-model="dataset.code"
            ></v-text-field>

            <v-text-field
              :data-vv-as="trans('Body')"
              outline
              autofocus
              label="Body"
              name="body"
              v-model="dataset.body"
            ></v-text-field>

            <!-- button -->
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
      dataset: {
        title: '',
        code: '',
        body: '',
      }
    }
  },

  methods: {
    beforeFormSubmit () {
      this.$validator.reset()
      this.$validator.validateAll()
        .then(ok => {
          if (ok) {
            this.storePage()
          }
        })
    },

    storePage () {
      axios.post('/api/v1/pages/store', this.dataset).then((response) => {
        console.log(this.dataset, 'data')
        this.$router.push({name: 'pages'})
      })
    },
  },
}
</script>
