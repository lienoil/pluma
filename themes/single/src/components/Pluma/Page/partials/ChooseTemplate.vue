<template>
  <v-container fluid>
    <v-layout row wrap fill-height>
      <v-card flat tile height="100%" class="card--bordered">
        <v-toolbar flat light card color="white">
          <v-toolbar-title>Choose Template</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
          <p class="subheading mb-1" v-for="(template, i) in templates.items">
            <a role="button" @click="select(template)" v-html="template.name"></a>
          </p>
        </v-card-text>
      </v-card>
    </v-layout>
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
        model: true,
        items: [
          { name: 'Home Page', code: 'home', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name: 'Blog Page', code: 'blog', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name: 'Generic Page', code: 'generic', supports: ['editor', 'title', 'featured', 'cover', 'sections'] }
        ]
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
