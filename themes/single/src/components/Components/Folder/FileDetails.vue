<template>
  <v-card flat color="transparent" class="file-details" height="100%">
    <v-container fluid v-if="metadata">
      <v-card flat class="mb-3" color="transparent">
        <v-layout row wrap align-center justify-center>
          <v-flex xs12 align-center justify-center>
            <img width="100%" height="auto" :src="metadata.thumbnail" :alt="metadata.name">
            <div>
              <v-icon v-if="metadata.icon" left small>{{ metadata.icon }}</v-icon>
              <strong>{{ metadata.name }}</strong></div>
            <div v-if="metadata.description" class="text--disabled"><small>{{ trans(metadata.description) }}</small></div>
          </v-flex>
        </v-layout>
      </v-card>
      <v-layout row wrap>
        <v-flex xs4>
          <small class="text--disabled">{{ trans('File name') }}</small>
        </v-flex>
        <v-flex xs8>
          <small>{{ trans(metadata.filename) }}</small>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs4>
          <small class="text--disabled">{{ trans('Type') }}</small>
        </v-flex>
        <v-flex xs8>
          <small>{{ trans(metadata.mimetype) }}</small>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs4>
          <small class="text--disabled">{{ trans('Size') }}</small>
        </v-flex>
        <v-flex xs8>
          <small>{{ trans(metadata.filesize) }}</small>
        </v-flex>
      </v-layout>
      <v-layout row wrap>
        <v-flex xs4>
          <small class="text--disabled">{{ trans('Created') }}</small>
        </v-flex>
        <v-flex xs8>
          <small>{{ trans(metadata.created) }}</small>
        </v-flex>
      </v-layout>
    </v-container>

    <v-container fluid align-start justify-center v-else>
      <v-flex xs12 fill-height align-start justify-center class="text-xs-center">
        <open-book-icon class="file-details__icon" width="6em" height="6em" :icon-color="color"></open-book-icon>
        <div class="text--disabled">{{ trans('Select a file or folder to view its details.') }}</div>
      </v-flex>
    </v-container>
  </v-card>
</template>

<script>
export default {
  name: 'FileDetails',

  model: {
    prop: 'metadata',
  },

  props: {
    metadata: {
      type: [Object, Boolean],
      default: null
    }
  },

  computed: {
    color () {
      return this.$vuetify.theme.primary
    }
  }
}
</script>

<style lang="stylus">
.file-details {
  border-left: 1px solid rgba(0,0,0,0.3);

  &__icon {
    filter: grayscale(0.8);
  }
}
</style>
