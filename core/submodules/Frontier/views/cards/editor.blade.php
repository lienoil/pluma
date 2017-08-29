<v-card class="mb-3 elevation-1">
    {{-- <v-toolbar card class="transparent">
        <v-toolbar-title>{{ __((isset($title) ? $title : 'Content')) }}</v-toolbar-title>
    </v-toolbar> --}}

    <v-card-text>
        <div id="quill-toolbar">
            <!-- Add a bold button -->
            <button class="mb-0 ql-bold"></button>
            <button class="mb-0 ql-italic"></button>
            <button class="mb-0 ql-underline"></button>
            <!-- Add subscript and superscript buttons -->
            <button class="mb-0 ql-script" value="sub"></button>
            <button class="mb-0 ql-script" value="super"></button>

            <button class="mb-0 ql-code-block"></button>
        </div>

        <style>
            #quill-editor .ql-editor {
                min-height: 200px;
            }
        </style>
        <div id="quill-editor"></div>

        <input type="hidden" name="body" :value="resource.content.model">
        <input type="hidden" name="delta" :value="resource.content.delta">
    </v-card-text>
</v-card>

@push('pre-scripts')
    {{-- compile this --}}
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.1/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.1/quill.bubble.css" rel="stylesheet">

    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        content: {
                            model: '',
                            delta: null,
                        },
                    },
                };
            },

            watch: {
                'resource.content.model': function (val) {
                    console.log(val);
                },
            },

            methods: {
                quill() {
                    let self = this;

                    Quill.prototype.getHtml = function() {
                        return this.container.querySelector('.ql-editor').innerHTML;
                    };

                    let quill = new Quill('#quill-editor', {
                        modules: {
                            toolbar: '#quill-toolbar',
                        },
                        theme: 'snow',
                        placeholder: '{{ __('Write something...') }}',
                    });

                    quill.on('text-change', function(delta, oldDelta, source) {
                        self.resource.content.model = JSON.stringify(quill.getHtml());
                        self.resource.content.delta = JSON.stringify(quill.getContents());
                    });

                    return quill;
                },
            },

            mounted () {
                this.quill();
            }
        })
    </script>
@endpush
