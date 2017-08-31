<v-card class="mb-3 elevation-1 mode" :class="editor.toolbar.modes.distraction.model?'mode-distraction-free':''">
    <v-toolbar card dense class="yellow lighten-3">
        <v-icon>fa-sticky-note</v-icon>
        <v-toolbar-title class="subheading grey--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <template>
            <v-btn
                icon
                v-model="editor.source.model"
                v-tooltip:left="{'html': '{{ __('Toggle Source Code View') }}'}"
                @click.native="editor.source.model = !editor.source.model"
            >
                <v-icon>code</v-icon>
            </v-btn>
        </template>

        <template>
            <v-btn
                icon
                v-model="editor.preview.model"
                v-tooltip:left="{'html': '{{ __('Toggle Preview') }}'}"
                @click.native="editor.preview.model = !editor.preview.model"
            >
                <v-icon>fa-eye</v-icon>
            </v-btn>
        </template>

        <template>
            <v-btn
                icon
                v-model="editor.toolbar.modes.distraction.model"
                v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                @click.native="editor.toolbar.modes.distraction.model = !editor.toolbar.modes.distraction.model"
            >
                <v-icon>@{{ editor.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
            </v-btn>
        </template>
    </v-toolbar>
    <v-card-actions id="quill-toolbar" class="quill-toolbar yellow lighten-5">
        <v-spacer></v-spacer>
        <v-layout row wrap>
            <v-flex>
                <v-spacer></v-spacer>
                <div class="pa-2">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="1">{{ __('Heading 1') }}</option>
                            <option value="2">{{ __('Heading 2') }}</option>
                            <option value="3">{{ __('Heading 3') }}</option>
                            <option value="4">{{ __('Heading 4') }}</option>
                            <option value="5">{{ __('Heading 5') }}</option>
                            <option value="6">{{ __('Heading 6') }}</option>
                            <option selected>{{ __('Normal') }}</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-size">
                            <option value="10px">{{ __('Small') }}</option>
                            <option selected>{{ __('Normal') }}</option>
                            <option value="18px">{{ __('Large') }}</option>
                            <option value="32px">{{ __('Huge') }}</option>
                        </select>
                    </span>
                    {{-- <span class="ql-formats">
                        <select class="ql-size">
                            @foreach ([8,9,10,11,15,20,22,75] as $size)
                                <option value="{{ "{$size}px" }}">{{ "{$size}px" }}</option>
                            @endforeach
                        </select>
                    </span> --}}
                    <span class="ql-formats">
                        <select class="ql-font">
                            <option selected>Roboto</option>
                            <option class="ql-font-montserrat" value="Montserrat">Montserrat</option>
                            {{-- <option value="roboto">Roboto</option> --}}
                        </select>
                    </span>
                    <span class="ql-formats">
                        <!-- Add a bold button -->
                        <button title="bold" class="mb-0 ql-bold"></button>
                        <button title="italic" class="mb-0 ql-italic"></button>
                        <button title="underline" class="mb-0 ql-underline"></button>
                        <button title="blockquote" class="mb-0 ql-blockquote"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="left" class="mb-0 ql-align" value=""></button>
                        <button title="center" class="mb-0 ql-align text-xs-center" value="center"></button>
                        <button title="right" class="mb-0 ql-align" value="right"></button>
                        <button title="justify" class="mb-0 ql-align" value="justify"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="ordered" class="mb-0 ql-list" value="ordered"></button>
                        <button title="bulletted" class="mb-0 ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button title="subscript" class="mb-0 ql-script" value="sub"></button>
                        <button title="superscript" class="mb-0 ql-script" value="super"></button>
                        <button title="code block" class="mb-0 ql-code-block"></button>
                    </span>
                </div>
                <v-spacer></v-spacer>
            </v-flex>
        </v-layout>
    </v-card-actions>

    <v-layout row wrap>
        <v-flex>
            <v-card flat height="100%">
                <div id="quill-editor" class="quill-editor ql-editor--yellow"></div>
            </v-card>
        </v-flex sm6>
        <v-flex v-show="editor.source.model">
            <v-card flat height="100%">
                <div id="codemirror-editor" class="codemirror-editor"></div>
            </v-card>
        </v-flex>
        <v-flex v-show="editor.preview.model">
            <v-card flat class="grey lighten-5" height="100%">
                <v-card-text>
                    <v-card class="elevation-1">
                        <v-card-text>
                            <div id="preview-editor" class="preview-editor" v-html="editor.content.model"></div>
                        </v-card-text>
                    </v-card>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>

    <input type="hidden" name="body" :value="editor.content.model">
    <input type="hidden" name="delta" :value="editor.content.delta">
</v-card>

@push('pre-css')
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.1/quill.bubble.css" rel="stylesheet">
    <link href="{{ assets('frontier/vendors/codemirror/lib/codemirror.css') }}" rel="stylesheet">
    <link href="{{ assets('frontier/vendors/codemirror/theme/monokai.css') }}" rel="stylesheet">
@endpush

@push('pre-scripts')
    {{-- compile this --}}
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.1/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>
    <script src="{{ assets('frontier/vendors/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <script src="{{ assets('frontier/vendors/codemirror/addon/hint/html-hint.js') }}"></script>

    <script>
        mixins.push({
            data () {
                return {
                    editor: {
                        source: {
                            editor: null,
                            model: true,
                        },
                        preview: {
                            editor: null,
                            model: false,
                        },
                        content: {
                            editor: null,
                            model: '',
                            delta: null,
                        },
                        toolbar: {
                            model: true,
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                        },
                    },
                };
            },

            watch: {
                'editor.content.model': function (val) {
                    this.editor.source.editor.setValue(val);
                },
            },

            methods: {
                codemirror () {
                    let self = this;
                    let target = document.querySelector('#codemirror-editor');

                    this.editor.source.editor = CodeMirror(target, {
                        lineNumbers: true,
                        lineWrapping: true,
                        mode: "htmlmixed",
                        theme: "monokai",
                    });

                    this.editor.source.editor.on('keyup', function (instance) {
                        self.editor.content.model = instance.getValue();
                        // self.editor.content.editor.clipboard.dangerouslyPasteHTML(instance.getValue());
                    });

                    self.editor.source.editor.setValue(self.editor.content.model);

                    this.editor.source.model = false;
                },

                quill () {
                    let self = this,
                        Font = Quill.import('formats/font'),
                        SizeStyle = Quill.import('attributors/style/size');

                    Font.whitelist = ['Montserrat'];//{!! json_encode(config('editor.fonts.enabled', [])) !!};
                    Quill.register(Font, true);
                    Quill.register(SizeStyle, true);
                    // Quill.register(ImageImport, true);
                    // Quill.register(ImageResize, true);


                    Quill.prototype.getHtml = function() {
                        let content = this.container.querySelector('.ql-editor').innerHTML;

                        if (content.charAt(0) === '"' && content.charAt(content.length -1) === '"') {
                            content = content.substr(1, content.length -2);
                        }

                        return content;
                    };

                    self.editor.content.editor = new Quill('#quill-editor', {
                        modules: {
                            toolbar: '#quill-toolbar',
                        },
                        theme: 'snow',
                        placeholder: '{{ __('Write something...') }}',
                        imageImport: true,
                        imageResize: {
                            displaySize: true
                        },
                    });

                    self.editor.content.editor.on('text-change', function(delta, oldDelta, source) {
                        self.editor.content.model = self.editor.content.editor.getHtml();
                        self.editor.content.delta = JSON.stringify(self.editor.content.editor.getContents());
                    });

                    return self.editor.content.editor;
                },
            },

            mounted () {
                this.codemirror();
                this.quill();
            }
        })
    </script>
@endpush
