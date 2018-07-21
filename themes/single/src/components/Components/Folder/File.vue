<template>
  <drag @drag="dragging(metadata)" :transfer-data="metadata" :draggable="isFolder">
    <drop @drop="dropped">
      <section>
        <v-card
          :class="{'file-card--active': this.metadata.selected}"
          @click.native="select"
          @contextmenu="togglemenu"
          @keyup.113="rename"
          @keyup.delete="remove"
          tabindex="0"
          class="file-card"
          flat
          >
          <v-card-text class="text-xs-center file-card__content pa-1">

            <template v-if="metadata.type === 'folder'">
              <component
                height="31px"
                class="file-card__mimetype"
                :is="`${metadata.foldertype}Icon`"
                width="31px"
              ></component>
            </template>

            <v-card flat color="transparent" @dblclick="open">
              <folder-icon
                v-if="metadata.type === 'folder'"
                :height="size"
                :icon-color="metadata.color"
                :width="size"
              ></folder-icon>
              <component
                v-else
                :height="size"
                :icon-color="metadata.color"
                :is="`${metadata.filetype}Icon`"
                :width="size"
              ></component>
            </v-card>

            <v-tooltip bottom v-if="!metadata.renaming">
              <div slot="activator" class="file-card__title mt-1" @dblclick="rename" v-html="trans(metadata.title)"></div>
              {{ trans(metadata.title) }}
            </v-tooltip>

            <!-- editmode -->
            <v-text-field v-if="metadata.renaming" @keyup.esc="renamed" v-focus required @focus="$event.target.select()" @blur="renamed" @keyup.enter="renamed" hide-details class="ma-0 file-card__title--renaming" v-model="metadata.title"></v-text-field>
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
            <v-list-tile ripple v-focus tabindex="0" @click="open">
              <v-list-tile-action>
                <v-icon v-if="isFolder">mdi-folder-search</v-icon>
                <v-icon v-else>mdi-file-find</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title v-if="isFolder">{{ trans('Open') }}</v-list-tile-title>
                <v-list-tile-title v-else>{{ trans('Preview') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-divider></v-divider>

            <v-list-tile ripple tabindex="0" @click="move">
              <v-list-tile-action>
                <v-icon>mdi-folder-move</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Move to...') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile ripple tabindex="0" @click="rename">
              <v-list-tile-action>
                <v-icon>mdi-rename-box</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Rename...') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-menu offset-x right open-on-hover v-if="isFolder">
              <v-list-tile ripple slot="activator" @click="">
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
                <v-list-tile ripple tabindex="0" @click="changetype($event, 'image')">
                  <v-list-tile-action>
                    <image-icon width="31px" height="31px"></image-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Image') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, 'audio')">
                  <v-list-tile-action>
                    <audio-icon width="25px" height="25px"></audio-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Audio') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, 'archive')">
                  <v-list-tile-action>
                    <archive-icon width="25px" height="25px"></archive-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Archive') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, 'video')">
                  <v-list-tile-action>
                    <video-icon width="25px" height="25px"></video-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Video') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, 'book')">
                  <v-list-tile-action>
                    <book-icon width="25px" height="25px"></book-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Book') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile ripple tabindex="0" @click="changetype($event, '')">
                  <v-list-tile-action>
                    <v-icon>mdi-close</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Remove folder type') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-menu>

            <v-divider></v-divider>

            <v-list-tile ripple tabindex="0" @click="download">
              <v-list-tile-action>
                <v-icon>mdi-download</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('Download') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-divider></v-divider>

            <v-list-tile ripple tabindex="0" @click="remove">
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
    </drop>
  </drag>
</template>

<script>
import store from './store'
import { Drag, Drop } from 'vue-drag-drop'
import { mapGetters } from 'vuex'

export default {
  // Local store
  store,

  name: 'File',

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

  components: {
    Drop,
    Drag,
  },

  computed: {
    ...mapGetters({
      contextmenu: 'contextmenu/contextmenu',
      folder: 'folder/folder',
    }),

    isFolder () {
      return this.metadata.type === 'folder'
    },
  },

  data () {
    return {
      file: {},
      options: {
        x: 0,
        y: 0,
        show: false,
      },
      renaming: false,
      clickcount: 0,
    }
  },

  methods: {
    select (e) {
      this.clickcount++

      this.metadata.selected = true

      this.$emit('selected', this.metadata)
      this.$store.dispatch('folder/select', this.metadata)
    },

    open () {
      if (this.metadata.type === 'folder') {

      }

      this.$emit('open', this.metadata)
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
      this.metadata.renaming = true
      this.$emit('renaming')
    },

    renamed () {
      // TODO: Check if name is valid
      this.renaming = false
      this.metadata.renaming = false
      this.$emit('renamed', this.metadata)
    },

    move () {
      alert('move')
    },

    remove () {
      this.$emit('remove')
    },

    download () {},

    changetype (e, type) {
      this.metadata.foldertype = type
      this.$nextTick(() => {
        this.togglemenu(e)
        // this.$store.dispatch('contextmenu/close')
      })
    },

    // Drag and Drop
    dragging (data, transferData, nativeElement) {
      console.log('dragging', transferData, nativeElement)
      this.$emit('dragging', {file: this.metadata, transferData, nativeElement})
    },

    dropped (transferData, nativeElement) {
      console.log('dropped', transferData, nativeElement)
      this.$emit('dropped', {file: this.metadata, transferData, nativeElement})
    }
  },
}
</script>

<style lang="stylus">
.file-card {
  width: 7.5em;
  text-align: center;
  border: 1px solid transparent;
  background-color: transparent;
  margin: 0.25em;

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
    z-index: 3;
  }

  &:hover, &:active, &:focus {
    background-color: rgba(0,0,0,0.02);
    filter: brightness(110%);
    border-color: rgba(0,0,0,0.1)
  }

  &--active {
    background-color: rgba(255,0,0,0.2);
  }
}
</style>
