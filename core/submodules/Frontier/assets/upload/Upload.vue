<template>
    <div>
        <v-card
            class="card--upload"
            flat
            role="button"
            @click.stop="onFocus"
            :disabled="disabled"
            ref="fileTextField"
            v-model="filename"
            @dragenter="onFileChange"
            style="`min-height: ${height}`"
        >
            <input type="file" :accept="accept" :multiple="multiple" :disabled="disabled"
                       ref="fileInput" @change="onFileChange">
            <template v-if="!filename">
                <v-layout fill-height column align-center justify-center>
                    <div class="text-xs-center grey--text text--ligthen-3"><v-icon>attach_file</v-icon> {{ label }}</div>
                </v-layout>
            </template>
            <template v-else>
                <v-card-text>
                    <v-card class="elevation-1 mb-3" v-for="(file, i) in filename.split(',')" :key="i">
                        <v-card-media height="50%"></v-card-media>
                        <v-card-text>
                            {{ file }}
                        </v-card-text>
                    </v-card>
                </v-card-text>
            </template>
            <!-- <v-card-text class="text-xs-center"> -->
                <!-- <v-text-field prepend-icon="attach_file" single-line
                              v-model="filename" :label="label" :required="required"
                              @click.native="onFocus"
                              :disabled="disabled" ref="fileTextField"></v-text-field> -->
            <!-- </v-card-text> -->
        </v-card>
    </div>
</template>

<script>
    export default{
        name: 'upload',
        props: {
            height: {
                type: String,
                default: "auto",
            },
            value: {
                type: [Array, String]
            },
            accept: {
                type: String,
                default: "*"
            },
            label: {
                type: String,
                default: "Upload..."
            },
            required: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            multiple: {
                type: Boolean, // not yet possible because of data
                default: false
            }
        },
        data(){
            return {
                filename: ""
            };
        },
        watch: {
            value(v){
                this.filename = v;
            }
        },
        mounted() {
            this.filename = this.value;
        },

        methods: {
            getFormData(files){
                const data = new FormData();
                [...files].forEach(file => {
                    data.append('data', file, file.name); // currently only one file at a time
                });
                return data;
            },
            onFocus(){
                if (!this.disabled) {
                    debugger;
                    this.$refs.fileInput.click();
                }
            },
            onFileChange($event){
                const files = $event.target.files || $event.dataTransfer.files;
                const form = this.getFormData(files);
                if (files) {
                    if (files.length > 0) {
                        this.filename = [...files].map(file => file.name).join(', ');
                    } else {
                        this.filename = null;
                    }
                } else {
                    this.filename = $event.target.value.split('\\').pop();
                }
                this.$emit('input', this.filename);
                this.$emit('formData', form);
            }
        }
    };
</script>

<style scoped>
    .card--upload input[type=file] {
        position: absolute;
        left: -99999px;
    }
    .card--upload {
        border: 1px dashed rgba(0,0,0,0.3);
    }
</style>
