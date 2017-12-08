<template>
  <div class="quill-container" :class="paper ? 'ql-paper grey lighten-4' : ''">
    <v-card flat class="transparent">
      <v-toolbar card v-if="toolbar" ref="toolbar">
        <template v-if="toolbar">
          <slot name="toolbar"></slot>
        </template>
      </v-toolbar>

      <div v-show="quill.model" ref="quill" class="quill-editor" :class="{'elevation-1':paper,'scrollable':quill.scrollable.model}"></div>

      <v-codemirror class="codemirror-instance" v-if="codemirror" :class="{'codemirror-hidden':codemirror.model, 'codemirror-shown':!codemirror.model}" @input="event().getCodemirrorValue($event)" :content="quill.content.source"></v-codemirror>

      <template v-if="statusBar">
        <v-card-actions class="grey--text status-bar">
          <slot name="status">
            <v-spacer></v-spacer>
            <small>Words: <span v-html="quill.status.words"></span></small>
            <small>Characters: <span v-html="quill.status.characters"></span></small>
          </slot>
        </v-card-actions>
      </template>
    </v-card>

    <slot :prop="quill.content">
      <input type="hidden" name="quill" :value="JSON.stringify(quill.content)">
      <input type="hidden" name="quill_html" :value="quill.content.html">
      <input type="hidden" name="quill_delta" :value="JSON.stringify(quill.content.delta)">
    </slot>
  </div>
</template>

