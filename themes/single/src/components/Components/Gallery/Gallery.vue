<template>
  <lightbox
    :id="dataset.id"
    :images="dataset.items"
    :image_class="dataset.imageClass"
    :options="dataset.options">
  </lightbox>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Gallery',

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

  },

  mounted () {
    this.dataset = Object.assign({}, this.gallery, this.items)
  },

  computed: {
    ...mapGetters({
      gallery: 'gallery/gallery'
    })
  }
}
</script>
