<template>
  <div>
    <v-toolbar light color="white" class="elevation-1 sticky">
      <v-toolbar-title class="grey--text text--darken-1">Create Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn ripple color="primary" @click="save(resource.item)">Save</v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex xs12 sm8>
            <input type="hidden" name="_token" :value="resource.token">

            <div class="mb-3">
              <v-text-field
                :error-messages="errors.collect('title')"
                label="Title"
                name="title"
                solo
                v-model="resource.item.title"
                v-validate="'required'"
                @input="resource.item.code = $options.filters.slugify(resource.item.title)"
              ></v-text-field>
              <p class="caption error--text mt-1" v-if="errors.has('title')" v-html="errors.first('title')"></p>
            </div>

            <v-card>
              <v-card-text>
                <v-text-field
                  :append-icon-cb="() => {resource.lock.code = !resource.lock.code}"
                  :append-icon="resource.lock.code ? 'lock' : 'lock_open'"
                  :error-messages="errors.collect('code')"
                  label="Code"
                  name="code"
                  v-bind="{'readonly': resource.lock.code}"
                  v-model="resource.item.code"
                  v-validate="'required'"
                ></v-text-field>
              </v-card-text>

              <editor name="body" v-model="resource.item.body"></editor>

            </v-card>
          </v-flex>
          <v-flex xs12 sm4>

            <v-card>
              <attributes class="elevation-0" v-model="resource.item.template"></attributes>
              <v-divider></v-divider>
              <mediabox name="feature" class="elevation-0" multiple v-model="resource.item.feature" icon="image" title="Featured Image"></mediabox>
              <span v-html="resource.item.feature"></span>
              <v-divider></v-divider>
              <mediabox class="elevation-0" icon="landscape" title="Cover Photo"></mediabox>
            </v-card>

          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </div>
</template>

<script>
import Mediabox from '@/components/components/Mediabox.vue'
import Editor from '@/components/components/Editor.vue'
import Attributes from '@/components/components/Attributes.vue'

export default {
  name: 'Create',
  components: { Mediabox, Editor, Attributes },
  data () {
    return {
      resource: {
        item: {
          body: '',
          code: '',
          delta: '',
          feature: null,
          template: '',
          title: '',
          user_id: ''
        },
        lock: {
          code: true
        },
        token: this.$token,
        errors: [],
        form: { model: true }
      }
    }
  },
  methods: {
    save (resource) {
      this.$http.post('/api/v1/pages/save', resource)
        .then(response => {
          let self = this

          switch (response.status) {
            case 200:
            default:
              setTimeout(function () {
                self.$router.push({name: 'pages.index'})
              }, 900)
              break
          }
        })
        .catch(error => {
          switch (error.response.status) {
            case 422:
            default:
              for (var key in error.response.data) {
                this.errors.add(key, error.response.data[key].join('\n'), 'server')
              }
              break
          }
        })
    }
  },
  mounted () {
    //
  }
}
</script>

<style>
  /*DITO MUNA TO HA Pero lipat to sa global pag-kwan ;)*/
.sticky {
  position: -webkit-sticky;
  position:sticky;
  top:0;
  z-index:4;
}
</style>
