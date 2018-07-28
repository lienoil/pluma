<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <!-- <template v-for="(item, i) in dataset.items">
            <v-card>
              <v-card-text v-html="item.title"></v-card-text>
              <v-card-text v-html="item.category"></v-card-text>
            </v-card>
          </template> -->

          <timeline></timeline>
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-flex xs12>
          <v-card style="margin: 6px;" color="primary" height="160px"></v-card>
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-flex xs12>
          <v-card class="mb-3">
            <lightbox
              id="mylightbox"
              :images="lightbox.images"
              :image_class=" 'img-responsive' "
              :options="lightbox.options">
            </lightbox>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<style>
  .my-gallery a img {
    /*max-height: 160px;*/
    /*width: auto !important;*/
    /*height: 160px !important;*/
    margin: 6px !important;
    border: none !important;
    width: 24% !important;
  }

  .my-gallery a:hover img {
    box-shadow: 0 5px 25px -2px rgba(0,0,0,.1), 0 8px 50px 1px rgba(0,0,0,.1), 0 3px 70px 2px rgba(0,0,0,.1);
    z-index: 1 !important;
  }

  .my-galley a {
    display: flex !important;
    overflow: hidden !important;
    position: absolute !important;
    height: 120px !important;
    width: 20 !important;
  }
</style>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'
import Lightbox from 'vue-simple-lightbox'

export default {
  store,

  components: {
    Lightbox
  },

  data () {
    return {
      dataset: {
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
