<quill v-model="content" output="html" class="mb-3 white elevation-1" :fonts="['Montserrat', 'Roboto']"></quill>

@push('pre-css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/quill/Quill.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/dist/quill/Quill.js') }}"></script>
    <script>
        Vue.use(Quill);

        mixins.push({
            data () {
                return {
                    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum eveniet hic vero suscipit cupiditate iure, cum veniam autem. Similique eaque unde perferendis! Minima quia ipsa tempora quos, quae, provident adipisci.'
                }
            },
            components: { Quill },
            watch: {
                content: function (val) {
                    console.log("Content", val);
                }
            },
        });
    </script>
@endpush
