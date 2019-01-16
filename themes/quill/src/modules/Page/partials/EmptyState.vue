<template>
  <v-container fluid align-center justify-center>
    <v-layout row wrap align-center justify-center>
      <v-card flat color="transparent" class="text-xs-center text--disabled">
        <man-on-laptop class="icon--disabled" width="25em" height="25em"></man-on-laptop>
        <h1 class="headline mb-2"><strong>{{ trans('Time to tell great stories!') }}</strong></h1>
        <p class="subheading mb-4">{{ trans("Start by choosing what page to write. We recommend starting with a home page.") }}</p>
        <v-btn
          large
          dark
          depressed
          color="secondary"
          round
          exact
          :to="{name: 'pages.create'}">
          {{ trans('Create New Page') }}
        </v-btn>
      </v-card>
    </v-layout>
  </v-container>
</template>

<script>
import ManOnLaptop from '@/components/Icons/ManOnLaptop'

export default {
  name: 'EmptyState',

  components: {
    ManOnLaptop,
  },
}
</script>

<style>
.icon--disabled {
  filter: grayscale(0.8);
}
</style>
