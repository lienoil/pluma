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

      <!-- course completed -->
      <v-snackbar
        :color="$root.theme.dark ? 'white' : 'dark'"
        :timeout="course.snackbarTimeout"
        bottom
        right
        v-model="course.snackbar"
        >
        <span
          class="subheading"
          :class="$root.theme.dark ? 'black--text' : 'white--text'"
          >
          {{ trans('You have already finished this part of the lesson') }}
        </span>
        <v-btn
          @click="course.snackbar = false"
          icon
          >
          <v-icon
            :class="$root.theme.dark ? 'black--text' : 'white--text'"
            >
            close
          </v-icon>
        </v-btn>
      </v-snackbar>
      <!-- course completed -->

      <!-- <v-card
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
      </v-card> -->

      <v-layout row wrap>
        <!-- interactive media -->
        <v-flex
          :md8="course.md8"
          xs12
          order-md1 order-xs1
          >
          <v-card
            class="mb-3"
            transition="scale-transition"
            >
            <v-card-media
              :src="course.thumbnail"
              style="background: linear-gradient(135deg, #003073, #029797);"
              height="500"
              >
              <!-- enrolled -->
              <template v-if="course.enrolled">
                <template v-if="course.locked">
                  <div class="card--overlay"></div>
                  <v-layout align-center justify-center row fill-height>
                    <v-card flat dark class="transparent">
                      <v-card-text>
                        <h2>This part is still locked.</h2>
                        <p>Please finish the previous interaction.</p>
                        <v-btn large color="secondary">Go to Current Course</v-btn>
                      </v-card-text>
                    </v-card>
                  </v-layout>
                </template>

                <template v-else>
                  <template v-if="course.isForm > 2">
                    <v-card flat class="transparent">
                      <v-card-text>
                        {{ trans('Insert form here.') }}
                      </v-card-text>
                    </v-card>
                  </template>
                  <template v-else-if="course.isForm > 0">
                    <v-layout row wrap fill-height justify-center align-center>
                      <v-card flat class="transparent">
                        <v-card-text>
                          <div class="mb-3">
                            <media-icon width="180" height="180"></media-icon>
                          </div>
                          <div>
                            {{ trans('No interactive content for this lesson. Fill me up!') }}
                          </div>
                        </v-card-text>
                      </v-card>
                    </v-layout>
                  </template>
                  <template v-else>
                    <div class="card--overlay"></div>
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
                  </template>
                </template>
              </template>

              <!-- not enrolled -->
              <template v-else>
                <div class="card--overlay"></div>
                <v-layout align-center justify-center row fill-height>
                  <v-card flat dark class="transparent">
                    <v-card-text>
                      <h2>You are not enrolled in this course.</h2>
                      <p>Enroll now to get access on this course.</p>
                      <v-btn large color="secondary">Enroll Now</v-btn>
                    </v-card-text>
                  </v-card>
                </v-layout>
              </template>
            </v-card-media>
            <template v-if="course.enrolled">
              <v-card-actions class="emphasis--medium">
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <v-btn
                    @click="viewMode"
                    icon
                    slot="activator"
                    >
                    <v-icon v-html="course.md8 ? 'crop_landscape' : 'crop_square'"></v-icon>
                  </v-btn>
                  <span v-html="course.md8 ? 'Theatre mode' : 'Default view'"></span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-btn
                    @click=""
                    icon
                    slot="activator"
                    >
                    <v-icon>fullscreen</v-icon>
                  </v-btn>
                  <span>{{ trans('Fullscreen') }}</span>
                </v-tooltip>
              </v-card-actions>
            </template>
          </v-card>

          <!-- pre/next button -->
          <template v-if="course.enrolled">
            <v-card-actions
              class="px-0"
              >
              <v-btn dark icon color="secondary">
                <v-icon
                  >
                  chevron_left
                </v-icon>
              </v-btn>
              <span class="secondary--text mx-3">{{ trans('Previous') }}</span>
              <v-spacer></v-spacer>
              <span class="secondary--text mx-3">{{ trans('Next') }}</span>
              <v-btn dark icon color="secondary">
                <v-icon
                  >
                  chevron_right
                </v-icon>
              </v-btn>
            </v-card-actions>
          </template>
          <!-- pre/next button -->
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
              class="elevation-0 mb-3 transparent"
              expand
              flat
              v-model="course.panel"
              >
              <v-expansion-panel-content
                :key="i"
                class="transparent"
                flat
                v-for="(item,i) in course.chapters"
                >
                <div slot="header">
                  <div
                    class="title"
                    :class="item.headerClass"
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

        <v-flex md8 xs12 order-md2 order-xs3>
          <v-card
            class="mb-5"
            >
            <v-tabs
              v-model="active"
              color="emphasis--medium"
              slider-color="accent"
              >
              <v-tab
                ripple
                key="overview"
                id="overview"
                >
                {{ trans('Overview') }}
              </v-tab>
              <v-tab
                ripple
                key="resources"
                id="overview"
                >
                {{ trans('Resources') }}
              </v-tab>

              <v-tab-item href="#overview">
                <v-card flat>
                  <v-card-text>
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
                    v-html="course.description"
                    >
                  </v-card-text>
                </v-card>
              </v-tab-item>
              <v-tab-item ref="#resources">
                <v-card flat>
                  <v-card-text class="text-xs-center">
                    <assignment-icon width="120" height="120"></assignment-icon>
                  </v-card-text>
                  <v-card-text class="text-xs-center">
                    No assignments for this course.
                  </v-card-text>
                </v-card>
              </v-tab-item>
            </v-tabs>
          </v-card>

          <!-- comment system -->
          <!-- ckeditor@inline -->
          <empty-state></empty-state>
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
          <!-- comment system -->
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
import EmptyState from './partials/EmptyState.vue'

export default {
  store,
  EmptyState,

  data () {
    return {
      course: {
        isForm: 0,
        panel: [true, false, false],
        snackbarTimeout: 0,
        snackbar: true,
        enrolled: true,
        locked: false,
        orderMd3: false,
        md8: true,
        md4: true,
        title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea corporis sapiente, blanditiis voluptas, commodi aliquid officia magni temporibus nulla iusto, unde corrupti deserunt ipsum error labore praesentium voluptatem ipsam saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dignissimos alias odio architecto atque minus earum, iste aliquam laboriosam, reprehenderit sint in quas voluptas, consequatur. Neque libero doloribus esse qui.',
        created: '3 weeks ago',
        author: 'Lemony Snicket',
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png',
        chapters: [
          {
            chapterTitle: 'Chapter 1',
            chapterSubTitle: 'How to interpret and analyse information received',
            headerClass: 'secondary--text'
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
    viewMode () {
      this.course.md8 = !this.course.md8
      this.orderMd3 = !this.orderMd3
    }
  }
}
</script>
