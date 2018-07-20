<template>
  <section>
    <v-card flat color="transparent" class="folder-card" @dblclick="open" @contextmenu="togglemenu">
      <v-card-text class="text-xs-center folder-card__content pa-1">

        <template v-if="metadata.foldertype === 'image'">
          <photo-icon class="folder-card__mimetype" width="31px" height="31px"></photo-icon>
        </template>
        <template v-if="metadata.foldertype === 'audio'">
          <audio-icon class="folder-card__mimetype" width="31px" height="31px"></audio-icon>
        </template>
        <template v-if="metadata.foldertype === 'archive'">
          <zipper-icon class="folder-card__mimetype" width="31px" height="31px"></zipper-icon>
        </template>

        <folder-icon :width="size" :height="size" :icon-color="metadata.color"></folder-icon>
        <v-tooltip bottom v-if="!renaming">
          <div slot="activator" class="folder-card__title mt-1" @dblclick="rename" v-html="trans(metadata.title)"></div>
          {{ trans(metadata.title) }}
        </v-tooltip>

        <!-- editmode -->
        <v-text-field v-if="renaming" v-focus required @focus="$event.target.select()" @blur="renamed" @keyup.enter="renamed" hide-details class="ma-0 folder-card__title--renaming" v-model="metadata.title"></v-text-field>
        <!-- editmode -->
      </v-card-text>
    </v-card>

    <v-menu
      :position-x="options.x"
      :position-y="options.y"
      absolute
      lazy
      offset-y
      v-model="options.show"
      >
      <v-list>
        <v-list-tile @click="open">
          <v-list-tile-action>
            <v-icon>mdi-folder-search</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans('Open') }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-divider></v-divider>

        <v-list-tile @click="move">
          <v-list-tile-action>
            <v-icon>mdi-folder-move</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans('Move to...') }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-list-tile @click="rename">
          <v-list-tile-action>
            <v-icon>mdi-rename-box</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans('Rename...') }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-menu offset-x right open-on-hover>
          <v-list-tile slot="activator" @click="">
            <v-list-tile-action>
              <v-icon>mdi-shape</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ trans('Change folder type') }}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action class="justify-end">
              <v-icon>mdi-menu-right</v-icon>
            </v-list-tile-action>
          </v-list-tile>

          <v-list>
            <v-list-tile @click="changetype($event, 'image')">
              <v-list-tile-action>
                <photo-icon width="31px" height="31px"></photo-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Image') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="changetype($event, 'audio')">
              <v-list-tile-action>
                <audio-icon width="25px" height="25px"></audio-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Audio') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="changetype($event, 'archive')">
              <v-list-tile-action>
                <zipper-icon width="25px" height="25px"></zipper-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Archive') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-menu>

        <v-divider></v-divider>

        <v-list-tile @click="download">
          <v-list-tile-action>
            <v-icon>mdi-download</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans('Download') }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-divider></v-divider>

        <v-list-tile @click="trash">
          <v-list-tile-action>
            <v-icon>mdi-delete</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans('Remove') }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
  </section>
</template>

<script>
import store from './store'
import { mapGetters } from 'vuex'

export default {
  // Local store
  store,

  name: 'Folder',

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
      contextmenu: 'contextmenu/contextmenu',
      folder: 'folder/folder',
    })
  },

  data () {
    return {
      file: {},
      options: {
        x: 0,
        y: 0,
        show: false,
      },
      renaming: false
    }
  },

  methods: {
    open () {
      this.$emit('open', this.metadata)
      alert('opened')
    },

    togglemenu (e) {
      this.$store.dispatch('contextmenu/close')

      if (this.options.show) {
        this.options.show = false
      } else {
        this.options.show = true
      }

      this.options.x = e.clientX
      this.options.y = e.clientY
      this.$nextTick(() => {
        this.$store.dispatch('contextmenu/open', this.options)
      })
    },

    rename (c) {
      this.renaming = true
      this.$emit('renaming')
    },

    renamed () {
      // TODO: Check if name is valid
      this.renaming = false
      this.$emit('renamed', this.metadata)
    },

    move () {
      alert('move')
    },

    trash () {},

    download () {},

    changetype (e, type) {
      this.metadata.foldertype = type

      this.$nextTick(() => {
        this.togglemenu(e)
        // this.$store.dispatch('contextmenu/close')
      })
    },
  },
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
