<template>
  <div>
    <v-toolbar
      flat
      light
      >
      <v-icon v-if="page.icon">{{ page.icon }}</v-icon>
      <v-toolbar-title>{{ trans(page.title) }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- v-if="!empty"  -->
      <v-btn color="primary" :to="{name: 'courses.create'}">{{ trans('New Course') }}</v-btn>

    </v-toolbar>
  </div>
</template>

<script>
import page from './config/sidebar';

export default {
  name: 'CourseIndex',

  computed: {
    page: function () {
      return this.$route.meta;
    },
  },
}
</script>
