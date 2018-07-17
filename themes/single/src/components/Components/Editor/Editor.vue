<template>
  <div>
    <textarea
      :name="editor.el"
      ref="editor"
    ></textarea>
  </div>
</template>

<script>
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  name: 'Editor',
  data () {
    return {
      editor: {
        el: ''
      }
    }
  },
  mounted () {
    // let element = this.$refs['editor']

    // ClassicEditor
    //   .create(element)
    //   .then(editor => {
    //     console.log(editor)
    //   })
  }
}
</script>

<style lang="stylus">
.ck {
  &.ck-toolbar,
  &.ck-editor__editable_inline {
    border: none !important;
  }

}

.ck-editor__editable {
  min-height: 400px;
}
</style>
