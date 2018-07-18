<template>
  <v-layout row wrap justify-center align-start justify-space-between>
    <v-card flat hover class="folder-card" @click.native="select">
      <v-card-text>
        <folder-icon width="6em" height="6em" :icon-color="$vuetify.theme.primary"></folder-icon>
        <span>Work Related</span>
      </v-card-text>
    </v-card>
  </v-layout>
</template>

<script>
import folderIcon from '@/components/Icons/FolderIcon'

export default {
  name: 'MediaList',
  components: {
    folderIcon
  },

  methods: {
    select ($event) {
      console.log($event.target.$el)
      $event.target.el.classList.add('blue')
    }
  }
}
</script>

<style lang="stylus">
.folder-card {
  width: 7.5em;
  text-align: center;

  &:hover {
    background-color: rgba(0,0,0,0.02);
  }
}
</style>
