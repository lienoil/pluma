<template>
  <section>
    <v-container fluid grid-list-lg>

      <v-card flat class="transparent" color="secondary--text">
        <v-card-title>
          {{ trans('Widgets') }}
        </v-card-title>
      </v-card>

      <v-layout row wrap>
        <v-flex md4 xs12>
          <current-course-progress class="mb-3"></current-course-progress>

          <to-do class="mb-3"></to-do>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<style lang="stylus" scoped>
  .v-progress-circular
    margin: 1rem
</style>

<script>
import CurrentCourseProgress from './widgets/CurrentCourseProgress.vue'
import ToDo from './widgets/ToDo.vue'

export default {
  components: {
    CurrentCourseProgress,
    ToDo,
  },
}
</script>
