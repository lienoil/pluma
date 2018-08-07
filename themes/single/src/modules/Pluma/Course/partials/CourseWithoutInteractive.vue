<template>
  <v-card
    transition="scale-transition"
    style="background: linear-gradient(135deg, #003073, #029797);"
    height="500"
    >
    <v-layout align-center justify-center row fill-height>
      <v-card flat class="transparent">
        <v-card-text class="text-xs-center">
          <div class="mb-3">
            <media-icon width="180" height="180"></media-icon>
          </div>
          <div>
            {{ trans('No interactive content for this lesson.') }}
          </div>
        </v-card-text>
      </v-card>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: 'CourseWithoutInteractive',

  data () {
    return {
      course: {
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png'
      }
    }
  }
}
</script>
