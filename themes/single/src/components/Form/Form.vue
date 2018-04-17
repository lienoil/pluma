<template>
  <v-container fluid fill-height grid-list-xs>
    <v-layout row wrap>

      <v-flex sm6>
        <v-card>
          <v-card-text>
            <draggable
              :options="{
                animation: 150,
                handle: '.draggable-handle',
                group: 'fields-group',
                draggable: '.draggable-item',
                forceFallback: true,
                clone: true
              }"
              class="canvas grey lighten-4"
              v-model="resource.forms"
            >
              <div v-for="element in myArray" :key="element.id">{{element.name}}</div>
            </draggable>
            <short-answer></short-answer>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex sm6>
        <v-card>
          <v-card-text>
            <draggable
              :options="{
                animation: 150,
                handle: '.draggable-handle',
                group: 'fields-group',
                draggable: '.draggable-item',
                forceFallback: true,
                sort: false,
                clone: true
              }"
              clone
              class="canvas grey lighten-4"
            >
              <v-card :dark="theme.dark" :light="!theme.dark" v-for="(selection, i) in resource.selections" :key="i" class="draggable-item">
                <v-toolbar card :dark="theme.dark" :light="!theme.dark">
                  <v-icon v-html="selection.icon"></v-icon>
                  <v-toolbar-title v-html="selection.text"></v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-icon class="draggable-handle">drag_handle</v-icon>
                </v-toolbar>
              </v-card>
            </draggable>
          </v-card-text>
        </v-card>
      </v-flex>

    </v-layout>
  </v-container>
</template>

<script>
import draggable from 'vuedraggable'
import ShortAnswer from './components/ShortAnswer'

export default {
  name: 'FormBuilder',
  components: {
    draggable,
    ShortAnswer
  },
  data () {
    return {
      resource: {
        forms: [],
        selections: [
          { name: 'header', icon: 'title', text: 'Header', component: import('./components/ShortAnswer') },
          { name: 'short-answer', icon: 'short_text', text: 'Short Answer', component: import('./components/ShortAnswer') }
        ]
      }
    }
  }
}
</script>

<style scoped lang="stylus">
.canvas {
  min-height: 180px;
}
</style>
