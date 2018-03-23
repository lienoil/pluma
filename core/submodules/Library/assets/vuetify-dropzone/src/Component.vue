<template>
  <div class="dropzone-container">
    <!-- <form :action="fallbackUrl" method="POST" enctype="multipart/form-data"> -->
      <div ref="dropzone" class="dropzone">
        <div class="fallback">
          <input type="file" v-bind="{'multiple': dropzone.options.uploadMultiple}" :name="name">
        </div>
        <slot name="default-message">
          <div class="dz-message text-xs-center" data-dz-message>
            <v-icon class="grey--text display-4">cloud_upload</v-icon>
            <div class="grey--text">UPLOAD</div>
          </div>
        </slot>
        <div class="dropzone-previews">
          <div data-preview-template class="text-xs-center">
            <slot name="preview-template">
              <v-card tile class="card--thumbnail elevation-1 ma-2">
                <v-card-media data-dz-thumbnail class="accent" :height="dropzone.options.thumbnailHeight">
                  <img data-dz-thumbnail>
                  <v-container fluid fill-height class="zi-1">
                    <v-layout column wrap fill-height class="pa-0">
                      <v-toolbar dense card class="transparent">
                        <v-spacer></v-spacer>
                        <v-btn icon dark class="error btn--dz-remove" role="button" data-dz-remove><v-icon>close</v-icon></v-btn>
                      </v-toolbar>
                      <v-spacer></v-spacer>
                    </v-layout>
                  </v-container>
                </v-card-media>
                <v-card-title class="subheading" data-dz-name></v-card-title>
                <v-card-actions class="caption">
                  <div class="dz-size" data-dz-size></div>
                  <v-spacer></v-spacer>
                  <div class="dz-type" data-dz-type></div>
                </v-card-actions>

                <div class="dz-success-mark">
                  <v-icon class="display-4 success--text">check</v-icon>
                </div>
                <div class="dz-progress"><div class="dz-upload primary" data-dz-uploadprogress></div></div>
                <div class="dz-error-message dz-hidden">
                  <div class="dz-error-mark text-xs-center">
                    <v-icon class="display-4 error--text">warning</v-icon>
                  </div>
                  <v-card flat tile class="error white--text">
                    <v-card-text data-dz-errormessage class="dz-errormessage-blurb"></v-card-text>
                  </v-card>
                </div>
              </v-card>
            </slot>
          </div>
        </div>
      </div>
      <slot></slot>
      <template v-if="! dropzone.options.autoProcessQueue">
        <slot name="submit">
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn primary @click.stop="dropzonebox().submit()" ripple><v-icon left v-html="dropzone.options.dictUploadButtonIcon"></v-icon><span v-html="dropzone.options.dictUploadButtonLabel"></span></v-btn>
          </v-card-actions>
        </slot>
      </template>
    <!-- </form> -->
  </div>
</template>

