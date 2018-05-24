<template>
  <v-card flat>
    <div v-if="label" class="mb-2"><label class="body-1 grey--text text--darken-2" v-html="label"></label></div>
    <textarea ref="wysiwyg-editor" :name="name" v-model="body"></textarea>
  </v-card>
</template>

<script>
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  name: 'Editor',
  model: {
    prop: 'body'
  },
  props: {
    name: { default: 'body' },
    label: { type: String, default: '' },
    body: null,
    height: { type: String, default: '200px' }
  },
  data () {
    return {
      editor: {
        instance: null,
        model: true,
        body: '',
        delta: ''
      }
    }
  },
  methods: {
    boot () {
      // let self = this
      // ClassicEditor
      //   .create(this.$refs['wysiwyg-editor'])
      //   .then(editor => {
      //     self.editor.instance = editor
      //     editor.document.on('change', function (event, type, data) {
      //       self.$emit('input', editor.getData())
      //     })
      //     // editor.document.querySelector('.ck-editor__editable').style.minHeight = self.height
      //   })
      //   .catch(error => {
      //     this.$root.alert({type: 'error', text: `Oops! something went wrong to the Editor! ${error}`})
      //   })
    },
    reboot () {
      this.editor.instance.destroy()
      this.boot()
    }
  },
  mounted () {
    this.boot()
  }
}
</script>

<style lang="stylus">
@import '~@/assets/stylus/theme'

.ck-editor__editable {
  padding-top: 15px;
  min-height: 120px;

  &.ck-focused {
    border: 1px solid #bfbfbf;
    box-shadow: none;
    border-bottom: 2px solid $theme.primary;
  }
}
</style>
