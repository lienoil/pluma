<template>
  <v-app v-cloak toolbar footer>

    <!-- Main Content -->
    <v-content>
      <!-- Main -->
      <v-slide-y-transition>
        <keep-alive>
          <router-view></router-view>
        </keep-alive>
      </v-slide-y-transition>
      <!-- Main -->
    </v-content>
    <!-- Main Content -->

    <!-- <progressbar></progressbar> -->
  </v-app>
</template>

<script></script>
