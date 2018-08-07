<template>
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
</template>

<script>
export default {
  name: 'CourseCompleted',

  data () {
    return {
      course: {
        snackbarTimeout: 0,
        snackbar: true,
      }
    }
  }
}
</script>

