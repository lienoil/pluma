<template v-cloak>
  <section>
    <toolbar-menu></toolbar-menu>

    <v-container fluid grid-list-lg>
      <v-layout row wrap justify-end>
        <v-flex md9 xs12>
          <v-card>
            <v-card-title>
              {{ trans('Lorem ipsum dolor') }}
            </v-card-title>
            <v-card-text>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto cum aliquid veritatis, ab qui numquam accusantium nobis. Fugiat, quam atque, magni minus doloremque accusamus in, dolorum earum iure laudantium perspiciatis.
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs12 md3>
          <template v-for="(mediabox, i) in mediaboxes.items">
            <v-card class="mb-3">
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
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
import store from '@/store'

export default {
  store,

  components: {},

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
          { name: 'cover', title: 'Cover Image', icon: 'add' },
        ]
      }
    }
  },
}
</script>
