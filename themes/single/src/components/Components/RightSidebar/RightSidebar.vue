<template>
  <v-navigation-drawer
    :dark="$root.theme.dark"
    fixed
    hide-overlay
    right
    temporary
    v-model="$root.rightsidebar.model"
    >
  </v-navigation-drawer>
</template>

<script>
export default {
  name: 'RightSidebar'
}
</script>
