<template>
  <v-container fluid grid-list-lg>
    <form method="POST">
      <v-layout row wrap>
        <v-flex sm8>
          <input type="hidden" name="">
          <input type="hidden" name="_method" value="PUT">

          <v-text-field class="mb-3 headline" solo label="Title" name="title" v-model="resource.item.title"></v-text-field>

          <v-card>
            <!-- SAMPLE -->
            <img src="@/assets/editor.png" width="100%">
          </v-card>
        </v-flex>
        <v-flex sm4>

          <v-card>

          </v-card>

        </v-flex>
      </v-layout>
    </form>
  </v-container>
</template>

<script>
export default {
  name: 'Edit',
  data () {
    return {
      resource: {
        item: {
          title: '',
          code: '',
          feature: '',
          user_id: '',
          body: '',
          delta: ''
        }
      }
    }
  },
  methods: {
    get () {
      let query = {
        id: this.$route.params.page
      }
      this.$http.get('/api/v1/pages/find', {params: query})
        .then(response => {
          this.resource.item = response.data
          // console.log(response)
        })
    }
  },
  mounted () {
    this.get()
  }
}
</script>
