<template>
  <v-container fluid>
    <v-layout row wrap fill-height>
      <v-card flat tile height="100%" class="card--bordered">
        <v-card-title class="headline">Choose Template</v-card-title>
        <v-card-text>
          <p class="subheading" v-for="(template, i) in templates.items">
            <a role=button @click="templates.model = ! templates.model" v-html="template.name"></a>
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
    prop: 'toggle'
  },
  props: {
    toggle: { type: Boolean, default: false }
  },
  data () {
    return {
      templates: {
        model: true,
        items: [
          { name:'Home Page', code: 'home', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name:'Blog Page', code: 'blog', supports: ['editor', 'title', 'featured', 'cover', 'sections'] },
          { name:'Generic Page', code: 'generic', supports: ['editor', 'title', 'featured', 'cover', 'sections'] }
        ]
      }
    }
  },
  watch: {
    'templates.model': function (value) {
      this.$emit('input', value)
    }
  }
}
</script>
