<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-flex xs12>
          <v-card flat class="transparent">
            <v-card-title>
              <h3>July 2018</h3>
            </v-card-title>
            <v-layout row wrap>
              <v-flex md3 xs12>
                <v-subheader>July 20, 2018</v-subheader>
              </v-flex>
              <v-flex md9 xs12>
                <v-card>
                  <v-card-title>
                    <span class="subheading mb-3">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, repudiandae aliquid voluptate sunt nihil impedit voluptatem sit hic illo necessitatibus provident modi dolore velit! Necessitatibus quae iusto inventore, nesciunt mollitia?
                    </span>
                    <v-spacer></v-spacer>
                    <span class="body-1 text--emphasis-medium">
                      <v-icon small>schedule</v-icon> 9:00am
                    </span>
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-card-text>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dignissimos, necessitatibus nihil earum consectetur expedita molestias. Rerum illo ea alias qui placeat sed eos aperiam, laboriosam dolor accusantium eius quibusdam.
                  </v-card-text>
                </v-card>
              </v-flex>
            </v-layout>
          </v-card>
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
