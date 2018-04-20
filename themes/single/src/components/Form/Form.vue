<template>
  <v-container fluid fill-height grid-list-xs>
    <v-layout row wrap>

      <v-flex sm6 offset-sm3>
        <v-card>
          <v-card-text class="grey lighten-4">
            <draggable
              :options="{
                animation: 150,
                handle: '.draggable-handle',
                group: 'fields-group',
                draggable: '.draggable-item',
                forceFallback: true,
                clone: true
              }"
              class="canvas"
              v-model="resource.forms"
            >
              <v-card v-for="form in resource.forms" :key="form.id" class="mb-3 draggable-item">
                <v-toolbar card>
                  <span class="draggable-handle"><v-icon>drag_handle</v-icon></span>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                  <v-container fluid grid-list-sm>
                    <v-layout row align-center>
                      <v-flex sm7>
                        <v-text-field class="headline" label="Question"></v-text-field>
                      </v-flex>
                      <v-flex sm5>
                        <v-select solo :items="['Po', 'sPo', 'WPo']"></v-select>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn icon><v-icon>content_copy</v-icon></v-btn>
                  <v-btn icon><v-icon>delete</v-icon></v-btn>
                  <hr class="vertical-divider">
                  <v-switch
                    hide-details
                    label="Required"
                    v-model="form.model"
                  ></v-switch>
                </v-card-actions>
              </v-card>
            </draggable>
            <!-- <short-answer></short-answer> -->
            <v-btn icon @click="addfield()"><v-icon>add</v-icon></v-btn>
          </v-card-text>
        </v-card>
      </v-flex>
      <!-- <v-flex sm6>
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
      </v-flex> -->

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
  },
  methods: {
    addfield () {
      this.resource.forms.push({
        id: null,
        name: 'header',
        text: 'Header'
      })
    }
  }
}
</script>

<style scoped lang="stylus">
.canvas {
  min-height: 180px;
}
</style>
