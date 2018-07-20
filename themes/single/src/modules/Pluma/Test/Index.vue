<template>
  <section>

    <v-toolbar
      flat
      large
      class="sticky v-toolbar__main"
      >
      <v-menu left>
        <v-btn
          flat
          large
          class="primary--text"
          slot="activator"
          >
          Library <v-icon right>keyboard_arrow_down</v-icon>
        </v-btn>

        <v-list>
          <v-list-tile ripple @click="">
            <v-list-tile-action>
              <v-icon>create_new_folder</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>New Folder</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile ripple @click="">
            <v-list-tile-action>
              <v-icon>cloud_upload</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Upload Files</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-spacer></v-spacer>
      <v-btn icon><v-icon>sort</v-icon></v-btn>
      <v-divider vertical></v-divider>
      <v-btn icon><v-icon>add</v-icon></v-btn>
      <v-btn icon><v-icon>delete</v-icon></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md4 xs12>
          <!-- Dialogbox -->
          <!-- <v-card flat class="mb-3 text-xs-center">
            <v-card-title class="emphasis--medium">Dialogbox</v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn color="secondary" @click="openDialogbox">Open Dialog Test</v-btn>
            </v-card-text>
          </v-card> -->
          <!-- Dialogbox -->

          <!-- IconMenu -->
          <!-- <v-card class="mb-3">
            <v-card-title class="emphasis--medium">IconMenu</v-card-title>
            <v-card-text>
              <icon-menu></icon-menu>
            </v-card-text>
          </v-card> -->
          <!-- IconMenu -->
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-flex xs12>
          <!-- Data Iterator -->
          <data-iterator :items="courses">
          </data-iterator>

          <data-iterator :items="library">
          </data-iterator>
          <!-- Data Iterator -->
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

  data () {
    return {
      iconmenu: {
        multiple: true
      },
      courses: {
        lg3: false,
        showToolbar: false,
        showMimetype: false,
        hover: true,
        items: [
          {
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.',
            part: '6',
            fileSize: '24 KB',
            fileName: 'Ubuntu Wallpaper'
          }
        ]
      },
      library: {
        showCardText: false,
        showPart: false,
        items: [
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
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
      dataiterator: 'dataiterator/dataiterator'
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
            },

            discard: false,
          }
        )
      )
    },

    toggleAll () {
      if (this.selected.length) this.selected = []
      else this.selected = this.desserts.slice()
    },
    changeSort (column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending
      } else {
        this.pagination.sortBy = column
        this.pagination.descending = false
      }
    }
  }
}
</script>
