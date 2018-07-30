<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <template v-if="dataset.loaded">
            <timeline></timeline>
          </template>
          <template v-else>
            <v-card flat class="transparent text-xs-center">
              <add-user-icon width="80px" height="80px"></add-user-icon>
              <v-card-text class="grey--text">
                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet blanditiis commodi est hic voluptas, magnam ullam reiciendis sequi cum id accusamus vitae odio, ab cupiditate dolorem quas voluptate maiores deserunt.</h3>
              </v-card-text>
            </v-card>
          </template>
        </v-flex>
      </v-layout>

      <!-- <v-layout row wrap>
        <v-flex xs12>
          <v-card class="mb-3">
            <lightbox :images="lightbox.images"></lightbox>
          </v-card>
        </v-flex>
      </v-layout> -->
    </v-container>
  </section>
</template>

<style>
  .simple-lightbox .sl-close {
    color: #fff !important;
  }

  .my-gallery a img {
    margin: 6px !important;
    border: none !important;
    width: 19% !important;
  }

  .my-gallery a:hover img {
    box-shadow: 0 5px 25px -2px rgba(0,0,0,.1),
                0 8px 50px 1px rgba(0,0,0,.1),
                0 3px 70px 2px rgba(0,0,0,.1);
    z-index: 1 !important;
  }

  .my-galley a {
    color: red !important;
    display: flex !important;
    overflow: hidden !important;
    position: absolute !important;
  }
</style>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'
import Lightbox from 'vue-simple-lightbox'
import AddUserIcon from '@/components/Icons/AddUserIcon'

export default {
  store,

  components: {
    Lightbox,
    AddUserIcon
  },

  data () {
    return {
      dataset: {
        loaded: false,
        items: [
          {
            title: 'A Series',
            category: 'PSDM'
          },
        ]
      },

      lightbox: {
        images: [
          {
            src: 'https://cdn.dribbble.com/users/904433/screenshots/3884774/engagement_dribbble.png',
            title: ''
          },
          {
            src: 'https://cdn.dribbble.com/users/2559/screenshots/3145041/illushome.png',
            title: ''
          },
          {
            src: 'https://cdn.dribbble.com/users/2559/screenshots/2932883/illustration-engagement.png',
            title: ''
          },
          {
            src: 'https://cdn.dribbble.com/users/1294892/screenshots/3536824/laptop-01-01.jpg',
            title: ''
          },
          {
            src: 'https://cdn.dribbble.com/users/1596469/screenshots/3626310/test.png',
            title: ''
          },
          {
            src: 'https://cdn.dribbble.com/users/385430/screenshots/3333398/engineering_illo.png',
            title: ''
          },
        ],
        options: {
          closeText: 'x'
        }
      },
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

  methods: {}
}
</script>
