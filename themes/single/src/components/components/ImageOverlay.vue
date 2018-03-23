<template>
  <div v-if="visibility" class="image-overlay-container" :style="`background-image: ${src}`">

  </div>
</template>

<script>
export default {
  name: 'ImageOverlay',
  model: {
    prop: 'visibility'
  },
  props: {
    visibility: { type: Boolean, default: true },
    src: { type: String, default: 'none' }
  }
}
</script>

<style lang="stylus">
.image-overlay-container {
  position: fixed;
  width: 100%;
  // height: 100%;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-size: cover;
  background-position: center;
  box-sizing: content-box;
}
</style>
