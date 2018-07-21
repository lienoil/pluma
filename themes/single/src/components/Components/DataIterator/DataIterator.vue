<template>
  <v-data-iterator
    :items="dataset.items"
    :pagination.sync="dataset.pagination"
    :rows-per-page-items="dataset.rowsPerPageItems"
    content-tag="v-layout"
    row
    wrap
    >
    <v-flex
      :lg2="dataset.lg2"
      :lg3="dataset.lg3"
      :md2="dataset.md2"
      :md4="dataset.md4"
      :sm6="dataset.sm6"
      :xs12="dataset.xs12"
      slot-scope="props"
      slot="item"
      >
      <v-card
        :class="dataset.cardClass"
        :height="dataset.cardHeight"
        :hover="dataset.hover"
        :href="dataset.cardLink"
        >
        <v-card-media
          :class="dataset.cardMediaClass"
          :height="dataset.cardMediaHeight"
          :src="props.item.thumbnail"
          >

          <v-layout
            align-end
            class="mx-3"
            fill-height
            justify-end
            v-if="dataset.chip"
            >
            <v-chip
              class="elevation-2"
              color="success"
              dark
              text-color="white"
              >
              Enrolled
            </v-chip>
          </v-layout>
        </v-card-media>

        <!-- media-title -->
        <v-toolbar
          :class="dataset.toolbarClass"
          :flat="dataset.toolbarFlat"
          v-if="dataset.showToolbar"
          >
          <v-toolbar-title>
            <v-tooltip
              bottom
              >
              <span
                :class="dataset.toolbarTitleClass"
                slot="activator"
                v-html="props.item.title"
                >
              </span>
              <span v-html="props.item.title"></span>
            </v-tooltip>

            <div
              :class="dataset.fileSizeClass"
              v-html="props.item.size"
              >
            </div>
          </v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <!-- media-title -->

        <!-- card-text -->
        <v-card-text
          :class="cardTextClass"
          v-if="dataset.showCardText"
          >
          <p
            class="body-2 mb-2 primary--text">
            <strong v-html="props.item.category"></strong>
          </p>
          <h3
            class="title mb-3"
            v-html="props.item.title"
            >
          </h3>
          <p>
            <span
              class="text--ellipsis"
              v-html="props.item.description"
              >
            </span>
          </p>
        </v-card-text>
        <!-- card-text -->

        <v-card-actions
          bottom
          class="grey--text pa-3"
          >
          <span
            class="body-1"
            v-html="props.item.timestamp"
            >
          </span>
          <v-spacer></v-spacer>
          <!-- part -->
          <span
            class="body-1"
            v-if="dataset.showPart"
            >
            <v-icon class="grey--text">list</v-icon>
            <span v-html="props.item.part"></span>
            <span>Parts</span>
          </span>
          <!-- part -->

          <!-- mimetype -->
          <span
            class="body-1"
            v-if="dataset.showMimetype"
            >
            <v-tooltip
              bottom
              >
              <span slot="activator">
                <v-icon
                  class="grey--text"
                  v-html="props.item.icon"
                  >
                </v-icon>
              </span>
              <span v-html="props.item.mimetype"></span>
            </v-tooltip>
          </span>
          <!-- mimetype -->
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-data-iterator>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'DataIterator',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {}
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.dataiterator, this.items)
  },

  computed: {
    ...mapGetters({
      dataiterator: 'dataiterator/dataiterator'
    })
  },
  methods: {
    show () {
      this.$store.dispatch('dataiterator/PROMPT_DIALOG', { model: true })
    },

    hide () {
      this.$store.dispatch('dataiterator/PROMPT_DIALOG', { model: false })
    }
  }
}
</script>
