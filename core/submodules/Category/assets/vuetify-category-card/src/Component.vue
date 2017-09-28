<template>
  <v-card class="category elevation-1">
    <v-toolbar card class="transparent">
      <v-toolbar-title class="subheading">
        <v-icon class="accent--text" left v-html="icon"></v-icon>
        <span class="accent--text" v-html="label"></span>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn v-if="search" @click.stop="searchform.model = !searchform.model" icon><v-icon>search</v-icon></v-btn>
    </v-toolbar>

    <v-slide-y-transition v-if="search">
      <v-card-actions v-show="searchform.model">
        <v-text-field
          solo
          v-model="searchform.query"
          append-icon="search" hide-details single-line></v-text-field>
      </v-card-actions>
    </v-slide-y-transition>

    <v-card-text class="mb-1 content--scrollable content--bordered">
      <template v-if="multiple">
        <checkbox v-model="selected" :list="list"></checkbox>
      </template>
      <template v-else>
        <radio v-model="selected" :list="list" :label="radioLabel"></radio>
      </template>
    </v-card-text>

    <v-card-actions>
      <slot :item="selected">
        <input type="hidden" :name="`${name}_string`" :value="JSON.stringify(selected)">
        <input type="hidden" :name="name" :value="selected">
      </slot>
    </v-card-actions>
  </v-card>
</template>

<script>
  import Radio from './Radio.vue'
  import Checkbox from './Checkbox.vue'

  export default {
    name: 'v-category',
    components: {
      Radio,
      Checkbox
    },
    model: {
      prop: 'content'
    },
    props: {
      content: null,
      multiple: { type: Boolean, default: true },
      radioLabel: { type: String, default: 'None' },
      name: { type: String, default: 'category' },
      icon: { type: String, default: 'fa-leaf' },
      search: { type: Boolean, default: false },
      label: { type: String, default: 'Category' },
      list: { type: Array, default: () => { return [] } },
    },
    data () {
      return {
        selected: null,
        searchform: {
          model: false,
          searchables: []
        },
        dataset: {
          items: []
        },
      }
    },
    methods: {
      //
    },
    mounted () {
      this.selected = this.content
      this.dataset.items = this.list
    },
    watch: {
      'list': function (value) {
        this.dataset.items = value
      },
      'searchform.query': function (value) {
        this.$emit('search', value, this.list)
      },
      'content': function (value) {
        this.selected = value
      },
      'selected': function (value) {
        this.$emit('input', value)
      }
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    &--scrollable {
      max-height: 200px;
      overflow-y:auto;
    }

    &--bordered {
      border-top: 1px solid rgba(0,0,0,0.05);
      border-bottom: 1px solid rgba(0,0,0,0.05)
    }
  }
</style>
