<template>
  <v-card>
    <!-- <div ref="dropzone-box" class="grey--transparentize dropzone mb-3">
      <div class="fallback">
        <input type="file" v-bind="{'multiple': dropzone.params.uploadMultiple}" :name="name">
      </div>

      <v-container fluid grid-list-lg>
        <v-layout row wrap class="dropzone-preview-container---disabled">
          <slot name="message">
            <v-flex sm12>
              <div class="dz-message text-xs-center grey--text text--darken-1" data-dz-message>
                <div><v-icon class="display-4" v-html="dropzone.params.dictDefaultIcon"></v-icon></div>
                <span v-html="dropzone.params.dictDefaultMessage"></span>
              </div>
            </v-flex>
          </slot>
        </v-layout>
      </v-container>

    </div> -->

    <!-- Try -->
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12 sm6 md4 lg3 v-for="(file, i) in files" :key="i">
          <v-card height="100%" tile class="card--thumbnail elevation-1">
            <v-card-media data-dz-thumbnail contain class="accent" :height="dropzone.params.thumbnailHeight">
              <img data-dz-thumbnail :src="file.dataURL" :width="dropzone.params.thumbnailWidth" :height="dropzone.params.thumbnailHeight">
            </v-card-media>
            <v-card-text>
              <v-text-field
                label="File Name"
                :value="file.name"
                :suffix="file.type"
                :name="`files[${i}][name]`"
              ></v-text-field>
              <v-select :items="categories" :name="`files[${i}][category_id]`" item-text="name" item-value="id" label="Category"></v-select>
            </v-card-text>
            <v-card-actions>
              <div class="dz-size" data-dz-size></div>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex xs12 sm6 md4 lg3>
          <v-card height="100%" flat tile class="card--thumbnail">
            <div ref="dropzone-box" class="grey--transparentize dropzone">
              <div class="fallback">
                <input type="file" v-bind="{'multiple': dropzone.params.uploadMultiple}" :name="name">
              </div>
              <v-container fluid grid-list-lg>
                <v-layout row wrap class="dropzone-preview-container---disabled">
                  <slot name="message">
                    <v-flex sm12>
                      <div class="dz-message text-xs-center grey--text text--darken-1" data-dz-message>
                        <div><v-icon class="display-4" v-html="dropzone.params.dictDefaultIcon"></v-icon></div>
                        <span v-html="dropzone.params.dictDefaultMessage"></span>
                      </div>
                    </v-flex>
                  </slot>
                </v-layout>
              </v-container>
            </div>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>

    <div class="dropzone-preview-container"></div>

    <div class="dropzone-preview-template">
      <slot name="preview">
        <v-flex xs12 sm6 md4 lg3>
          <v-card tile class="card--thumbnail elevation-1 ma-2">
            <v-card-media data-dz-thumbnail contain class="accent" :height="dropzone.params.thumbnailHeight">
              <img data-dz-thumbnail :width="dropzone.params.thumbnailWidth" :height="dropzone.params.thumbnailHeight">
            </v-card-media>
            <v-card-text>
              <v-text-field
                loading
                label="File Name"
              ></v-text-field>
            </v-card-text>
            <v-card-actions>
              <div class="dz-size" data-dz-size></div>
            </v-card-actions>

            <div class="dz-success-mark">
              <v-icon class="display-4 success--text">check</v-icon>
            </div>
            <div class="dz-progress"><div class="dz-upload primary" data-dz-uploadprogress></div></div>
          </v-card>
        </v-flex>
      </slot>
    </div>
  </v-card>
</template>

<script>
import Dropzone from 'dropzone'

export default {
  model: {
    prop: 'files'
  },
  props: {
    name: { type: String, default: 'file' },
    accept: { type: String, default: 'image/jpeg,image/png,image/gif' },
    params: { type: Object, default: () => { return {} } },
    categories: { type: Array, default: () => { return [] } }
  },
  data () {
    return {
      dropzone: {
        instance: null,
        params: {
          acceptedFiles: this.accept,
          addRemoveLinks: false,
          autoProcessQueue: false,
          createImageThumbnails: true,
          dictUploadButtonLabel: 'Start',
          dictUploadButtonIcon: 'file_upload',
          dictDefaultIcon: 'cloud_upload',
          dictDefaultMessage: 'Drag files or click to browse',
          height: '400px',
          parallelUploads: 2,
          paramName: 'file',
          params: {},
          previewsContainer: '.dropzone-preview-container',
          previewTemplate: null,
          thumbnailHeight: '200',
          thumbnailWidth: '200',
          uploadMultiple: true,
          url: '/'
        }
      },
      files: [],
      resources: {
        items: []
      }
    }
  },
  methods: {
    mountDropzone () {
      Dropzone.autoDiscover = false
      this.dropzone.params = Object.assign(this.dropzone.params, this.params, {params: this.params})

      let $previewTemplate = document.querySelector('.dropzone-preview-template')
      this.dropzone.params.previewTemplate = $previewTemplate.innerHTML
      $previewTemplate.remove()

      // Start
      this.dropzone.instance = new Dropzone(this.$refs['dropzone-box'], this.dropzone.params)
    },
    listenDropzone () {
      let self = this

      this.dropzone.instance.on('addedfile', function (file) {
        // let preview = file.previewElement
        // preview.querySelector('[data-dz-type]') ? preview.querySelector('[data-dz-type]').innerHTML = file.type : ''
        // preview.querySelector('[data-dz-status]') ? preview.querySelector('[data-dz-status]').innerHTML = file.status : ''

        // if (this.dropzone.params.parallelUploads && this.dropzone.params.parallelUploads === '-1') {
        // this.dropzone.params.parallelUploads = this.files.length
        // }

        self.$emit('addedfile', { file, dropzone: self.dropzone.instance, params: self.dropzone.params })
      })

      this.dropzone.instance.on('thumbnail', function (file, dataURL) {
        let preview = file.previewElement
        let url = dataURL

        preview.querySelector('[data-dz-thumbnail]').setAttribute('src', url)

        self.files.push(file)
        self.$emit('thumbnail', file, dataURL)
      })
    }
  },
  mounted () {
    this.mountDropzone()
    this.listenDropzone()
  }
}
</script>

<style lang="stylus">
@import "~dropzone/dist/dropzone.css";

.grey {
  &--transparentize {
    background-color: rgba(0,0,0,0.08);
  }
}

// Dropzone
.dropzone {
  border: 1px dashed rgba(0,0,0,0.1);
  padding: 3rem;
}
</style>
