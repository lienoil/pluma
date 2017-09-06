<template>
    <div>
        <!-- :class="bordered ? 'card-dropzone--bordered' : 'card-dropzone'" -->
        <v-card id="upload-dropzone" flat  :height="height">
        loasdl
        </v-card>
    </div>
</template>

<script>
    import Dropzone from './../../node_modules/dropzone';

    export default {
        name: 'Dropzone',

        props: {
            url: {
                type: String,
                default: '',
            },

            height: {
                type: String,
                default: '200px',
            },
        },

        data () {
            return {
                dropzone: null,
            };
        },

        mounted () {
            // let dropzone = new Dropzone('#upload-dropzone', {url: this.url});
        },
    };
</script>

<style>
    .card-dropzone--bordered {
        border: 1px dashed rgba(0,0,0,0.1);
    }
</style>
