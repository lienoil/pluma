<template v-cloak>
  <section>
    <v-container fluid grid-list-lg>
      <!-- course completed -->
      <course-completed></course-completed>
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

          <template v-if="course.md8">
            <course-resources class="mt-3"></course-resources>
          </template>
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

        <template v-if="!course.md8">
          <v-flex md8 xs12 order-md2 order-xs3>
            <course-resources></course-resources>
          </v-flex>
        </template>
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
import CourseResources from './partials/CourseResources.vue'

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
    CourseResources,
  },

  data () {
    return {
      course: {
        enrolled: true,
        locked: false,
        hasInteractive: true,
        isForm: false,
        md8: true,
        md4: true,
        orderMd3: false,
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
