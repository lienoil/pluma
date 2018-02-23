<template>
  <v-card>
    <v-toolbar card class="transparent">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2 grey--text text--darken-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <v-select clearable autocomplete solo :name="name" label="Page Template" v-model="templates.selected" :items="templates.items">
        <template slot="selection" slot-scope="data">
          <v-chip
            :key="JSON.stringify(data.item)"
            :selected="data.selected"
            @input="data.parent.selectItem(data.item)"
            class="chip--select-multi"
            close
            v-model="data.item"
          >
            <v-icon left v-html="data.item.icon"></v-icon>
            {{ data.item.name }}
          </v-chip>
        </template>
        <template slot="item" slot-scope="data">
          <v-list-tile-avatar v-if="data.item.icon">
            <v-icon v-html="data.item.icon"></v-icon>
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
          </v-list-tile-content>
        </template>
      </v-select>
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
    name: 'template',
    icon: { default: 'chrome_reader_mode' },
    title: { default: 'Page Attribute' },
    multiple: { default: false },
    url: {},
    selected: null
  },
  data () {
    return {
      templates: {
        selected: this.selected,
        items: [
          { id: 1, icon: 'home', name: 'Home Template' },
          { id: 2, icon: 'insert_drive_file', name: 'Generic Template' }
        ]
      }
    }
  }
}
</script>
