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
      slot="item"
      slot-scope="props"
      xs12
      sm6
      md4
      :lg3="dataset.lg3"
      >
      <v-card
        :height="dataset.cardHeight"
        :hover="dataset.hover"
        :class="dataset.cardClass"
        >
        <v-card-media
          :src="props.item.thumbnail"
          :height="dataset.cardMediaHeight"
          :class="dataset.cardMediaClass"
          >
        </v-card-media>

        <!-- media-title -->
        <v-toolbar
          v-if="dataset.showToolbar"
          :class="dataset.toolbarClass"
          :flat="dataset.toolbarFlat"
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
          v-if="dataset.showCardText"
          :class="cardTextClass"
          >
          <p
            class="body-2 mb-2 primary--text">
            <strong v-html="props.item.category"></strong>
          </p>
          <h3
            class="title mb-3"
            v-html="props.item.title">
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
          <span v-if="dataset.showPart" class="body-1">
            <v-icon class="grey--text">list</v-icon>
            <span v-html="props.item.part"></span>
            <span>Parts</span>
          </span>
          <!-- part -->

          <!-- mimetype -->
          <span v-if="dataset.showMimetype" class="body-1">
            <v-icon class="grey--text" v-html="props.item.icon"></v-icon>
            <span v-html="props.item.mimetype"></span>
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
