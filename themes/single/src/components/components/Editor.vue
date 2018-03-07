<template>
  <v-card flat>
    <label class="body-1 grey--text text--darken-2" v-html="label"></label>
    <textarea ref="wysiwyg-editor" :name="name" v-model="body"></textarea>
  </v-card>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  name: 'Editor',
  model: {
    prop: 'body'
  },
  props: {
    name: { default: 'body' },
    label: { type: String, default: 'Body' },
    body: null
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
      let self = this
      ClassicEditor
        .create(this.$refs['wysiwyg-editor'])
        .then(editor => {
          self.editor.instance = editor
          editor.document.on('change', function (event, type, data) {
            self.$emit('input', editor.getData())
          })
        })
        .catch(error => {
          this.$root.alert({type: 'error', text: `Oops! something went wrong to the Editor! ${error}`})
        })
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

<style>
.ck-editor__editable {
  padding-top: 15px;
  min-height: 400px;
}
</style>
