<template>
  <v-card>
    <v-card-text class="grey--transparentize">
      <v-btn @click="files.push({fileName: 'new file', progress: 0, fileSize: '400KB'})">Test</v-btn>

      <!-- Progress Indicator -->
      <v-card
        :key="i"
        v-for="(f, i) in files"
        class="mb-2"
      >
        <v-container fluid grid-list-lg>
          <v-layout row wrap>
            <v-flex xs5>
              <v-card-media
                src="//source.unsplash.com/300x300?nature"
                height="125px"
                contain
              ></v-card-media>
            </v-flex>
            <v-flex xs7>
              <v-text-field
                :append-icon-cb="() => { files.splice(i, 1) }"
                :hint="f.fileSize"
                hide-details
                append-icon="close"
                label="File Name"
                loading
                persistent-hint
                v-model="f.fileName"
              >
                <v-progress-linear v-show="true" slot="progress" :value="f.progress"></v-progress-linear>
              </v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card>
      <!-- Progress Indicator -->
    </v-card-text>
    <v-card-actions></v-card-actions>
  </v-card>
</template>

<script>
export default {
  model: {
    prop: 'files'
  },
  props: {
    accept: { type: String, default: '*' }
  },
  data () {
    return {
      resources: {
        items: []
      },
      files: []
    }
  }
}
</script>

<style lang="stylus">
  .grey {
    &--transparentize {
      background-color: rgba(0,0,0,0.08);
    }
  }
</style>
