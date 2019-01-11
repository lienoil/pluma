<template>
  <v-app v-cloak toolbar footer>
    <!-- Main Content -->

    <v-content>
      <!-- Main -->
      <v-slide-y-transition mode="out-in">
        <router-view></router-view>
      </v-slide-y-transition>
      <!-- Main -->
    </v-content>
    <!-- Main Content -->

    <!-- <progressbar></progressbar> -->
  </v-app>
</template>

<script>
import store from '@/store';
import { mapGetters } from 'vuex';

export default {
  store,

  computed: {
    ...mapGetters({
      // app: 'app/app',
    }),
  },
}
</script>
