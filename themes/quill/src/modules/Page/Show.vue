<template>
  <div>
    <v-container grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <v-card>
            <v-card-text>
              <h1 class="title font-weight-bold" v-html="item.title"></h1>
              <h1 class="title font-weight-bold" v-html="item.author"></h1>
              <v-list dense>
                <v-list-tile>
                  <v-list-tile-content>
                    <v-list-tile-title v-html="item.author"></v-list-tile-title>
                    <v-list-tile-sub-title v-html="item.created"></v-list-tile-sub-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import store from '@/store'

export default {
  store,

  name: 'Show',

  mounted () {
    /*eslint-disable*/
    axios.get('/api/v1/pages/' + this.$route.params.code).then(response => {
        // console.log(response, 'data')
        this.item = response.data
      })
  },

  data () {
    return {
      item: {}
    }
  },
}
</script>
