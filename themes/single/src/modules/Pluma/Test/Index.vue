<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md4 xs12>
          <!-- Dialogbox -->
          <v-card flat class="mb-3 text-xs-center">
            <v-card-title class="emphasis--medium"><strong>Dialogbox</strong></v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn color="secondary" @click="openDialogbox">Open Dialog Test</v-btn>
            </v-card-text>
          </v-card>
          <!-- Dialogbox -->

          <!-- IconMenu -->
          <v-card class="mb-3">
            <v-card-title class="emphasis--medium"><strong>IconMenu</strong></v-card-title>
            <v-card-text>
              <icon-menu></icon-menu>
            </v-card-text>
          </v-card>
          <!-- IconMenu -->
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-flex xs12>
          <!-- Section Loop -->
          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              <strong>Section Loop</strong>
            </v-card-title>
            <v-card-text>
              <v-toolbar flat>
                <v-toolbar-title>Chapter 1</v-toolbar-title>
              </v-toolbar>
              <v-list>
                <v-list-tile>
                  <v-list-tile-content>
                    <v-list-tile-title>test</v-list-tile-title>
                    <v-list-tile-sub-title>test</v-list-tile-sub-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-card-text>
          </v-card>
          <!-- Section Loop -->

          <!-- Data Iterator -->
          <v-card class="mb-3">
            <v-card-title><strong>Library</strong></v-card-title>
              <v-card-text>
                <v-data-iterator
                  :items="dataiterator.items"
                  :rows-per-page-items="dataiterator.rowsPerPageItems"
                  :pagination.sync="dataiterator.pagination"
                  content-tag="v-layout"
                  row
                  wrap
                >
                  <v-flex
                    slot="item"
                    slot-scope="props"
                    xs12
                    sm6
                    md4
                    lg3
                  >
                    <v-card height="100%">
                      <v-card-media :src="props.item.thumbnail" height="160px"></v-card-media>
                      <v-card-text>
                        <p class="body-2 mb-2 primary--text"><strong v-html="props.item.category"></strong></p>
                        <h3 class="title mb-3" v-html="props.item.title"></h3>
                        <p><span class="text--ellipsis" v-html="props.item.description"></span></p>
                      </v-card-text>
                      <v-card-actions bottom class="grey--text pa-3">
                        <span class="body-1" v-html="props.item.timestamp"></span>
                        <v-spacer></v-spacer>
                        <span class="body-1">
                          <v-icon class="grey--text">list</v-icon> <span v-html="props.item.part"></span> Parts
                        </span>
                      </v-card-actions>
                    </v-card>
                  </v-flex>
                </v-data-iterator>
              </v-card-text>
            </v-card-title>
          </v-card>
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

  .text--ellipsis {
    display: -webkit-box;
    max-width: 100%;
    line-height: 1.4;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>

<script>
// import Dialogbox from '@/components/Components/Dialog/Dialogbox.vue'
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  data () {
    return {
      iconmenu: {
        multiple: true
      },
      dataiterator: {
        rowsPerPageItems: [4, 8, 12],
        pagination: {
          rowsPerPage: 4
        },
        items: [
          {
            value: false,
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals, managing time effectively, maintaining work-life balance, and managing stress, as well as personal finances so as to optimise effectiveness at work.',
            part: '6'
          },
          {
            value: false,
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals, managing time effectively, maintaining work-life balance, and managing stress, as well as personal finances so as to optimise effectiveness at work.',
            part: '6'
          },
          {
            value: false,
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals, managing time effectively, maintaining work-life balance, and managing stress, as well as personal finances so as to optimise effectiveness at work.',
            part: '6'
          },
          {
            value: false,
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/6.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals, managing time effectively, maintaining work-life balance, and managing stress, as well as personal finances so as to optimise effectiveness at work.',
            part: '6'
          }
        ]
      }
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu'
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

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false,
            alignedCenter: false
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
