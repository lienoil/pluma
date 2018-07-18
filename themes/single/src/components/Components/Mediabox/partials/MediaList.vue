<template>
  <v-layout row wrap align-start justify-start>
    <v-card v-for="i in 5" :key="i" flat hover color="transparent" class="folder-card" @dblclick.native="open">
      <v-card-text class="text-xs-center">
        <folder-icon width="5em" height="5em" :icon-color="colors.error"></folder-icon>
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

  data () {
    return {
      colors: this.$vuetify.theme
    }
  },

  methods: {
    select ($event) {
      alert('single click')
      console.log($event.target.$el)
      $event.target.el.classList.add('blue')
    },

    open () {
      alert('doiuble clicj')
    }
  }
}
</script>

<style lang="stylus">
.folder-card {
  width: 7.5em;
  text-align: center;
  &:not(:first-child) {
    margin-left: 1em;
  }

  &:hover {
    background-color: rgba(0,0,0,0.02);
  }
}
</style>