<script>
  import Dropzone from 'dropzone'

  export default {
    name: 'v-dropzone',
    model: {
      prop: 'params'
    },
    props: {
      autoRemoveFiles: { type: Boolean, default: false },
      params: { type: Object, default: () => { return {} } },
      fallbackUrl: { type: String, default: '/' },
      name: { type: String, default: 'file' },
      multiple: { type: Boolean, default: true },
      options: { type: Object, default: () => { return {} } }
    },
    data () {
      return {
        files: [],
        dropzone: {
          instance: null,
          options: {
            acceptedFiles: null,
            addRemoveLinks: false,
            autoProcessQueue: true,
            createImageThumbnails: true,
            dictUploadButtonLabel: 'Start',
            dictUploadButtonIcon: 'file_upload',
            height: '200px',
            parallelUploads: 1,
            paramName: 'file',
            params: {},
            // previewsContainer: ".dropzone-previews",
            previewTemplate: null,
            thumbnailHeight: '200',
            thumbnailWidth: '200',
            uploadMultiple: true,
            url: '/'
          }
        }
      }
    },

    methods: {
      dropzonebox: function () {
        let self = this

        return {
          mount () {
            Dropzone.autoDiscover = false
            self.dropzone.options = Object.assign(self.dropzone.options, self.options, {params: self.params})
            let $previewTemplate = self.$refs.dropzone.querySelector('[data-preview-template]')
            self.dropzone.options.previewTemplate = $previewTemplate.innerHTML
            $previewTemplate.remove()
            self.dropzone.instance = new Dropzone(self.$refs.dropzone, self.dropzone.options)
          },

          listen () {
            self.dropzone.instance.on("addedfile", function (file) {
              let preview = file.previewElement

              preview.querySelector('[data-dz-type]') ? preview.querySelector('[data-dz-type]').innerHTML = file.type : ''
              preview.querySelector('[data-dz-status]') ? preview.querySelector('[data-dz-status]').innerHTML = file.status : ''

              if (self.options.parallelUploads && self.options.parallelUploads === '-1') {
                self.options.parallelUploads = this.files.length
              }

              // console.log('asd', self.dropzone.instance.options)
              self.files.push(file)
              self.$emit('addedfile', {file, dropzone: self.dropzone})
            })

            self.dropzone.instance.on("sending", function (file, xhr, formData) {
              // console.log('sending', JSON.parse(JSON.stringify(self.dropzone.options.params)))
              self.$emit("sending", {file, xhr, formData})

              for (let param in self.params) {
                // console.log(param, self.params[param])
                formData.append(param, self.params[param])
              }
            })

            self.dropzone.instance.on("uploadprogress", function (file, progress) {
              let preview = file.previewElement
              // console.log('asd', progress);

              preview.querySelector('[data-dz-uploadprogress]') ? preview.querySelector('[data-dz-uploadprogress]').setAttribute('style', 'width:'+progress+'%') : ''
              // console.log("progress", progress)

              self.$emit('uploadprogress', file, progress, self.dropzone)
            })

            self.dropzone.instance.on("thumbnail", function (file, dataURL) {
              let preview = file.previewElement
              let url = dataURL

              preview.querySelector('[data-dz-thumbnail]').setAttribute('src', url)

              self.$emit('thumbnail', file, dataURL)
            })

            self.dropzone.instance.on("complete", function (file) {
              self.$emit('complete', file)

              if (file.status === 'error') {
                let preview = file.previewElement
                preview.querySelector('.dz-error-message').classList.remove('dz-hidden')
              }

              // self.dropzone.options.autoProcessQueue = false
            })

            self.dropzone.instance.on("success", function (file, response) {
              let dis = this
              file.previewElement.classList.add("dz-success")
              // file.previewElement.querySelector('.dz-success-mark').classList.remove('dz-hidden')
              if (self.autoRemoveFiles) {
                setTimeout(function () {
                  dis.removeFile(file)
                }, 900)
              }

              self.$emit("success", file, response)
            })

            self.dropzone.instance.on("error", function (file, errorMessage) {
              if (typeof errorMessage == 'object') {
                let errors = []
                for (let e in errorMessage) {
                  errorMessage[e] = errorMessage[e].join(', ')
                  errors.push(errorMessage[e])
                }
                errorMessage = errors.join(', ')
              }

              file.previewElement.querySelector('[data-dz-errormessage]').innerHTML = errorMessage
              self.$emit("error", file, errorMessage)
            })

            self.dropzone.instance.on("processing", function () {
              // self.dropzone.options.autoProcessQueue = true
              self.$emit("processing")
            })

            // self.dropzone.instance.on("sending", function(file, xhr, formData) {
            //   // Will send the filesize along with the file as POST data.
            //   // formData.append("filesize", file.size);
            //   self.$emit("sending", file, xhr, formData)
            // })
          },

          submit () {
            self.dropzone.instance.processQueue()
          }
        }
      }
    },

    mounted () {
      this.dropzonebox().mount()
      this.dropzonebox().listen()
    },

    watch: {
      'params': function (value) {
        // console.log(value)
        this.$emit('input', value)
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import "~dropzone/dist/dropzone.css";

  .dropzone {
    border: 1px dashed rgba(0,0,0,0.2);

    &-container {
      padding: 1rem;

      &:hover {
        .dropzone {
          background-color: rgba(0,0,0,0.02);
        }
      }

      [role=button] {
        cursor: pointer;
      }

      .card__media {
        width: 250px;
        img[data-dz-thumbnail] {
          width: 100%;
          height: auto;
          position: absolute;
          top: 0;
          left: 0;
          // z-index: 1;
        }
      }

      .card--thumbnail {
        width: auto;
        max-width: 250px;
        display: inline-block;
      }
    }

    .dz-hidden {
      display: none;
    }

    .dz-progress .dz-upload {
      transition: width 0.03s ease-in-out;
      width: 0;
      height: 3px;
    }

    .btn--dz-remove {
      // z-index: 3;
    }

    .dz-success-mark {
      display: none;
    }

    .dz-success {
      .dz-success-mark {
        display: block;
      }
    }

    .dz-error-message {
      transition: all 0.05s ease-in-out;
    }

    .dz-error-mark, .dz-success-mark {
      .icon, > i, > span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
      }
    }

    .dz-errormessage-blurb {
      max-height: 300px;
      max-width: 100%;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .dz-default.dz-message span {
      font-size: 16px;
      font-weight: bold;
      color: rgba(0,0,0,0.3);
    }

    .zi-1 {
      z-index: 1;
    }
  }
</style>
