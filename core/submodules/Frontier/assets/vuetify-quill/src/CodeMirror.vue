<template>
  <div class="codemirror-container">
    <v-card flat class="grey lighten-4">
      <textarea class="codemirror" ref="codemirror"></textarea>
    </v-card>
  </div>
</template>

<script>
  import CodeMirror from 'codemirror'
  import JSBeautify from 'js-beautify'
  import emmet from '@emmetio/codemirror-plugin'
  import 'codemirror/mode/htmlmixed/htmlmixed'

  export default {
    name: 'v-codemirror',

    props: {
      content: null,
      options: { type: Object, default: () => { return {} } },
      theme: { type: String, default: "monokai" }
    },

    data () {
      return {
        codemirror: {
          content: null,
          instance: null,
          model: false,
          options: {
            lineNumbers: true,
            lineWrapping: true,
            matchBrackets: true,
            styleActiveLine: true,
            mode: 'htmlmixed',
            markTagPairs: true,
            autoRenameTags: true,
            extraKeys: {
              'Tab': 'emmetExpandAbbreviation',
              'Enter': 'emmetInsertLineBreak'
            }

          }
        },

        jsBeautify: {
          options: {
            indent: 4
          }
        }
      }
    },

    methods: {
      init () {
        this.codemirror.options = Object.assign(this.codemirror.options, this.options, {theme: this.theme})

        this.codemirror.instance = CodeMirror.fromTextArea(this.$refs.codemirror, this.codemirror.options)
      },

      cm () {
        let self = this

        return {
          setValue (value) {
            // If the cursor is not in the editor,
            // it means the setValue content is being fired
            // programmatically
            if (self.codemirror.instance.hasFocus() == false) {
              self.codemirror.content = JSBeautify.html(value, self.jsBeautify.options)
              self.codemirror.instance.setValue(self.codemirror.content)
            }
          }
        }
      },

      emmetify () {
        emmet(CodeMirror)
      },

      listen () {
        let self = this

        self.codemirror.instance.on('change', function (instance, data) {
          self.codemirror.content = JSBeautify.html(self.codemirror.instance.getValue(), self.jsBeautify.options)
          self.$emit('cm-change', self.codemirror.instance.getValue())
        })
      }
    },

    mounted () {
      this.emmetify()
      this.init()
      this.listen()
    },

    watch: {
      'content': function (value) {
        this.cm().setValue(value)
      },

      'codemirror.content': function (value) {
        this.$emit('input', value)
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '~codemirror/lib/codemirror.css';
  @import '~codemirror/theme/monokai.css';

  .CodeMirror {
    z-index: 3;
    height: auto;
  }

  .codemirror-container, .codemirror-container .codemirror textarea {
    font-family: 'Ubuntu Mono', monospace;
  }
</style>
