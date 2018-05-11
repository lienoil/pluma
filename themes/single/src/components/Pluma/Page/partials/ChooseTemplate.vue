<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex tag="h1" v-html="trans('Choose a template')"></v-flex>
    </v-layout>
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
      <v-flex
        slot="item"
        slot-scope="props"
        >
        <v-card light ripple hover height="100%" @click.native="select(props.item)">
          <v-card-media height="200px" :src="props.item.banner"></v-card-media>
          <v-card-title>
            <h3 class="subheading page-title d-block" v-html="props.item.name"></h3>
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
          { banner: '//source.unsplash.com/400x600?nature', name: 'Home Page', code: 'CreateHomePage', description: 'Lorem ipsum dolor sit amet.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { banner: '//source.unsplash.com/400x600?space', name: 'Blog Page', code: 'blog', description: 'Lorem ipsum dolor sit am.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { banner: '//source.unsplash.com/400x600?people', name: 'Generic Page', code: 'generic', description: 'Lorem ipsum dolor sit amet.', supports: ['editor', 'title', 'featured', 'cover', 'sections'] }
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
