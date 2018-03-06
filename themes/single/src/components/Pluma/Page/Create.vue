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
          <v-flex xs12 sm8 md9>
            <input type="hidden" name="_token" :value="resource.token">

            <div class="mb-5">
              <v-text-field
                :error-messages="errors.collect('title')"
                @input="slugify"
                label="Title"
                name="title"
                solo
                v-model="resource.item.title"
                v-validate="'required'"
              ></v-text-field>
              <small class="caption error--text mt-1" v-if="errors.has('title')" v-html="errors.first('title')"></small>
            </div>

            <v-card>
              <v-card-text>
                <v-text-field
                  :append-icon-cb="() => {resource.lock.code = !resource.lock.code}"
                  :append-icon="resource.lock.code ? 'lock' : 'lock_open'"
                  :error-messages="errors.collect('code')"
                  @blur="resource.lock.code = true"
                  @focus="resource.lock.code = false"
                  label="Slug Code"
                  name="code"
                  persistent-hint
                  v-bind="{'hint': 'This will be used as the slug for generating URLs. ' + (resource.lock.code ? 'Auto-suggestion mode is turned OFF' : 'Auto-suggestion mode is turned ON')}"
                  v-model="resource.item.code"
                  v-validate="'required'"
                ></v-text-field>
              </v-card-text>

              <editor name="body" v-model="resource.item.body"></editor>

            </v-card>
          </v-flex>
          <v-flex xs12 sm4 md3>

            <v-card>
              <attributes
                :tag-items="resource.tags.items"
                :template-items="resource.template.items"
                class="elevation-0"
                title="Page Attributes"
                v-model="resource.item.attributes"
              ></attributes>
              <v-divider></v-divider>
              <mediabox
                :menu-items="resource.library.categories.items"
                :url="{'all': '/api/v1/library/all', 'search': '/api/v1/library/search'}"
                class="elevation-0"
                icon="image"
                item-text="name"
                item-value="thumbnail"
                name="feature"
                title="Featured Image"
                v-model="resource.item.feature"
              >
                <template slot="menus" slot-scope="{props}">
                  <v-subheader>Catalogue</v-subheader>
                  <v-list-tile v-model="menu.model" :key="i" v-for="(menu, i) in props.menus" @click="props.toggle(menu, menu.url)">
                    <v-list-tile-action>
                      <v-icon>{{ menu.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ menu.name }}</v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                      <v-chip>{{ menu.count }}</v-chip>
                    </v-list-tile-action>
                  </v-list-tile>
                  <div class="text-xs-center"><small class="grey--text">Powered by Mediabox v3.0.0</small></div>
                </template>
              </mediabox>
              <v-divider></v-divider>
              <mediabox name="cover" class="elevation-0" :url="{'all': '/api/v1/library/all', 'search': '/api/v1/library/search'}" v-model="resource.item.cover" icon="landscape" item-value="thumbnail" item-text="name" title="Cover Photo"></mediabox>
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
import AlertIcon from '@/components/partials/AlertIcon.vue'

export default {
  name: 'Create',
  components: { Mediabox, Editor, Attributes, AlertIcon },
  data () {
    return {
      resource: {
        item: {
          body: '',
          code: '',
          delta: '',
          feature: null,
          attributes: {
            template: '',
            tags: []
          },
          title: ''
        },
        lock: {
          code: false
        },
        token: this.$token,
        errors: [],
        form: { model: true },
        template: { items: [] },
        tags: { items: [] },
        library: { categories: { items: [] } }
      }
    }
  },
  methods: {
    mountAttributes () {
      this.$http.post('/api/v1/pages/templates')
        .then(response => {
          this.resource.template.items = response.data
        })

      this.$http.post('/api/v1/pages/tags')
        .then(response => {
          this.resource.tags.items = response.data
        })

      this.$http.post('/api/v1/library/catalogues')
        .then(response => {
          this.resource.library.categories.items = response.data
        })
    },
    save (resource) {
      this.$http.post('/api/v1/pages/save', resource)
        .then(response => {
          let self = this
          switch (response.status) {
            case 200:
            default:
              this.$root.alert({color: 'secondary', type: 'success', text: `${resource.title} page successfully saved.`})
              setTimeout(function () {
                self.$router.push({name: 'pages.index'})
              }, 900)
              break
          }
        })
        .catch(error => {
          switch (error.response.status) {
            case 422:
              for (var key in error.response.data) {
                this.errors.add(key, error.response.data[key].join('\n'), 'server')
              }
              this.$root.alert({color: 'secondary', type: 'warning', text: `Please check fields for errors.`})
              break

            default:
              this.$root.alert({color: 'secondary', type: 'error', text: `Oops! something went wrong.`})
              break
          }
        })
    },
    slugify ($value) {
      if (!this.resource.lock.code) {
        if (typeof $value === 'undefined') {
          this.resource.item.code = this.$options.filters.slugify(this.resource.item.title)
        } else {
          this.resource.item.code = this.$options.filters.slugify($value)
        }
      }
    }
  },
  mounted () {
    this.mountAttributes()
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
