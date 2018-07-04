<template>
  <v-container fluid grid-list-lg>
    <v-data-iterator
      :items="templates.items"
      :loading="templates.loading"
      :pagination.sync="templates.pagination"
      :rows-per-page-items="templates.pagination.rowsPerPageItems"
      :rows-per-page-text="templates.pagination.rowsPerPageText"
      :search="templates.search.query"
      :total-items="templates.pagination.totalItems"
      content-tag="v-layout"
      row wrap fill-height
      select-all="accent"
      v-model="selected"
      >
      <v-layout row wrap slot="header">
        <v-flex tag="h1" v-html="trans('Choose Template')"></v-flex>
      </v-layout>

      <v-flex
        slot="item"
        slot-scope="props"
        >
        <v-card ripple hover height="100%" @click.native="select(props.item)">
          <v-card-media v-if="props.item.banner" height="200px" :src="props.item.banner"></v-card-media>
          <v-progress-linear
            v-else
            color="primary"
            height="2"
            value="100"
          ></v-progress-linear>
          <v-card-title>
            <h3 class="subheading d-block" v-html="props.item.name"></h3>
          </v-card-title>
          <v-card-text v-html="props.item.description"></v-card-text>
        </v-card>
      </v-flex>
    </v-data-iterator>
  </v-container>
</template>

<script>
export default {
  name: 'ChooseTemplate',
  model: {
    prop: 'template'
  },
  props: {
    template: { type: Object, default: () => { return {} } }
  },
  data () {
    return {
      templates: {
        loading: true,
        model: true,
        search: { query: '' },
        selected: [],
        items: [
          { name: 'Home Page', code: 'CreateHomePage', description: 'Create a Landing Page for your site.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name: 'Blog Page', code: 'blog', description: 'Inherits the blog layout of your active theme.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name: 'Generic Page', code: 'generic', description: 'Just another default layout template.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] }
        ],
        pagination: {
          rowsPerPageItems: [12, 24, 30, {'text': this.$root.trans('All'), 'value': -1}],
          rowsPerPageText: this.$root.trans('Items per page:'),
          totalItems: 0
        }
      }
    }
  },
  methods: {
    select (template) {
      this.$emit('input', template)
    }
  }
}
</script>
