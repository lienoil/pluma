<template>
  <v-card-media
    :src="course.thumbnail"
    style="background: linear-gradient(135deg, #003073, #029797);"
    height="500"
    >
    <div class="card--overlay"></div>
    <v-layout align-center justify-center row fill-height>
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
</template>

<script>
export default {
  name: 'CourseWithInteractive',

  data () {
    return {
      course: {
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png'
      }
    }
  }
}
</script>
