<template>
  <drag @drag="dragging(metadata)" :transfer-data="metadata" :draggable="isFolder">
    <drop @drop="dropped">
      <section>
        <v-card
          :class="{'file-card--active': this.metadata.selected}"
          @focus="select"
          @click.native="select"
          @contextmenu="togglemenu"
          @keyup.113="rename"
          class="file-card"
          flat
          tabindex="0"
          >
          <v-card-text class="text-xs-center file-card__content pa-1">

            <template v-if="isFolder">
              <component
                height="32px"
                class="file-card__mimetype"
                :is="`${metadata.foldertype.value}Icon`"
                width="32px"
              ></component>
            </template>

            <v-card slot="activator" flat color="transparent" @dblclick="open">
              <folder-icon
                v-if="metadata.type === 'folder'"
                :height="size"
                :icon-color="metadata.color"
                :width="size"
              ></folder-icon>
              <v-tooltip bottom v-else-if="metadata.thumbnail">
                <v-card-media
                  :src="metadata.thumbnail"
                  class="file-card__thumbnail"
                  height="8em"
                  slot="activator"
                  >
                </v-card-media>
                <span>{{ trans(metadata.filesize) }}</span>
              </v-tooltip>
              <component
                v-else
                :height="size"
                :icon-color="metadata.color"
                is="TxtIcon"
                :width="size"
              ></component>
            </v-card>

            <v-tooltip bottom v-if="!renaming">
              <div slot="activator" class="file-card__title mt-1" @dblclick="rename" v-html="trans(metadata.name)"></div>
              {{ trans(metadata.name) }}
            </v-tooltip>

            <!-- editmode -->
            <v-text-field v-if="renaming" @keyup.esc="renamed" v-focus required @focus="$event.target.select()" @blur="renamed" @keyup.enter="renamed" required class="ma-0 file-card__title--renaming" v-model="metadata.name"></v-text-field>
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
                <v-list-tile-title v-else>{{ trans('Select') }}</v-list-tile-title>
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
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: 'Image', value: 'image'})">
                  <v-list-tile-action>
                    <image-icon width="32px" height="32px"></image-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Image') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: 'Audio', value: 'audio'})">
                  <v-list-tile-action>
                    <audio-icon width="25px" height="25px"></audio-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Audio') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: 'Archive', value: 'archive'})">
                  <v-list-tile-action>
                    <archive-icon width="25px" height="25px"></archive-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Archive') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: 'Video', value: 'video'})">
                  <v-list-tile-action>
                    <video-icon width="25px" height="25px"></video-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Video') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: 'Book', value: 'book'})">
                  <v-list-tile-action>
                    <book-icon width="25px" height="25px"></book-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Book') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile ripple tabindex="0" @click="changetype($event, {text: '', value: ''})">
                  <v-list-tile-action>
                    <v-icon>mdi-close</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans('Remove folder type') }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-menu>

            <template v-if="!isFolder">
              <v-divider></v-divider>
              <v-list-tile ripple tabindex="0" target="_blank" :href="metadata.url">
                <v-list-tile-action>
                  <v-icon>mdi-download</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>{{ trans('Download') }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </template>

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
      selected: false,
      clickcount: 0,
    }
  },

  mounted () {
    //
  },

  methods: {
    select (e) {
      this.clickcount++
      this.metadata.selected = true
      this.selected = true
      this.$store.dispatch('folder/select', this.metadata)
      this.$emit('selected', {item: this.metadata})
    },

    unselect (e) {
      this.clickcount = 0
      this.metadata.selected = false
      this.selected = false
      // this.$store.dispatch('folder/unselect')
      this.$emit('unselected')
    },

    open () {
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
      this.metadata.oldname = this.metadata.name
      this.$emit('renaming')
    },

    renamed () {
      if (!this.metadata.name.length) {
        this.metadata.name = this.metadata.oldname
        return false
      }

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
      this.$emit('dragging', {file: this.metadata, transferData, nativeElement})
    },

    dropped (transferData, nativeElement) {
      this.$emit('dropped', {file: this.metadata, transferData, nativeElement})
    }
  },
}
</script>

<style lang="stylus">
@import '../../../assets/stylus/theme';

.file-card, .v-card.file-card {
  text-align: center;
  border: 1px solid transparent;
  background-color: transparent;
  margin: 0.25em;
  width: 8em;

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
    width: 32px;
    left: 28px;
    top: 3em;
    z-index: 3;
  }

  &:hover, &:active, &:focus {
    background-color: rgba(0,0,0,0.05);
    filter: brightness(110%);
    border-color: rgba(0,0,0,0.1)
  }

  &--active {
    background-color: rgba(0,0,0,0.05);
  }

  &__thumbnail {
    height: 8em;
    width: auto;
  }
}
</style>
