<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-flex xs12>
          <timeline></timeline>
      </v-flex>
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

    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      dataiterator: 'dataiterator/dataiterator',
      toolbar: 'toolbar/toolbar'
    })
  },
}
</script>
