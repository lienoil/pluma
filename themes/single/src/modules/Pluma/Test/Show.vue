<template v-cloak>
  <section>
    <v-container fluid grid-list-lg>
     <!--  <v-layout row wrap>
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
        <!-- interactive media -->
        <v-flex
          :md8="course.md8"
          xs12
          order-md1 order-xs1
          >
          <v-card
            transition="scale-transition"
            >
            <v-card-media
              :src="course.thumbnail"
              class="primary lighten-1"
              height="500"
              >
              <div style="background: rgba(0, 0, 0, 0.60); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
              <v-layout row wrap justify-center fill-height align-center>
                <v-card flat class="transparent">
                  <v-icon
                    dark
                    @click=""
                    size="150"
                    >
                    play_arrow
                  </v-icon>
                </v-card>
              </v-layout>
            </v-card-media>
            <v-card-actions class="emphasis--medium">
              <v-spacer></v-spacer>
              <v-tooltip bottom>
                <v-btn
                  @click="fullscreen"
                  icon
                  slot="activator"
                  small
                  >
                  <v-icon>fullscreen</v-icon>
                </v-btn>
                <span v-html="course.md8 ? 'Theatre mode' : 'Default view'"></span>
              </v-tooltip>
            </v-card-actions>
          </v-card>

          <v-card
            flat
            class="mb-3 transparent my-4"
            >
            <v-card-text
              class="px-0"
              >
              <div class="primary--text text--lighten-2 body-1">
                <strong>PSDM SUP</strong>
              </div>
              <h2 v-html="course.title"></h2>
              <div class="grey--text">
                {{ course.created }} {{ trans('by') }}
                <a
                  class="author"
                  href=""
                  v-html="course.author"
                  >
                </a>
              </div>
            </v-card-text>
            <v-card-text
              class="px-0"
              v-html="course.description"
              >
            </v-card-text>
          </v-card>
        </v-flex>
        <!-- interactive media -->

        <!-- course playlist -->
        <v-flex
          :md4="course.md4"
          xs12
          class="text-xs-right"
          :order-md3="orderMd3" order-xs2
          >
          <v-card
            flat
            color="transparent"
            class="mb-3"
            >
            <v-expansion-panel
              flat
              class="elevation-0 mb-3 transparent"
              >
              <v-expansion-panel-content
                :key="i"
                class="transparent"
                flat
                v-for="(item,i) in course.chapters"
                >
                <div slot="header">
                  <div class="title"
                    v-html="item.chapterTitle"
                    >
                  </div>
                  <div class="grey--text"
                    v-html="item.chapterSubTitle"
                    >
                  </div>
                </div>

                <v-card class="transparent">
                  <v-list class="transparent">
                    <v-list-tile
                      ripple
                      @click=""
                      >
                      <v-list-tile-avatar>
                        <v-icon color="success">check</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title class="success--text">Introduction</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                      ripple
                      @click=""
                      >
                      <v-list-tile-avatar>
                        <v-icon color="secondary">play_arrow</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title class="secondary--text">Interaction</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                      ripple
                      @click=""
                      >
                      <v-list-tile-avatar>
                        <v-icon color="grey">lock</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title class="grey--text">Video</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                      ripple
                      @click=""
                      >
                      <v-list-tile-avatar>
                        <v-icon color="grey">lock</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title class="grey--text">Knowledge Check</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                  </v-list>
                </v-card>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-card>
        </v-flex>
        <!-- course playlist -->

        <!-- comment system -->
        <v-flex md8 xs12 order-md2 order-xs3>
          <!-- ckeditor@inline -->
          <v-card height="100" style="cursor: text;">
            <v-card-text>
              <p class="grey--text">
                {{ trans('Post a Comment...') }}
              </p>
            </v-card-text>
          </v-card>
          <!-- ckeditor@inline -->
          <v-card-actions class="py-3 px-0">
            <v-spacer></v-spacer>
            <v-btn color="secondary">
              {{ trans('Post Comment') }}
            </v-btn>
          </v-card-actions>

          <template>
            <v-card
              flat
              class="transparent text-xs-center"
              >
              <comment-icon width="120" height="120"></comment-icon>
              <v-card-text class="grey--text">
                <h3>There's nothing here</h3>
                <p>Fill me up, buttercup!</p>
              </v-card-text>
            </v-card>
          </template>
        </v-flex>
        <!-- comment system -->
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
import CommentIcon from '@/components/Icons/CommentIcon'

export default {
  store,

  components: {
    Lightbox,
    AddUserIcon,
    CommentIcon
  },

  data () {
    return {
      panel: [true, false],
      course: {
        orderMd3: false,
        md8: true,
        md4: true,
        title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea corporis sapiente, blanditiis voluptas, commodi aliquid officia magni temporibus nulla iusto, unde corrupti deserunt ipsum error labore praesentium voluptatem ipsam saepe.',
        created: '3 weeks ago',
        author: 'John Lenon',
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png',
        chapters: [
          {
            chapterTitle: 'Chapter 1',
            chapterSubTitle: 'How to interpret and analyse information received',
          },
          {
            chapterTitle: 'Chapter 2',
            chapterSubTitle: 'How to plan a response to information received',
          },
          {
            chapterTitle: 'Chapter 3',
            chapterSubTitle: 'How to use appropriate communication techniques',
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

  methods: {
    fullscreen () {
      this.course.md8 = !this.course.md8
      this.orderMd3 = !this.orderMd3
    }
  }
}
</script>
