<template v-cloak>
  <section>
    <toolbar-menu :items="toolbar"></toolbar-menu>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md9 xs12>
          <v-card flat class="mb-3 text-xs-center">
            <v-card-title
              class="emphasis--medium"
              >
              Dialogbox
            </v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn
                color="secondary"
                @click="openDialogbox"
                >
                Open Dialog Test
              </v-btn>
            </v-card-text>
          </v-card>

          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              Icon Menu
            </v-card-title>
            <v-card-text>
              <icon-menu :items="iconmenu"></icon-menu>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex md3 xs12>
          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              Tag Card
            </v-card-title>
            <v-card-text>
              <tag :items="tag"></tag>
            </v-card-text>
          </v-card>

          <v-card class="mb-3 emphasis--medium">
            <v-card-title>
              Category Card
            </v-card-title>
            <category :items="category"></category>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<style>
  .v-input__slot {
    margin-bottom: 0;
  }
</style>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  components: {},

  data () {
    return {
      toolbar: {
        title: 'All Courses'
      },

      iconmenu: {
        model: '',
        label: 'Choose Icon Menu'
      },

      category: {
        hasSaved: false,
        isEditing: true,
        categoryList: false,
        categoryCreate: true,
        label: 'Choose Category',
        items: [
          { name: 'Video', icon: 'videocam' },
          { name: 'Image', icon: 'photo' },
        ],
        chipColor: 'secondary',
        iconColor: 'white--text',
      },

      tag: {
        model: [],
        clearable: false,
        items: [
          'Programming',
          'Reading',
          'Eating'
        ],
      },

      library: {
        cardMediaHeight: '120px',
        pagination: {
          rowsPerPage: 6
        },
        showToolbar: true,
        cardActions: false,
        lg2: true,
        lg3: false,
        md2: true,
        md4: false,
        showCardText: false,
        showPart: false,
        xs12: false,
        items: [
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: 'https://cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/2.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/3.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/4.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/5.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          }
        ]
      },
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      toolbar: 'toolbar/toolbar',
    })
  },

  methods: {
    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            // icon: 'add',
            // iconColor: 'success--text',
            image: '//img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
            title: 'Delete Resources',
            text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
            persistent: true,
            width: '100%',
            alignedCenter: true,

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
              alert('test')
            },

            discard: false,
          }
        )
      )
    },

    save () {
      this.category.isEditing = !this.category.isEditing
      this.category.hasSaved = true
    }
  }
}
</script>
