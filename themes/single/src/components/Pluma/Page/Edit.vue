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
                <v-icon left color="green">class</v-icon>
                <v-toolbar-title class="subheading green--text">Lessons</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon small @click="$refs['add-lesson-button'].$el.click()"><v-icon small>note_add</v-icon></v-btn>
                <v-btn icon small @click="toggle(resource.lessons, 'model')"><v-icon small>eject</v-icon></v-btn>
                <v-menu left>
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

                <v-card v-if="!resource.lessons.length" flat :ripple="{color: 'green'}" role="button" class="transparent" @click.native="$refs['add-lesson-button'].$el.click()">
                  <v-card-text class="text-xs-center">
                    <div><v-icon class="display-3" color="green lighten-3">class</v-icon></div>
                    <div class="subheading green--text text--lighten-3">Add Lessons</div>
                  </v-card-text>
                </v-card>

                <!-- Lesson loop -->
                <draggable v-model="resource.lessons" :options="{animation: 150, handle: '.draggable-handle', group: 'lesson-group', draggable: '.draggable-item', forceFallback: true}">
                  <v-card tile v-for="(lesson, i) in resource.lessons" :key="i" class="mb-2 draggable-item">
                    <v-progress-linear height="2" color="green" class="ma-0"></v-progress-linear>
                    <v-toolbar card dense class="transparent draggable-handle">
                      <v-icon small>drag_handle</v-icon>
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
                          <input type="hidden" :name="`lessons[${i}][sort]`" v-model="lesson.sort">
                          <v-text-field :name="`lessons[${i}][title]`" v-model="lesson.title" label="Title" class="mb-3"></v-text-field>
                          <editor :name="`lessons[${i}][body]`" label="Description"></editor>
                        </v-card-text>

                        <v-divider></v-divider>

                        <!-- Content -->
                        <v-card flat>
                          <v-progress-linear height="2" color="light-blue" class="ma-0"></v-progress-linear>
                          <v-toolbar card dense class="transparent">
                            <v-icon color="light-blue">extension</v-icon>
                            <v-toolbar-title class="subheading light-blue--text">Contents</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn small icon @click="lesson.contentmodel = !lesson.contentmodel"><v-icon small>{{ lesson.contentmodel ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon></v-btn>
                            <v-menu left transition="slide-y-transition">
                              <v-btn slot="activator" small icon @click=""><v-icon small>delete_forever</v-icon></v-btn>
                              <v-card>
                                <v-toolbar dense card>
                                  <v-icon small color="warning">warning</v-icon>
                                  <v-toolbar-title class="body-2 warning--text">Warning</v-toolbar-title>
                                </v-toolbar>
                                <v-card-text>
                                  <alert-icon small mode="warning"></alert-icon>
                                  <p class="body-1 text-xs-center warning--text">This action is irreversible.</p>
                                  <p class="body-1 text-xs-center">Are you sure you want to delete all contents of this lesson?</p>
                                </v-card-text>
                                <v-card-actions>
                                  <v-spacer></v-spacer>
                                  <v-btn flat small color="warning" @click="lesson.contents = []">Yes</v-btn>
                                  <v-btn flat small>Cancel</v-btn>
                                </v-card-actions>
                              </v-card>
                            </v-menu>
                          </v-toolbar>

                          <v-slide-y-transition mode="in-out">
                            <v-card flat v-show="lesson.contentmodel">
                              <v-card-text class="grey lighten-3 pl-5">

                                <v-card v-if="!lesson.contents.length" flat :ripple="{color: 'light-blue'}" class="transparent" @click.native="$refs[`add-content-button-${i}`].$el.click()">
                                  <v-card-text class="text-xs-center">
                                    <div><v-icon class="display-3" color="light-blue lighten-3">extension</v-icon></div>
                                    <div class="subheading light-blue--text text--lighten-3">Add Content</div>
                                  </v-card-text>
                                </v-card>

                                <!-- Content loop -->
                                <v-card tile v-for="(content, j) in lesson.contents" :key="j" class="mb-2">
                                  <v-progress-linear height="2" color="light-blue" class="ma-0"></v-progress-linear>
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
                                    <v-card flat tile v-show="content.model">
                                      <v-divider></v-divider>
                                      <v-card-text>
                                        <v-text-field v-model="content.title" label="Title" class="mb-3"></v-text-field>
                                        <editor label="Description" height="100px"></editor>
                                      </v-card-text>
                                      <v-divider></v-divider>
                                      <v-card flat tile>
                                        <v-toolbar dense card>
                                          <v-icon>play_circle_filled</v-icon>
                                          <v-toolbar-title class="subheading grey--text text--darken-2">Media</v-toolbar-title>
                                        </v-toolbar>
                                        <v-card-text>
                                          <v-card flat tile>
                                            <mediabox
                                              :menu-items="resource.library.categories.items"
                                              :url="{'all': '/api/v1/library/all', 'search': '/api/v1/library/search'}"
                                              class="elevation-0"
                                              icon="play_circle_filled"
                                              no-image-text="Add Media"
                                              height="200px"
                                              hide-toolbar
                                              item-text="name"
                                              item-value="thumbnail"
                                              title="Media"
                                              v-model="content.media"
                                            >
                                              <template slot="menus" slot-scope="{props}">
                                                <v-subheader>Catalogue</v-subheader>
                                                <v-list-tile v-model="menu.model" :key="i" v-for="(menu, i) in props.menus" @click="props.toggle(menu, menu.url)">
                                                  <v-list-tile-action>
                                                    <v-icon>{{ menu.icon }}</v-icon>
                                                  </v-list-tile-action>
                                                  <v-list-tile-content>
                                                    <v-list-tile-title>{{ menu.name }}</v-list-tile-title>
                                                  </v-list-tile-content>
                                                  <v-list-tile-action>{{ menu.count }}</v-list-tile-action>
                                                </v-list-tile>
                                              </template>

                                              <template slot="thumbnail-details" slot-scope="{props}">
                                                <v-card flat class="grey--text" v-if="props.item">
                                                  <v-card-title v-html="props.item.name"></v-card-title>
                                                  <p><span v-html="props.item.description"></span></p>
                                                  <p><v-icon v-html="props.item.icon"></v-icon>&nbsp;<span v-html="props.item.mimetype"></span></p>
                                                </v-card>
                                              </template>
                                            </mediabox>
                                          </v-card>
                                        </v-card-text>
                                      </v-card>
                                    </v-card>
                                  </v-slide-y-transition>
                                </v-card>
                                <!-- Content loop -->

                              </v-card-text>
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn :ref="`add-content-button-${i}`" ripple dark color="light-blue" @click="lesson.contents.push({name: 'Content', model: true, contents: []})"><v-icon left>add</v-icon> Add Content</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-slide-y-transition>
                        </v-card>
                      </v-card>
                    </v-slide-y-transition>
                  </v-card>
                </draggable>
                <!-- Lesson loop -->

              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn ripple dark ref="add-lesson-button" color="green" @click="resource.lessons.push({name: 'Lesson', model: true, contents: [], contentmodel: true, sort: resource.lessons.length})"><v-icon left>add</v-icon> Add Lesson</v-btn>
              </v-card-actions>
            </v-card>

          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </div>
</template>

<script>
import AlertIcon from '@/components/partials/AlertIcon.vue'
import Draggable from 'vuedraggable'
import Editor from '@/components/components/Editor.vue'
import Mediabox from '@/components/components/Mediabox.vue'

export default {
  name: 'Edit',
  components: { AlertIcon, Draggable, Editor, Mediabox },
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
        lessons: [],
        library: { categories: { items: [] } }
      }
    }
  },
  methods: {
    mountAttributes () {
      this.$http.post('/api/v1/library/catalogues')
        .then(response => {
          this.resource.library.categories.items = response.data
        })
    },
    get () {
      let query = {
        id: this.$route.params.page
      }
      this.$http.get('/api/v1/pages/find', {params: query})
        .then(response => {
          this.resource.item = response.data
          // console.log(response)
        })
    },
    toggle (array, key) {
      array.map(item => {
        item[key] = !item[key]
      })
    }
  },
  mounted () {
    this.mountAttributes()
    this.get()
  }
}
</script>

<style>
.draggable-handle {
  cursor: move;
}
</style>
