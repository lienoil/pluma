<template>
  <div>
    <v-toolbar light color="white" class="elevation-1 sticky">
      <v-toolbar-title class="grey--text text--darken-1">Edit Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu>
        <v-btn slot="activator" icon small><v-icon small>settings</v-icon></v-btn>
        <v-list>
          <v-list-tile @click="">
            <v-list-tile-action>
              <v-icon>drafts</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Save as Draft</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-btn :loading="resource.saving" ripple color="primary" @click="save(resource.item)">Save</v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex xs12 sm8 md9>

            <v-text-field solo v-model="resource.item.title" label="Title" class="mb-3"></v-text-field>

            <!-- Course -->
            <v-card>
              <v-toolbar card class="transparent">
                <v-icon left color="teal">class</v-icon>
                <v-toolbar-title class="subheading teal--text">Lesson</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-menu>
                  <v-btn slot="activator" icon small><v-icon small>settings</v-icon></v-btn>
                  <v-list>
                    <v-list-tile @click="">
                      <v-list-tile-action>
                        <v-icon>fullscreen</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>Toggle Fullscreen</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </v-toolbar>
              <v-card-text class="grey lighten-4">

                <v-card tile v-for="(lesson, i) in resource.lessons" :key="i" class="mb-3">
                  <v-progress-linear height="2" color="teal" class="ma-0"></v-progress-linear>
                  <v-toolbar card dense class="transparent">
                    <v-icon small class="draggable-handle">drag_handle</v-icon>
                    <v-spacer></v-spacer>
                    <v-toolbar-title class="subheading" v-html="lesson.title"></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn small icon @click="lesson.model = !lesson.model"><v-icon small>{{ lesson.model ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon></v-btn>
                    <v-menu left>
                      <v-btn slot="activator" small icon><v-icon small>close</v-icon></v-btn>
                      <v-list dense>
                        <v-subheader>Are you sure you want to remove this?</v-subheader>
                        <v-list-tile @click="resource.lessons.splice(i, 1)">
                          <v-list-tile-title>Yes</v-list-tile-title>
                        </v-list-tile>
                        <v-list-tile @click>
                          <v-list-tile-title>Cancel</v-list-tile-title>
                        </v-list-tile>
                      </v-list>
                    </v-menu>
                  </v-toolbar>
                  <v-slide-y-transition>
                    <v-card flat v-show="lesson.model">
                      <v-divider></v-divider>
                      <v-card-text>
                        <v-text-field v-model="lesson.title" label="Title" class="mb-3"></v-text-field>
                        <editor label="Description"></editor>
                      </v-card-text>

                      <v-divider></v-divider>

                      <!-- Content -->
                      <v-card flat>
                        <v-progress-linear height="2" color="amber" class="ma-0"></v-progress-linear>
                        <v-toolbar card dense class="transparent">
                          <v-icon class="draggable-handle" color="amber">extension</v-icon>
                          <v-toolbar-title class="subheading amber--text">Content</v-toolbar-title>
                          <v-spacer></v-spacer>
                          <v-btn small icon><v-icon small>keyboard_arrow_up</v-icon></v-btn>
                        </v-toolbar>

                        <v-card-text class="grey lighten-3 pl-5">
                          <v-card tile v-for="(content, j) in lesson.contents" :key="j" class="mb-3">
                            <v-progress-linear height="2" color="amber" class="ma-0"></v-progress-linear>
                            <v-toolbar card dense class="transparent">
                              <v-icon small class="draggable-handle">drag_handle</v-icon>
                              <v-spacer></v-spacer>
                              <v-toolbar-title class="subheading" v-html="content.title"></v-toolbar-title>
                              <v-spacer></v-spacer>
                              <v-btn small icon @click="content.model = !content.model"><v-icon small>{{ content.model ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon></v-btn>
                              <v-menu left>
                                <v-btn slot="activator" small icon><v-icon small>close</v-icon></v-btn>
                                <v-list dense>
                                  <v-subheader>Are you sure you want to remove this?</v-subheader>
                                  <v-list-tile @click="lesson.contents.splice(j, 1)">
                                    <v-list-tile-title>Yes</v-list-tile-title>
                                  </v-list-tile>
                                  <v-list-tile @click>
                                    <v-list-tile-title>Cancel</v-list-tile-title>
                                  </v-list-tile>
                                </v-list>
                              </v-menu>
                            </v-toolbar>
                            <v-slide-y-transition>
                              <v-card flat v-show="content.model">
                                <v-divider></v-divider>
                                <v-card-text>
                                  <v-text-field v-model="content.title" label="Title" class="mb-3"></v-text-field>
                                  <editor label="Description"></editor>
                                </v-card-text>
                              </v-card>
                            </v-slide-y-transition>
                          </v-card>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn ripple dark color="amber" @click="lesson.contents.push({name: 'Content', model: true, contents: []})"><v-icon left>add</v-icon> Add Content</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-card>
                  </v-slide-y-transition>
                </v-card>

              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn ripple dark color="teal" @click="resource.lessons.push({name: 'Lesson', model: true, contents: []})"><v-icon left>add</v-icon> Add Lesson</v-btn>
              </v-card-actions>
            </v-card>

          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </div>
</template>

<script>
import Editor from '@/components/components/Editor.vue'

export default {
  name: 'Edit',
  components: { Editor },
  data () {
    return {
      resource: {
        saving: false,
        form: { model: true },
        item: {
          title: '',
          code: '',
          feature: '',
          user_id: '',
          body: '',
          delta: ''
        },
        lessons: []
      }
    }
  },
  methods: {
    get () {
      let query = {
        id: this.$route.params.page
      }
      this.$http.get('/api/v1/pages/find', {params: query})
        .then(response => {
          this.resource.item = response.data
          // console.log(response)
        })
    }
  },
  mounted () {
    this.get()
  }
}
</script>
