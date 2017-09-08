<template>
    <div>
        <slot name="header"></slot>
        <div :id="id" class="pa-0 card-dropzone dropzone grey--text" :class="(bordered ? 'card-dropzone--bordered' : '')">
            <slot name="preview-area"></slot>
        </div>
        <div data-dropzone-preview-template style="display:none">
            <slot name="preview-template">
                <div style="display:none" class="dz-preview dz-file-preview well">  <!-- template for images -->
                    <img data-dz-thumbnail>
                    <div class="dz-details">
                        <div role="button" class="closebutton" data-dz-remove>
                            <i class="fa fa-close"></i>
                        </div>
                        <div class="dz-filename">
                            <span data-dz-name></span>
                        </div>
                        <div class="dz-size" data-dz-size></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-success-mark"><span></span></div>
                    <div class="dz-error-mark"><span></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                </div>
            </slot>
        </div>

        <template v-if="! autoProcessQueue">
            <slot name="actions" scope="props">
                <div class="card__actions">
                    <button type="button" @click="upload()" class="elevation-1 btn btn--raised primary">
                        <div class="btn__content">{{ dictUploadButtonLabel }}</div>
                    </button>
                </div>
            </slot>
        </template>
    </div>
</template>

<script>
    import Dropzone from 'dropzone';

    export default {
        name: 'Dropzone',
        props: {
            acceptedFiles: { type: String, default: null },
            addRemoveLinks: { type: Boolean, default: false },
            autoProcessQueue: { type: Boolean, default: true },
            bordered: { type: Boolean, default: true },
            createImageThumbnails: { type: Boolean, default: true },
            dictDefaultMessage: { type: String, default: 'Drag files here to upload' },
            dictUploadButtonLabel: { type: String, default: 'Start' },
            height: { type: String, default: '200px' },
            id: { type: String, default: 'card-dropzone' },
            parallelUploads: { type: String, default: '-1' },
            paramName: { type: String, default: 'file' },
            params: { type: Object, default: {} },
            // previewTemplate: { type: String, default: '' },
            thumbnailHeight: { type: String, default: '200' },
            thumbnailWidth: { type: String, default: '200' },
            uploadMultiple: { type: Boolean, default: false },
            url: { type: String, default: '/' },
        },

        data () {
            return {
                dropzone: null,
                file: {
                    progress: 50,
                },
                files: null,
            };
        },

        methods: {
            upload () {
                this.dropzone.processQueue();
            },
        },

        mounted () {
            let vm = this;
            let self = this;
            let preview = document.querySelector('[data-dropzone-preview-template]').innerHTML;
            this.$props.previewTemplate = preview;
            this.$props.headers = {
                'X-CSRF-Token': vm.token,
            };

            this.dropzone = new Dropzone('#'+vm.id, this.$props);

            this.dropzone.on("addedfile", function (file) {
                vm.file = file;
                let preview = file.previewElement;

                preview.querySelector('[data-dz-type]') ? preview.querySelector('[data-dz-type]').innerHTML = file.type : '';
                preview.querySelector('[data-dz-status]') ? preview.querySelector('[data-dz-status]').innerHTML = file.status : '';

                if (vm.parallelUploads === '-1') {
                    this.options.parallelUploads = this.files.length;
                }

                vm.$emit('addedfile', vm.file, preview, vm.dropzone);
            });

            this.dropzone.on("uploadprogress", function (file, progress) {
                let preview = file.previewElement;

                preview.querySelector('[data-dz-uploadprogress]') ? preview.querySelector('[data-dz-uploadprogress]').setAttribute('style', 'width:'+progress+'%') : '';

                vm.$emit('uploadprogress', file, progress, preview, vm.dropzone);
            });

            this.dropzone.on("thumbnail", function (file, dataURL) {
                let preview = file.previewElement;
                let url = dataURL;

                preview.querySelector('[data-dz-thumbnail]').setAttribute('src', url);

                vm.$emit('thumbnail', file, dataURL, preview, vm.dropzone);
            });

            this.dropzone.on("complete", function (file) {
                vm.$emit('complete', file, vm.dropzone);
                this.options.autoProcessQueue = false;
            });

            this.dropzone.on("success", function (file, response) {
                file.previewElement.classList.add("dz-success");
                vm.$emit('success', file, response, vm.dropzone);
                // vm.dropzone.removeFile(file);
            });

            this.dropzone.on("processing", function () {
                this.options.autoProcessQueue = true;
            });
        },
    };
</script>

<style>
    @import '~dropzone/dist/dropzone.css';
    .card-dropzone {
        min-height: 250px;
        border: none;
    }

    .card-dropzone [data-dz-thumbnail] {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: auto;
        /*min-height: 120px;*/
    }

    .card-dropzone .closebutton {
        position: absolute;
        top: -15px;
        right: -15px;
    }

    .card-dropzone .dz-progressbar {
        width: 0;
        height: 5px;
        display: block;
        background: dodgerblue;
        transition: width 0.2s ease-in-out;
    }

    .card-dropzone.dropzone.dz-clickable button {
        cursor: pointer;
        z-index: 3;
    }

    .card-dropzone.dz-drag-hover {
        background-color: rgba(0,0,0,0.05);
    }

    .card-dropzone.dropzone .dz-preview {
        /*max-width: 33.3333%;*/
        min-width: 250px;
        min-height: 250px;
    }

    .card-dropzone.dropzone .dz-preview:hover {
        z-index: 1;
    }

    .card-dropzone.dropzone .dz-preview .dz-details {
        display: block;
        opacity: 1;
    }

    .card-dropzone--bordered {
        border: 1px dashed rgba(0,0,0,0.05);
    }

    .card-dropzone [data-dz-thumbnail] {
        position: relative;
        width: 100%;
        top: 0;
        left: 0;
    }

    .dropzone .dz-preview .dz-details .dz-filename span,
    .dropzone .dz-preview .dz-details .dz-filename:hover span {
        /**/
    }

    .dropzone .dz-preview .dz-image {
        border-radius: 3px;
        border: none;
    }

    .dropzone.dz-clickable * {
        cursor: default;
    }

    .dz-min-height {
        min-height: 120px;
    }

    .card-dropzone.dropzone .dz-preview .card--dz-details {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: auto;
        top: unset;
        background: transparent;
        background-color: rgba(0,0,0,0.7);
    }
</style>
