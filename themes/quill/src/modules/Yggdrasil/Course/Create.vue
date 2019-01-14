<template>
  <section>
    <v-toolbar flat>
      <v-toolbar-title>
        {{ __('Create Course') }}
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn color="secondary">{{ __('Save') }}</v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>
          <v-card class="mb-3">
            <v-layout
              justify-space-between
              row wrap
              pa-3
              >
              <v-flex md5 xs12>
                <v-treeview
                  :active.sync="active"
                  :items="items"
                  :load-children="fetchPosts"
                  :open="open"
                  activatable
                  active-class="primary--text"
                  flat
                  open-on-click
                  transition
                  >
                  <v-icon
                    v-if="!item.children"
                    slot="prepend"
                    slot-scope="{ item, active }"
                    :color="active ? 'primary' : ''"
                    >
                    mdi-account
                  </v-icon>
                </v-treeview>
                <v-layout justify-start align-start>
                  <v-btn flat color="secondary">
                    <v-icon left>add</v-icon>
                    {{ __('Add New Chapter') }}
                  </v-btn>
                </v-layout>

                <v-layout justify-start align-start>

                </v-layout>
              </v-flex>

              <!-- view -->
              <v-flex md7 xs12>
                <v-scroll-y-transition mode="out-in">
                  <div
                    v-if="!selected"
                    style="align-self: center;"
                    >
                    Select a Course
                  </div>
                  <v-card
                    v-else
                    :key="selected.id"
                    class="pt-4 mx-auto"
                    flat
                    max-width="400"
                    >
                    <v-card-text>
                      <h3 class="headline mb-2">
                        {{ selected.title }}
                      </h3>
                      <div class="blue--text mb-2">{{ selected.body }}</div>
                    </v-card-text>
                  </v-card>
                </v-scroll-y-transition>
              </v-flex>
            </v-layout>
          </v-card>

          <!-- create form -->
          <v-card>
           <v-flex sm6 xs12>
              <v-text-field
                label="Lesson"
                box
              ></v-text-field>
            </v-flex>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
export default {
  name: 'Create',

  data () {
    return {
      active: [],
      avatar: null,
      open: ['Chapter 1'],
      posts: [],
    }
  },

  computed: {
    items () {
      return [
        {
          name: 'Chapter 1',
          children: this.posts
        }
      ]
    },
    selected () {
      if (!this.active.length) return undefined

      const id = this.active[0]

      return this.posts.find(post => post.id === id)
    }
  },

  // watch: {
  //   selected: 'randomAvatar'
  // },

  methods: {
    async fetchPosts (item) {
      // Remove in 6 months and say
      // you've made optimizations! :)
      // await pause(400)

      return fetch('https://jsonplaceholder.typicode.com/posts')
        .then(res => res.json())
        .then(json => (item.children.push(...json)))
        .catch(err => console.warn(err))
    },
    // randomAvatar () {
    //   this.avatar = avatars[Math.floor(Math.random() * avatars.length)]
    // }
  }
}
</script>
