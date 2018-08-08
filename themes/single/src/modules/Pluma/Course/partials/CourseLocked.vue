<template>
  <v-card-media
    :src="course.thumbnail"
    style="background: linear-gradient(135deg, #003073, #029797);"
    height="500"
    >
    <div class="card--overlay"></div>
    <v-layout align-center justify-center row fill-height>
      <v-card flat dark class="transparent">
        <v-card-text class="text-xs-center">
          <h2>{{ trans('This part is still locked.') }}</h2>
          <p>{{ trans('Please finish the previous interaction.') }}</p>
          <v-btn large color="secondary">{{ trans('Go to Current Course') }}</v-btn>
        </v-card-text>
      </v-card>
    </v-layout>
  </v-card-media>
</template>

<script>
export default {
  name: 'CourseLocked',

  data () {
    return {
      course: {
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png'
      }
    }
  }
}
</script>