<script>
  import Quill from 'quill'
  import CodeMirror from './CodeMirror.vue'
  import Countable from 'countable'
  import ImageResize from 'quill-image-resize-module/image-resize.min.js'
  // import {ImageResize, Resize, DisplaySize, Toolbar} from 'quill-image-resize-module'
  import {ImageDrop} from 'quill-image-drop-module'

  export default {
    name: 'v-quill',
    model: {
      prop: 'content',
    },
    components: { 'v-codemirror': CodeMirror },
    props: {
      content: {},
      source: { type: Boolean, default: false },
      toolbar: { type: Boolean, default: false },
      toolbarOptions: { type: [Object, Boolean], default: false },
      options: { type: Object, default: () => { return {} } },
      uploadParams: { type: Object, default: () => { return {} } },
      fonts: { type: Array, default: () => { return [] } },
      statusBar: { type: Boolean, default: true },
      paper: { type: Boolean, default: false },
      mediabox: { type: String, default: '' },
    },
    data () {
      return {
        codemirror: {
          model: true
        },
        quill: {
          model: true,
          instance: null,
          content: {},
          status: {},
          scrollable: {
            model: false,
          },
          options: {
            theme: 'snow',
            placeholder: 'Write something',
            toolbar: '.quill-toolbar',
            modules: {
              imageResize: {
                modules: [ 'Resize', 'DisplaySize', 'Toolbar' ],
                // handleStyles: {
                //     backgroundColor: '#222222',
                //     border: 'none',
                //     color: 'white'
                // }
              },
              imageDrop: true,
              toolbar: {
                container: [
                  // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                  // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                  // [{ 'font': [] }],

                  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                  [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                  ['blockquote', 'code-block'],

                  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

                  // [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme

                  ['link', 'image'],

                  ['clean'],                                         // remove formatting button

                  [{ 'direction': 'rtl' }],                         // text direction

                  ['codemirror'],
                ],
                handlers: {
                  'codemirror': this.toolbarCodemirror,
                  // 'image': this.imageHandler,
                  'image': this.mediaboxHandler,
                }
              }
            }
          }
        }
      }
    },
    methods: {
      register () {
        let Font = Quill.import('formats/font')
        let Size = Quill.import('attributors/style/size')
        Font.whitelist = this.fonts

        Quill.register('modules/imageDrop', ImageDrop)
        Quill.register('modules/imageResize', ImageResize)
        Quill.register(Font, true)
        Quill.register(Size, true)
      },

      prototypes () {
        Quill.prototype.getHTML = function() {
          return this.container.querySelector('.ql-editor').innerHTML;
        }

        Quill.prototype.getWordCount = function() {
          return this.container.querySelector('.ql-editor').innerText.length;
        }
      },

      init () {
        this.mergeOptions()
        this.quill.instance = new Quill(this.$refs.quill, this.quill.options)
        this.customToolbar()

        this.$emit('init', this.quill.instance);
      },

      mergeOptions () {
        this.quill.options = Object.assign(this.quill.options, this.options)
        this.quill.options.modules.toolbar.container = this.toolbarOptions ? this.toolbarOptions : this.quill.options.modules.toolbar.container
        if (this.fonts.length) {
          this.quill.options.modules.toolbar.container.unshift([{font: this.fonts}])
        }
      },

      toolbarCodemirror () {
        console.log('clicked');
      },

      customToolbar () {
        let self = this
        let toolbar = self.quill.instance.getModule('toolbar')

        if (self.source) {
          toolbar.addHandler('codemirror', function () {})
          let codemirrorButton = document.querySelector('.ql-codemirror')
          codemirrorButton.innerHTML = '<svg viewBox="0 0 113 105"><path d="M52 .9c-2.1.6-1.8.9 2.5 1.5 10.3 1.6 18.4 7 21.8 14.3.9 2.1.8 2.7-.8 3.9-2.9 2.2-5.5 1.8-5.6-.9 0-1.2-.7.3-1.4 3.3-1.8 7.3-4.3 9.4-11 8.7-2.7-.2-5.9-.8-7-1.2-1.7-.6-1.6-.3.4 1.5 1.4 1.2 3.7 2.4 5.3 2.7 2.6.5 2.8.9 2.8 5.5 0 5.6-2 10.5-6 14.8-3.4 3.6-2.7 3.8 2.1.6 2.4-1.7 4-2.1 5-1.5 2.4 1.5 8.1 1 14.5-1.3 6.1-2.2 6.2-2.2 10.2-.4 2.3 1 5 2.9 6.2 4.1 1.8 2 1.9 2.5.8 5.1-2 4.6-5.3 6.2-4.3 2.1.5-2-.1-2.6-5-4.6l-5.6-2.4-12.2 5.9c-9.9 4.7-13.2 5.8-17.4 5.9-4.1 0-5.7-.5-7.4-2.2l-2.2-2.1 2.1-3.4c1.1-1.8 2.3-4.4 2.7-5.8.5-2 0-1.6-2.4 1.6-2 2.7-5.7 5.5-11 8.4-7.6 4-9.9 6.1-11.4 10.2-.5 1.3.3 1.1 3.2-1 2-1.5 6.1-3.8 8.9-5.1l5.2-2.4 2.3 2c3.1 3 8.3 3.7 15.4 2 6.9-1.6 7.9-1.3 8.8 2.3.9 3.7-3 8.9-9.5 12.7-8.7 5.1-10 6.2-10 8.9 0 3.6 4.4 5.1 8.8 3 3.8-1.9 6.6-2 9.4-.5 1.8 1 1.9.8 1.3-1.1-.5-1.5-.4-2 .4-1.6.6.4 1.1.3 1.1-.2 0-2.6-6.5-2.9-11.5-.5-2.6 1.2-3.8 1.4-4.6.6-1.5-1.5-.4-3 4-5.3 2.1-1 5.8-3.4 8.3-5.4 4.3-3.2 4.8-3.3 6.7-1.9 3 2.1 8.2 3.4 10.5 2.7 1.5-.5 1.6-.8.5-1.5-2.1-1.3.8-3.1 4.4-2.6 5.4.7 1.7-3.9-4.1-4.9-5.5-1-7-2-9.2-6.4l-2-3.9 4.6-2.7c4.2-2.5 4.8-2.6 8.6-1.4 2.3.6 3.7 1.5 3.2 1.8-1.1.9-1.2 6.7-.1 7.9.5.4 1.4.1 2-.8.7-.9 2.5-1.9 4-2.3 2-.5 3.3-1.7 4.3-4.1 1.8-4.3 1.8-6-.1-7.8-1.3-1.3-1-1.9 1.8-5 3.9-4.1 9.6-17.1 10.4-23.6.4-3.7.2-5-1.2-6.1-1.6-1.3-2.1-1-5.5 2.8-4.9 5.5-9.2 16.1-9.4 22.9-.1 2.9-.1 5.3-.2 5.3 0 0-1.5-.7-3.3-1.6-3-1.5-3.7-1.5-9 0-6.6 1.8-9 2-12.4.7l-2.5-1 1.6-5.4c1.4-4.7 1.9-5.4 3.4-4.6 2.3 1.3 8.5 1.1 9.4-.2.3-.6 2.2-1.7 4-2.5 4.1-1.7 4.2-2.9.4-7.4-3.4-3.8-3.8-6.7-1.4-8.5 1.4-1 1.5-1.7.5-4.8C75.2 5.1 62.8-2.2 52 .9z"/><path d="M49.8 7.5c-1.1 1.5-4.7 3.3-10 5C14.5 20.8 3.6 31.2.7 50c-2.2 14.2 2.1 26.9 12.7 37.4 23.3 23.2 64.3 23.1 87.7-.3 7.5-7.5 10.8-13.2 11.5-19.9.9-8.8-3-9.5-5.5-1-3.8 13-17.5 26.9-31.1 31.7-9.9 3.4-26.8 3.2-38.9-.4l-5.4-1.7 2.7-2.1c1.7-1.4 3.5-4.6 4.9-8.7 2-5.9 2.7-6.7 6.7-8.8 3.8-1.9 4.1-2.2 1.9-2.2-5.1 0-8.9 2.1-10.4 5.6-1.2 3-1.7 3.3-4.4 2.8-4.4-.9-10 1.3-10.7 4.2-.3 1.3-1 2.4-1.4 2.4-1.7 0-10-10.4-12.7-15.8C5.7 68 5.5 66.6 5.5 56c0-11 .1-11.8 3.3-18.2 5.1-10.4 13.1-16.3 30.7-22.3 8.4-2.9 12.9-6.2 12.3-8.8-.2-1.2-.7-1-2 .8z"/></svg>'

          codemirrorButton.addEventListener('click', function () {
            self.codemirror.model = !self.codemirror.model
            self.quill.model = !self.quill.model

            if (self.quill.model === false) {
              this.classList.add('ql-active')
            } else {
              this.classList.remove('ql-active')
            }
          })
        }

        // change font selects
        let $container = self.quill.instance.container.parentNode
        $container.querySelectorAll('.ql-toolbar .ql-picker-options .ql-picker-item, .ql-toolbar .ql-picker-label').forEach(function (item) {
          let index = item.getAttribute('data-value')
          if (self.fonts.indexOf(index) != -1) {
            // match
            item.classList.add('custom-font')
            let span = document.createElement('span')
            span.innerHTML = index
            item.insertBefore(span, item.firstChild)
          }

          item.addEventListener('click', function () {
            let label = item.parentNode.parentNode.querySelector('.ql-picker-label span')
            // console.log('lbale', label)
            if (label) {
              label.innerHTML = label.parentNode.getAttribute('data-value')
            }
          })
        })

        document.querySelector('.ql-formats .ql-image').addEventListener('click', function (e) {
          e.stopPropagation();
        });
      },

      listen () {
        let self = this

        self.quill.instance.on('text-change', function (delta, oldDelta, source) {
          // self.$emit('text-change', delta, oldDelta, source, self.quill.instance);
          self.$emit('input', self.quillbox().getContents())
        })

        let MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver
        let observer = new MutationObserver(mutations => {
          mutations.forEach(mutation => {
            if (mutation.type == "attributes") {
              mutation.target.querySelector('span').innerHTML = mutation.target.getAttribute('data-value')
            }
          })
        })

        self.quill.instance.container.parentNode.querySelectorAll('[data-value]').forEach(function (item) {
          let index = item.getAttribute('data-value')
          if (self.fonts.indexOf(index) != -1) {
            observer.observe(item, {
              attributes: true
            })
          }
        })

      },

      quillbox () {
        let self = this

        return {
          setContents (content) {
            self.quill.instance.setContents(content)
          },

          getContents () {
            let html = self.quill.instance.getHTML()

            self.quill.content = {
              source: html,
              html: html,
              delta: self.quill.instance.getContents()
            }

            return self.quill.content
          },

          getContainer () {
            return self.quill.instance.container.querySelector('.ql-editor')
          },

          toggle () {
            self.quill.model = !self.quill.model
            self.codemirror.model = !self.codemirror.model
          }
        }
      },

      event () {
        let self = this
        return {
          getCodemirrorValue (value) {
            if (! self.quill.instance.hasFocus()) {
              self.quill.instance.clipboard.dangerouslyPasteHTML(value)
            }
          }
        }
      },

      imageHandler () {
        let self = this;
        let data = new FormData();
        let fileInput = self.quill.instance.container.querySelector('input.ql-image[type=file]');

        if (fileInput == null) {
          fileInput = document.createElement('input');
          fileInput.setAttribute('type', 'file');
          fileInput.setAttribute('accept', 'image/png, image/gif, image/jpeg, image/bmp, image/x-icon');
          fileInput.classList.add('ql-image');
          fileInput.classList.add('ql-hidden');
          fileInput.addEventListener('change', () => {
            if (fileInput.files != null && fileInput.files[0] != null) {
              const file = fileInput.files[0];
              // file type is only image.
              if (/^image\//.test(file.type)) {
                self.uploadToServer(file);
              } else {
                //
              }
            }
          });
          self.quill.instance.container.appendChild(fileInput);
        }
        fileInput.click();
      },

      uploadToServer (file) {
        let self = this;
        const fd = new FormData();
        for (var k in self.uploadParams) {
          fd.append(k, self.uploadParams[k]);
        }
        fd.append('file', file);
        // fd.append('token', self.options.token);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', self.options.uploadUrl, true);
        xhr.onload = () => {
          if (xhr.status === 200) {
            // this is callback data: url
            // console.log(xhr.responseText);
            const thumbnail = JSON.parse(xhr.responseText).thumbnail;
            self.insertToEditor(thumbnail);
          }
        };
        xhr.send(fd);
      },

      insertToEditor (url) {
        // push image url to rich editor.
        if (! this.quill.instance.hasFocus()) {
          this.quill.instance.focus();
        }

        const range = this.quill.instance.getSelection();
        this.quill.instance.insertEmbed(range.index, 'image', url);
      },

      mediaboxHandler ($bool) {
        let self = this;
        // console.log(this);
        // console.log('quill', self.$event);
        self.$emit('toggle-mediabox', self.quill);

        return;
        // alert('asd');
      },
    },
    mounted () {
      this.register()
      this.prototypes()
      this.init()
      this.quillbox().setContents(this.content.delta ? this.content.delta.ops : [])
      this.listen()
    },
    watch: {
      'mediabox': function (val) {
        if (val) {
          let url = JSON.parse(JSON.stringify(val));
          this.insertToEditor(url);
        }
      },
      'content': function (value) {
        // this.quill.content = value
      },

      'quill.content.html': function (value) {
        let self = this

        Countable.on(self.quillbox().getContainer(), counter => {
          self.quill.status = counter
        }, { stripTags: false, ignore: [] })
      }
    }
  }
</script>

<style lang="styl">
  @import "~quill/assets/snow";

  .quill-container {
    overflow: hidden;

    .scrollable {
      max-height: 450px;
      overflow-y: scroll;
    }

    .ql-toolbar.ql-snow {
      border: none !important;
    }
  }

  .ql-editor {
    pre.ql-syntax {
      font-family: 'Ubuntu Mono', monospace;
    }
  }

  .ql-editor.ql-blank {
    max-height: 300px;
  }

  .ql-snow.ql-toolbar, .ql-snow.ql-container {
    border: none;

    button {
      margin: 0;

      &:hover, &.ql-active {
        svg {
          fill: #06c;
        }
      }
    }
  }
  .ql-container {
    min-height: 300px;
  }
  .ql-hidden {
    display: none;
  }

  .ql-paper {
    .quill-editor {
      background-color: white;
      margin: 2rem 4rem 0;
    }
    .ql-editor {
      padding: 3rem 2rem;
      transition: left 0.08s ease-out;
      min-height: 300px;
    }
    .ql-editor.ql-blank::before {
      left: 30px;
    }

    .status-bar {
      position: absolute;
      bottom: 0;
      right: 6rem;
    }
  }

  .quill {
    &-hidden {
      position: absolute;
      top: 0;
      left: 100%;
      opacity: 0;
    }

    &-shown {
      left: 0;
    }
  }

  .editors {
    &-container {
      max-width: 100%;
      overflow: hidden;
    }
  }

  .codemirror {
    &-instance {
      transition: opacity 0.01s ease-out;
      opacity: 1;
    }

    &-hidden {
      position: absolute;
      top: 0;
      opacity: 0;
      z-index: -1;
    }

    &-shown {
      opacity: 1;
      max-width: 100%;
    }
  }

  .custom-font {
    &:before {
      content: '' !important;
    }
  }

  .ql-font-Mirza, [data-value=Mirza] {
    font-family: 'Mirza';
  }
</style>
