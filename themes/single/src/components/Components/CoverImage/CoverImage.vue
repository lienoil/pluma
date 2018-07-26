
<template>
  <v-card
    :class="dataset.cardClass"
    v-model="dataset.model"
    :height="dataset.cardHeight"
    :color="dataset.cardColor"
    :hover="dataset.cardHover"
    :href="dataset.cardLink"
    >
    <v-card-media
      :src="dataset.thumbnail"
      :height="dataset.cardMediaHeight"
      :class="dataset.cardMediaClass"
      >
    </v-card-media>
  </v-card>
</template>


<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'CoverImage',

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

  methods: {
    remove (item) {
      this.dataset.model.splice(this.dataset.model.indexOf(item), 1)
      this.dataset.model = [...this.dataset.model]
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.coverimage, this.items)
  },

  computed: {
    ...mapGetters({
      coverimage: 'coverimage/coverimage'
    })
  }
}
</script>
