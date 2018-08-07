<template v-cloak>
  <section>
    <v-container fluid grid-list-lg>
      <!-- course completed -->
      <course-completed v-if="course.completed"></course-completed>
      <!-- course completed -->

      <v-layout row wrap>
        <v-flex
          :md8="course.md8"
          xs12
          order-md1 order-xs1
          >
          <v-card
            transition="scale-transition"
            >
            <!-- enrolled -->
            <template v-if="course.enrolled">
              <template v-if="course.locked">
                <course-locked></course-locked>
              </template>

              <template v-else>
                <template v-if="course.isForm">
                  <course-form></course-form>
                </template>
                <template v-else>
                  <template v-if="course.hasInteractive">
                    <course-with-interactive></course-with-interactive>
                    <!-- card-actions -->
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
                    <!-- card-actions -->
                  </template>
                  <template v-else>
                    <course-without-interactive></course-without-interactive>
                  </template>
                </template>
              </template>
            </template>
            <!-- enrolled -->

            <!-- not enrolled -->
            <template v-else>
              <course-not-enrolled></course-not-enrolled>
            </template>
            <!-- not enrolled -->
          </v-card>

        </v-flex>

        <!-- course playlist -->
        <v-flex
          :md4="course.md4"
          xs12
          class="text-xs-right"
          :order-md3="orderMd3" order-xs2
          >
          <course-playlist></course-playlist>
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
                <v-card flat class="pa-5">
                  <v-card-text class="text-xs-center">
                    <assignment-icon width="120" height="120"></assignment-icon>
                  </v-card-text>
                  <v-card-text class="text-xs-center">
                    {{ trans('No assignments for this course.') }}
                  </v-card-text>
                </v-card>
              </v-tab-item>
            </v-tabs>
          </v-card>

          <!-- comment system -->
          <!-- ckeditor@inline -->
          <v-card height="100" style="cursor: text;">
            <v-card-text>
              <p class="grey--text">
                {{ trans('Post a Comment...') }}
                <span><em>{{ trans('Sample comment card') }}</em></span>
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
                <h3>{{ trans('There\'s nothing here') }}</h3>
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

<script>
import store from '@/store'
import CourseCompleted from './partials/CourseCompleted.vue'
import CourseLocked from './partials/CourseLocked.vue'
import CourseForm from './partials/CourseForm.vue'
import CourseWithoutInteractive from './partials/CourseWithoutInteractive.vue'
import CourseWithInteractive from './partials/CourseWithInteractive.vue'
import CourseNotEnrolled from './partials/CourseNotEnrolled.vue'
import CoursePlaylist from './partials/CoursePlaylist.vue'

export default {
  store,

  components: {
    CourseCompleted,
    CourseLocked,
    CourseForm,
    CourseWithoutInteractive,
    CourseWithInteractive,
    CourseNotEnrolled,
    CoursePlaylist,
  },

  data () {
    return {
      course: {
        enrolled: true,
        locked: false,
        hasInteractive: true,
        isForm: false,
        snackbar: true,
        snackbarTimeout: 0,
        md8: true,
        md4: true,
        orderMd3: false,
        title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea corporis sapiente, blanditiis voluptas, commodi aliquid officia magni temporibus nulla iusto, unde corrupti deserunt ipsum error labore praesentium voluptatem ipsam saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dignissimos alias odio architecto atque minus earum, iste aliquam laboriosam, reprehenderit sint in quas voluptas, consequatur. Neque libero doloribus esse qui.',
        created: '3 weeks ago',
        author: 'Lemony Snicket',
      },
    }
  },

  methods: {
    viewMode () {
      this.course.md8 = !this.course.md8
      this.orderMd3 = !this.orderMd3
    }
  }
}
</script>
