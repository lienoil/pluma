<template>
  <div class="play--container">
    <object
      :data-type="type"
      :data="src"
      class="interactive-media-object"
      height="auto"
      onbeforeunload="window.API.LMSFinish('')"
      onunload="window.API.LMSFinish('')"
      width="100%"
    >
      <param name="src" :value="src">
      <param name="autoplay" value="false">
      <param name="autoStart" value="0">
      <embed :type="type" :src="src">
    </object>
  </div>
</template>

<script>
export default {
  name: 'ScormPlayer',
  props: {
    type: { type: String, default: '' },
    version: { type: String, default: '1.2' },
    debug: { type: Boolean, default: false },
    src: { type: String, default: '' }
  },
  data () {
    return {
      g: ''
    }
  },
  methods: {
    scormapi: () => {
      return {
        init: () => {
          window.API.init(this.version, {
            debug: this.debug
          })
        },
        listen: () => {
          window.API.on('LMSInitialize', (string, cache, options) => {
            this.$http.get(options.URL.INIT, (response) => {
              console.log(response)
            })
          })
        }
      }
    }
  },
  mounted () {
    this.scormapi().init()
    this.scormapi().listen()
  }
}
</script>

<style lang="stylus">
.play--container {
  .interactive-media-object {
    width: 100%;
    height: 800px;
  }
}
</style>
