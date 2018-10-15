<template>
  <section>
    <v-toolbar dark color="primary" class="elevation-2 sticky">
      <v-btn icon ripple @click="back()"><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title>Edit Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn :loading="resource.saving" ripple color="secondary" @click="save(resource.item)">{{ trans('Update') }}</v-btn>
    </v-toolbar>

    <v-card>
      <v-card-text>
        <v-text-field
          :label="trans('Title')"
          class="text-field--title"
          ></v-text-field>
      </v-card-text>
    </v-card>
  </section>
</template>

<script>
export default {
  name: 'Edit',
  data () {
    return {
      resource: {
        saving: false,
        form: { model: true },
        item: null
      }
    }
  },
  methods: {
    back () {
      this.$router.go(-1)
    },
    get () {
      this.$http.get('/api/v1/users/find', {params: {id: this.$route.params.user}})
        .then(response => {
          this.resource.item = response.data
        })
    },
    save (item) {
      console.log(item)
    },
    toggle (array, key) {
      array.map(item => {
        item[key] = !item[key]
      })
    }
  },
  mounted () {
    this.mountAttributes()
    this.get()
  }
}
</script>
