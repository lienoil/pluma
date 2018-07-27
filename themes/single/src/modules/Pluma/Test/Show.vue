<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <template v-for="(item, i) in dataset.items">
            <v-card>
              <v-card-text v-html="item.title"></v-card-text>
              <v-card-text v-html="item.category"></v-card-text>
            </v-card>
          </template>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  data () {
    return {
      dataset: {
        items: [
          {
            title: 'A Series',
            category: 'PSDM'
          },
        ]
      }
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      dataiterator: 'dataiterator/dataiterator',
      toolbar: 'toolbar/toolbar',
      datatable: 'datatable/datatable',
    })
  },

  methods: {
  }
}
</script>
