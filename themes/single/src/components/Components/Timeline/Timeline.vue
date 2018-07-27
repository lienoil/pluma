<template>
  <v-card
    class="transparent"
    flat
    id="timeline"
    >
    <v-card-title>
      <h3>July 2018</h3>
    </v-card-title>
    <v-layout row wrap>
      <v-flex md2 xs12>
        <v-subheader>July 20, 2018</v-subheader>
      </v-flex>
      <v-flex md10 xs12>
        <template v-if="dataset.model">
          <v-card>
            <template v-for="item in dataset.items">
              <v-card-text>
                <span class="subheading mb-3">
                  <a v-html="item.user" href=""></a>
                  <span v-html="item.activity"></span>
                </span>
                <v-spacer></v-spacer>
                <v-icon small>schedule</v-icon>
                <span
                  class="body-1 text--emphasis-medium"
                  v-html="item.created">
                </span>
              </v-card-text>
              <v-divider></v-divider>
            </template>
          </v-card>
        </template>
        <template v-else>

        </template>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import store from '@/store'
import { mapGetters, mapActions } from 'vuex'

export default {
  store,
  name: 'Timeline',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {}
    }
  },

  methods: {

  },

  mounted () {
    this.dataset = Object.assign({}, this.timeline, this.items)
  },

  computed: {
    ...mapGetters({
      timeline: 'timeline/timeline'
    })
  }
}
</script>
