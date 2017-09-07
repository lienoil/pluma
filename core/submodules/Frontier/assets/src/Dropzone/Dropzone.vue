<template>
    <div>
        <slot name="header"></slot>
        <div :id="id" class="pa-0 card-dropzone dropzone grey--text" :class="(bordered ? 'card-dropzone--bordered' : '')">
            <div class="dropzone-previews" id="dropzone-preview" style="display:none">
                <slot name="preview">
                    <div class="dz-preview dz-file-preview well" id="dz-preview-template">  <!-- template for images -->
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
        </div>

        <template v-if="!autoProcessQueue">
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
            dictDefaultMessage: { type: String, default: 'Drag files here to upload' },
            dictUploadButtonLabel: { type: String, default: 'Start' },
            height: { type: String, default: '200px' },
            id: { type: String, default: 'card-dropzone' },
            paramName: { type: String, default: 'file' },
            params: { type: Object, default: {} },
            thumbnailHeight: { type: String, default: '200' },
            thumbnailWidth: { type: String, default: '200' },
            uploadMultiple: { type: Boolean, default: false },
            url: { type: String, default: '/' },
            parallelUploads: { type: String, default: '-1' },
        },

        data () {
            return {
                dropzone: null,
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
            let preview = document.querySelector('#dropzone-preview').innerHTML;
            this.$props.previewTemplate = preview;
            this.$props.headers = {
                'X-CSRF-Token': vm.token,
            };
            this.dropzone = new Dropzone('#'+vm.id, this.$props);

            this.dropzone.on("addedfile", function (file) {
                if (vm.parallelUploads === '-1') {
                    this.options.parallelUploads = this.files.length;
                }
            });

            this.dropzone.on("thumbnail", function (file, dataUrl) {
                // Thumbnails
                console.log(file.type, dataUrl);
                switch (file.type) {
                    // case 'audio/mp3':
                }
            });

            this.dropzone.on("complete", function (file) {
                vm.$emit('complete', file, vm.dropzone);
                this.options.autoProcessQueue = false;
            });
            this.dropzone.on("success", function (file, response) {
                vm.$emit('success', file, response, vm.dropzone);
                vm.dropzone.removeFile(file);
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
        min-height: 200px;
        border: none;
    }

    .card-dropzone .closebutton {
        position: absolute;
        top: -15px;
        right: -15px;
    }

    .card-dropzone button,
    .card-dropzone.dropzone.dz-clickable * {
        cursor: pointer;
    }

    .card-dropzone.dz-drag-hover {
        background-color: rgba(0,0,0,0.05);
    }

    .card-dropzone.dropzone .dz-preview .dz-details {
        display: block;
        opacity: 1;
    }

    .card-dropzone--bordered {
        border: 1px dashed rgba(0,0,0,0.05);
    }

    .dropzone .dz-preview .dz-details .dz-filename span,
    .dropzone .dz-preview .dz-details .dz-filename:hover span {
        /**/
    }

    .dropzone .dz-preview .dz-image {
        border-radius: 3px;
        border: 1px solid rgba(0,0,0,0.2);
    }
</style>
