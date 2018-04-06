<template>
  <v-card class="card--sectioned">
    <draggable v-model="sections.items" :options="{ animation: 150, handle: '.draggable-handle', group: 'section-group', draggable: '.draggable-item', forceFallback: true }">

      <v-card tile v-for="(section, i) in sections.items" :key="i" class="mb-2 draggable-item">
        <v-toolbar card dense class="transparent draggable-handle">
          <v-icon small>drag_handle</v-icon>
          <v-spacer></v-spacer>
          <v-toolbar-title class="subheading" v-html="section.title"></v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
      </v-card>

    </draggable>
  </v-card>
</template>

<script>
import Draggable from 'vuedraggable'

export default {
  name: 'Section',
  components: { Draggable },
  data () {
    return {
      sections: {
        items: [],
        model: true
      }
    }
  }
}
</script>
