<template>
  <section>
    <v-card flat color="transparent" class="folder-card">
      <v-card-text class="text-xs-center folder-card__content pa-1">

        <template v-if="metadata.foldertype === 'image'">
          <photo-icon class="folder-card__mimetype" width="31px" height="31px"></photo-icon>
        </template>
        <template v-if="metadata.foldertype === 'audio'">
          <audio-icon :icon-color="$vuetify.theme.primary" class="folder-card__mimetype" width="31px" height="31px"></audio-icon>
        </template>

        <slot>
          <folder-icon :width="size" :height="size" :icon-color="metadata.color"></folder-icon>
          <v-tooltip bottom v-if="!renaming">
            <div slot="activator" class="folder-card__title mt-1" @dblclick="rename" v-html="trans(metadata.title)"></div>
            {{ trans(metadata.title) }}
          </v-tooltip>
        </slot>
        <!-- editmode -->
        <v-text-field v-if="renaming" v-focus required @focus="$event.target.select()" @blur="renamed" @keyup.enter="renamed" hide-details class="ma-0 folder-card__title--renaming" v-model="metadata.title"></v-text-field>
        <!-- editmode -->
      </v-card-text>
    </v-card>
  </section>
</template>

<script>
import store from '@/store'
import FolderIcon from '@/components/Icons/FolderIcon'
import PhotoIcon from '@/components/Icons/PhotoIcon'
import AudioIcon from '@/components/Icons/AudioIcon'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Folder',

  model: {
    prop: 'metadata'
  },

  components: {
    AudioIcon,
    FolderIcon,
    PhotoIcon
  },

  props: {
    metadata: {
      type: [Object],
      default: () => { return {} }
    },
    size: {
      type: [String],
      default: '5em'
    }
  },

  computed: {
    ...mapGetters({
      folder: 'folder/folder'
    })
  },

  data () {
    return {
      renaming: false
    }
  },

  mounted () {
    this.id = this.folder.id
  },

  methods: {
    open () {
      alert('open folder')
    },

    rename () {
      this.renaming = true
      this.metadata.renaming = true
      this.$store.dispatch('folder/rename', this.metadata)
    },

    renamed () {
      // Check if name is valid
      this.renaming = false
      this.$emit('input', this.metadata)
    },

    move () {
      alert('move')
    },

    trash () {},
    download () {},
    changetype () {}
  },

  watch: {
    'folder.folders': function (val) {
      this.metadata = val[this.id]
      console.log(this.metadata)
    },

    'folder.data.renaming': function (val) {
      this.renaming = val
    }
  }
}
</script>

<style lang="stylus">
.folder-card {
  width: 7.5em;
  text-align: center;
  border: 1px solid transparent;
  background-color: transparent;

  &__title {
    display: block;
    touch-callout: none;
    user-select: none;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    border: 1px dashed transparent;
    border-radius: 3px;
    &:hover {
      background-color: rgba(0,0,0,0.02);
      border-bottom: 1px dashed rgba(0,0,0,0.1);
    }
    &--renaming, &--renaming input {
      text-align: center;
    }
  }

  &__mimetype {
    position: absolute;
    width: 31px;
    left: 28px;
    top: 3em;
  }

  &:not(:first-child) {
    margin-left: 1em;
  }

  &:hover, &:active, &:focus {
    background-color: rgba(0,0,0,0.02);
    filter: brightness(120%);
    border-color: rgba(0,0,0,0.1)
  }
}
</style>
