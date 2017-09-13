<quill v-model="quill.values" output="html" class="mb-3 white elevation-1" :fonts="['Calibri', 'Montserrat', 'Roboto']">
    <template slot="header">
        <input type="hidden" name="body" :value="quill.values.content">
        <input type="hidden" name="delta" :value="JSON.stringify(quill.values.delta)">
    </template>
</quill>

{{-- @push('pre-css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/quill/Quill.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/dist/quill/Quill.js') }}"></script>
    <script>
        Vue.use(Quill);

        mixins.push({
            components: { Quill },
            data () {
                return {
                    quill: {
                        values: {},
                    }
                }
            },
            watch: {
                'quill.values': function (val) {
                    console.log("Content", this.quill.values, val);
                }
            },
        });
    </script>
@endpush --}}
