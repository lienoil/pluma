<template>
  <v-card
    class="mb-3"
    transition="scale-transition"
    >
    <v-card-media
      :src="course.thumbnail"
      style="background: linear-gradient(135deg, #003073, #029797);"
      height="500"
      >
      <div class="card--overlay"></div>
      <v-layout align-center justify-center row fill-height>
        <v-card flat dark class="transparent">
          <v-card-text class="text-xs-center">
            <h2>{{ trans('You are not enrolled in this course.') }}</h2>
            <p>{{ trans('Enroll now to get access on this course.') }}</p>
            <v-btn large color="secondary">{{ trans('Enroll Now') }}</v-btn>
          </v-card-text>
        </v-card>
      </v-layout>
    </v-card-media>
  </v-card>
</template>

<script>
export default {
  name: 'CourseNotEnrolled',

  data () {
    return {
      course: {
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png'
      }
    }
  }
}
</script>
