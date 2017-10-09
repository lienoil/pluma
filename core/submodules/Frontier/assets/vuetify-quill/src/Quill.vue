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
            fonts: { type: Array, default: () => { return [] } },
            statusBar: { type: Boolean, default: true },
            paper: { type: Boolean, default: false }
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
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                                ['blockquote', 'code-block'],

                                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                                [{ 'direction': 'rtl' }],                         // text direction

                                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

                                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                                [{ 'font': [] }],
                                [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],

                                ['link', 'image'],

                                ['clean'],                                         // remove formatting button

                                ['codemirror', 'scroll']
                            ]
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

                Quill.register(Font, true)
                Quill.register(Size, true)

                Quill.register('modules/imageResize', ImageResize)
                Quill.register('modules/imageDrop', ImageDrop)
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
                this.quill.options = ! this.options.length ? Object.assign(this.options, this.quill.options) : this.options
                this.quill.options.modules.toolbar = this.toolbarOptions ? this.toolbarOptions : this.quill.options.modules.toolbar;
            },

            customToolbar () {
                let self = this
                let toolbar = self.quill.instance.getModule('toolbar')

                if (self.source) {
                    toolbar.addHandler('codemirror', function () {

                    })
                    let codemirrorButton = document.querySelector('.ql-codemirror')
                    codemirrorButton.innerHTML = '<svg viewBox="0 0 18 18"> <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline> <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline> <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line> </svg>'
                    codemirrorButton.addEventListener('click', function () {
                        self.codemirror.model = !self.codemirror.model
                        self.quill.model = !self.quill.model
                    })
                }

            },

            listen () {
                let self = this

                self.quill.instance.on('text-change', function (delta, oldDelta, source) {
                    // self.$emit('text-change', delta, oldDelta, source, self.quill.instance);
                    self.$emit('input', self.quillbox().getContents());
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
            }
        },
        mounted () {
            this.register()
            this.prototypes()
            this.init()
            this.quillbox().setContents(this.content.delta ? this.content.delta.ops : [])
            this.listen()
        },
        watch: {
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

    .ql-snow.ql-toolbar, .ql-snow.ql-container {
        border: none;

        button {
            margin: 0;
        }
    }
    .ql-container {
        min-height: 300px;
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
</style>