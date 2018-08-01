<template>
  <section>
    <v-container grid-list-lg>
   <!--    <v-layout row wrap>
        <v-flex xs12>
          <template v-if="dataset.loaded">
            <timeline></timeline>
          </template>
          <template v-else>
            <v-card
              flat
              class="transparent text-xs-center"
              height="70vh"
              >
              <v-layout fill-height column justify-center align-center>
                <add-user-icon width="120" height="120"></add-user-icon>
                <v-card-text class="grey--text">
                  <h3>You do not have any resources on this module.</h3>
                  <p>Start upload by clicking the button below.</p>
                  <v-btn color="secondary">
                    {{ trans('Create Test') }}
                  </v-btn>
                </v-card-text>
              </v-layout>
            </v-card>
          </template>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs12>
          <v-card class="mb-3">
            <lightbox :images="lightbox.images"></lightbox>
          </v-card>
        </v-flex>
      </v-layout> -->

      <v-card
        flat
        color="transparent"
        class="mb-3"
        >
        <v-tooltip right>
          <v-btn
            color="secondary"
            fab
            icon
            slot="activator"
            small
            >
            <v-icon ripple>chevron_left</v-icon>
          </v-btn>
          <span>{{ trans('Back to Courses') }}</span>
        </v-tooltip>
      </v-card>

      <v-layout row wrap>
          <v-flex
            :md8="course.md8"
            xs12
            >
            <v-card>
              <v-card-media
                class="primary lighten-1"
                :src="course.thumbnail"
                height="500"
                >
              </v-card-media>
              <v-card-actions class="emphasis--medium">
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <v-btn
                    @click="course.md8 = !course.md8"
                    icon
                    small
                    slot="activator"
                    >
                    <v-icon>fullscreen</v-icon>
                  </v-btn>
                  <span v-html="course.md8 ? 'Theatre mode' : 'Default view'"></span>
                </v-tooltip>
              </v-card-actions>
            </v-card>
          </v-flex>

          <v-flex
          :md4="course.md4"
          xs12
          >
          <v-card
            flat
            color="transparent"
            class="mb-3"
            >
            <v-expansion-panel flat class="elevation-0 py-3 transparent">
              <v-expansion-panel-content
                v-for="(item,i) in course.chapters"
                :key="i"
                class="transparent"
                flat
                >
                <div slot="header">
                  <div class="title" v-html="item.chapterTitle"></div>
                  <div class="grey--text" v-html="item.chapterSubTitle"></div>
                </div>
                <v-card>
                  <v-list>
                    <v-list-tile ripple @click="">
                      <v-list-tile-avatar>
                        <v-icon>play_arrow</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title>Introduction</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                  </v-list>
                </v-card>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-card>
        </v-flex>
      </v-layout>
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
      panel: [true, false],
      course: {
        md8: true,
        md4: true,
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png',
        chapters: [
          {
            chapterTitle: 'Chapter 1',
            chapterSubTitle: 'Lorem ipsum dolor',
          }
        ],
      },

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
