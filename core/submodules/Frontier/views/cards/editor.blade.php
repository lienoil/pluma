<v-card class="mb-3 elevation-1">
    <v-card-actions id="quill-toolbar" class="pink lighten-5">
        {{-- <v-subheader>{{ __((isset($title) ? $title : 'Content')) }}</v-subheader> --}}
        <v-spacer></v-spacer>
        <v-layout row wrap>
            <v-flex>
                <div class="pa-2">
                    <span class="ql-formats">
                        <select class="ql-size">
                            <option value="10px">{{ __('Small') }}</option>
                            <option selected>{{ __('Normal') }}</option>
                            <option value="18px">{{ __('Large') }}</option>
                            <option value="32px">{{ __('Huge') }}</option>
                        </select>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-font">
                            <option selected>Roboto</option>
                            <option class="ql-font-montserrat" value="montserrat">Montserrat</option>
                            {{-- <option value="roboto">Roboto</option> --}}
                        </select>
                    </span>
                    <span class="ql-formats">
                        <!-- Add a bold button -->
                        <button class="mb-0 ql-bold"></button>
                        <button class="mb-0 ql-italic"></button>
                        <button class="mb-0 ql-underline"></button>
                        <button class="mb-0 ql-blockquote"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="mb-0 ql-align" value="center"></button>
                        <button class="mb-0 ql-align" value="right"></button>
                        <button class="mb-0 ql-align" value="justify"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="mb-0 ql-list" value="ordered"></button>
                        <button class="mb-0 ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="mb-0 ql-script" value="sub"></button>
                        <button class="mb-0 ql-script" value="super"></button>
                        <button class="mb-0 ql-code-block"></button>
                    </span>
                </div>
                <v-spacer></v-spacer>
            </v-flex>
        </v-layout>
    </v-card-actions>
    <div id="quill-editor"></div>
    <input type="hidden" name="body" :value="resource.content.model">
    <input type="hidden" name="delta" :value="resource.content.delta">
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
                    //
                },
            },

            methods: {
                quill() {
                    let self = this,
                        Font = Quill.import('formats/font'),
                        SizeStyle = Quill.import('attributors/style/size');

                    Font.whitelist = ['montserrat', 'Roboto'];
                    Quill.register(Font, true);
                    Quill.register(SizeStyle, true);

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
