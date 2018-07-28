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
        <template v-for="(item, i) in dataset.items">
            <v-card>
              <v-card-text v-html="item.title"></v-card-text>
              <v-card-text v-html="item.category"></v-card-text>
            </v-card>
          </template>
        </template>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

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
