<template>
    <div class="quill-container">
        <div ref="toolbar" class="quill-toolbar">
            <slot name="header"></slot>
            <slot name="toolbar">
                <span class="ql-formats">
                    <select class="ql-header">
                        <option value="1">Heading 1</option>
                        <option value="2">Heading 2</option>
                        <option value="3">Heading 3</option>
                        <option value="4">Heading 4</option>
                        <option value="5">Heading 5</option>
                        <option value="6">Heading 6</option>
                        <option selected>Normal</option>
                    </select>
                </span>
                <span class="ql-formats">
                    <select class="ql-size">
                        <option value="10px">Small</option>
                        <option selected>Normal</option>
                        <option value="18px">Large</option>
                        <option value="32px">Huge</option>
                    </select>
                </span>
                <span class="ql-formats">
                    <select class="ql-font">
                        <option selected></option>
                        <option class="ql-font-montserrat" v-for="(font, i) in fonts" :key="i" :value="font" v-html="font"></option>
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
            </slot>
        </div>
        <div :id="id" ref="quill" class="quill-editor"></div>
    </div>
</template>

<script>
    import Quill from 'quill';

    export default {
        name: 'Quill',
        model: {
            prop: 'content',
        },
        props: {
            content: null,
            id: { type: String, default: null },
            output: { type: String, default: '' },
            fonts: {
                type: Array,
                default: () => {
                    return [];
                }
            },
            options: {
                type: Object,
                default: () => {
                    return {
                        theme: 'snow',
                        placeholder: 'Write something',
                        modules: {},
                    };
                }
            },
        },
        data () {
            return {
                quill: {
                    editor: '',
                }
            };
        },
        methods: {
            init () {
                let self = this;

                let Font = Quill.import('formats/font');
                Font.whitelist = self.fonts;
                Quill.register(Font, true);

                let Size = Quill.import('attributors/style/size');
                Quill.register(Size, true);
                Quill.prototype.getHTML = function() {
                    console.log(self.quill.editor);
                    return self.$el.querySelector('.ql-editor').innerHTML;
                };

                self.$emit('init', Quill);

                self.$props.options.modules = {
                    toolbar: self.$refs.toolbar,
                };

                self.quill.editor = new Quill(self.id ? '#'+self.id : self.$refs.quill, self.options);

                // events
                self.quill.editor.on('text-change', function (delta, oldDelta, source) {
                    self.quill.content = self.quill.editor.getHTML();
                    self.quill.delta = self.quill.editor.getContents();
                    self.$emit('input', {content: self.quill.editor.getHTML(), delta: self.quill.editor.getContents()});
                    self.$emit('text-change', delta, oldDelta, source, self.quill.editor);
                });

                self.quill.editor.on('selection-change', function (range, oldRange, source) {
                    self.quill.content = self.quill.editor.getHTML();
                    self.quill.delta = self.quill.editor.getContents();
                    self.$emit('input', {content: self.quill.editor.getHTML(), delta: self.quill.editor.getContents()});
                    self.$emit('selection-change', range, oldRange, source, self.quill.editor);
                });
            },
        },
        mounted () {
            this.init();
        },
    }
</script>

<style>
    @import '~quill/dist/quill.snow.css';
    /**/
</style>
