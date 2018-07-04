<template>
  <div>
    <v-toolbar class="elevation-2 sticky">
      <v-btn icon exact :to="{name: 'pages.index'}"><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title>{{ trans('Create Page') }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn :loading="resource.saving" ripple color="primary" @click="save(resource.item)">Save</v-btn>

      <v-menu left>
        <v-btn slot="activator" icon><v-icon>more_vert</v-icon></v-btn>
        <v-list dense>
          <v-list-tile @click="draft" v-shortkey="['ctrl', 'shift', 'p']" @shortkey="draft">
            <v-list-tile-action><v-icon>save</v-icon></v-list-tile-action>
            <v-list-tile-content>{{ trans('Save as draft') }}</v-list-tile-content>
          </v-list-tile>
          <v-divider></v-divider>
          <v-list-tile @click="reset" v-shortkey="['alt', 'r']" @shortkey="reset">
            <v-list-tile-action><v-icon>refresh</v-icon></v-list-tile-action>
            <v-list-tile-content>{{ trans('Delete and reset fields values') }}</v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex xs12 sm8 md9>
            <input type="hidden" name="_token" :value="resource.token">

            <v-card>
              <v-card-text>
                <v-text-field
                  :error-messages="errors.collect('title')"
                  :label="trans('Title')"
                  @input="slugify"
                  name="title"
                  v-focus
                  v-model="resource.item.title"
                  v-title
                  v-validate="'required'"
                ></v-text-field>
                <v-text-field
                :append-icon-cb="() => {resource.lock.code = !resource.lock.code}"
                :append-icon="resource.lock.code ? 'lock' : 'lock_open'"
                :error-messages="errors.collect('code')"
                @blur="resource.lock.code = true"
                @focus="resource.lock.code = false"
                name="code"
                persistent-hint
                prefix="app-url://"
                v-bind="{'hint': 'This will be used as the slug for generating URLs. ' + (resource.lock.code ? 'Auto-suggestion mode is turned OFF' : 'Auto-suggestion mode is turned ON')}"
                v-model="resource.item.code"
                v-validate="'required'"
                ></v-text-field>
              </v-card-text>

              <editor name="body" v-model="resource.item.body"></editor>

            </v-card>
          </v-flex>
          <v-flex xs12 sm4 md3>

            <template v-for="(mediabox, i) in mediaboxes.items">
              <v-card flat class="mb-3">
                <mediabox
                  :icon="mediabox.icon"
                  :menu-items="[{ name: 'Feature', title: 'Featured Image', icon: 'image' }]"
                  :name="mediabox.name"
                  :title="mediabox.title"
                  :url="{'all': '/api/v1/library/all', 'search': '/api/v1/library/search'}"
                  class="elevation-0"
                  item-text="name"
                  item-value="thumbnail"
                  hide-toolbar
                  v-model="resource.item[mediabox.name]">
                  <template slot="menus" slot-scope="{props}">
                    <v-subheader v-html="trans('Catalogue')"></v-subheader>
                    <v-list-tile v-model="menu.model" :key="i" v-for="(menu, i) in props.menus" @click="props.toggle(menu, menu.url)">
                      <v-list-tile-action>
                        <v-icon>{{ menu.icon }}</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>{{ menu.name }}</v-list-tile-title>
                      </v-list-tile-content>
                      <v-list-tile-action>{{ menu.count }}</v-list-tile-action>
                    </v-list-tile>
                    <div class="text-xs-center"><small class="grey--text" v-html="trans('Powered by Mediabox v3.0.0')"></small></div>
                  </template>
                </mediabox>
              </v-card>
            </template>
            <attributes
              :tag-items="resource.tags.items"
              :template-items="resource.template.items"
              :title="trans('Page Attributes')"
              class="mb-3"
              v-model="resource.item.attributes"
              >
            </attributes>

          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'Create',
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
        library: { categories: { items: [] } },
        saving: false
      },
      mediaboxes: {
        items: [
          { name: 'feature', title: 'Featured Image', icon: 'image' },
          { name: 'cover', title: 'Cover Photo', icon: 'landscape' }
        ]
      }
    }
  },
  methods: {
    draft () {
      alert("That's the command for saving to draft")
    },

    reset () {
      this.$refs['form'].reset()
      this.$validator.reset()
      this.resource.form.loading = false
      this.toast({text: 'Form was reset', buttonIcon: 'close'})
    },

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
      this.resource.saving = true
      this.$http.post('/api/v1/pages/save', resource)
        .then(response => {
          let self = this
          switch (response.status) {
            case 200:
            default:
              this.$root.alert({type: 'success', text: `${resource.title} page successfully saved.`})
              this.resource.saving = false
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
              this.$root.alert({type: 'error', color: 'error', text: `Please check fields for errors.`})
              break

            default:
              this.$root.alert({type: 'error', color: 'error', text: `Oops! ${error.response.data.join('\n')}.`})
              break
          }

          this.resource.saving = false
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
