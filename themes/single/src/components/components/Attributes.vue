<template>
  <v-card>
    <v-toolbar card>
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <!-- Template -->
      <template v-if="templatable">
        <v-select clearable autocomplete :name="templateName" :item-value="templateValue" :item-text="templateText" :label="templateLabel" v-model="template.selected" :items="template.items">
          <template slot="selection" slot-scope="data">
            <v-chip
              :key="JSON.stringify(data.item)"
              :selected="data.selected"
              @input="data.parent.selectItem(data.item)"
              class="chip--select-multi"
              color="accent"
              label
            >
              <v-icon left v-if="data.item.icon" v-html="data.item.icon"></v-icon>
              {{ data.item[templateText] }}
            </v-chip>
          </template>
          <template slot="item" slot-scope="data">
            <v-list-tile-avatar v-if="data.item.icon">
              <v-icon v-html="data.item.icon"></v-icon>
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title v-html="data.item[templateText]"></v-list-tile-title>
            </v-list-tile-content>
          </template>
        </v-select>
      </template>
      <!-- Template -->

      <!-- Tags -->
      <template v-if="taggable">
        <v-select tags multiple cache-items clearable autocomplete :name="tagName" :label="tagLabel" v-model="tags.selected" :items="tags.items" hint="You may directly create new tags." persistent-hint>
          <template slot="selection" slot-scope="data">
            <v-chip
              close
              @input="data.parent.selectItem(data.item)"
              :selected="data.selected"
              class="chip--select-multi"
              :key="JSON.stringify(data.item)"
              color="accent"
              label
            >
              {{ data.item }}
            </v-chip>
          </template>
          <template slot="item" slot-scope="data">
            <v-list-tile-content>
              <v-list-tile-title v-html="data.item"></v-list-tile-title>
            </v-list-tile-content>
          </template>
        </v-select>
      </template>
      <!-- Tags -->
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'Attributes',
  model: {
    prop: 'selected'
  },
  props: {
    categorable: { default: true },
    icon: { default: 'chrome_reader_mode' },
    selected: null,
    taggable: { default: true },
    tagItems: { default: () => { return [] } },
    tagLabel: { default: 'Tags' },
    tagName: { default: 'tags[]' },
    templatable: { default: true },
    templateItems: { default: () => { return [] } },
    templateLabel: { default: 'Page Template' },
    templateName: { default: 'template' },
    templateText: { default: 'name' },
    templateValue: { default: 'value' },
    title: { default: 'Page Attribute' },
    url: {}
  },
  data () {
    return {
      template: {
        selected: this.selected,
        items: []
      },
      tags: {
        selected: [],
        items: []
      }
    }
  },
  watch: {
    'tags.selected': function (val) {
      this.selected.tags = val
      this.$emit('input', this.selected)
    },
    'template.selected': function (val) {
      this.selected.template = val
      this.$emit('input', this.selected)
    },
    'templateItems': function (val) {
      this.template.items = val
    },
    'tagItems': function (val) {
      this.tags.items = val
    }
  },
  mounted () {
    //
  }
}
</script>
