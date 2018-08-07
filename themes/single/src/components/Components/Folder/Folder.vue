<template>
  <v-card flat hover color="transparent" class="folder-card">
    <slot>
      <v-card-text class="text-xs-center">
        <folder-icon :width="size" :height="size" :icon-color="color"></folder-icon>
        <span v-html="trans(title)"></span>
      </v-card-text>
    </slot>
  </v-card>
</template>

<script>
import folderIcon from '@/components/Icons/FolderIcon'

export default {
  name: 'Folder',

  components: {
    folderIcon
  },

  props: {
    color: {
      type: [String],
      default: '#444'
    },
    size: {
      type: [String],
      default: '5em'
    },
    title: {
      type: [String],
      default: 'New Folder'
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
    filter: brightness(150%);
  }
}
</style>
