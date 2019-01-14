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
              pa-3
              >
              <v-flex md5 xs12>
                <v-treeview
                  :active.sync="active"
                  :items="items"
                  :load-children="fetchUsers"
                  :open.sync="open"
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
                  >mdi-account</v-icon>
                </v-treeview>
              </v-flex>
              <v-flex
                d-flex
                text-xs-center
                >
                <v-scroll-y-transition mode="out-in">
                  <div
                    v-if="!selected"
                    style="align-self: center;"
                    >
                    Select a User
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
                        {{ selected.name }}
                      </h3>
                      <div class="blue--text mb-2">{{ selected.email }}</div>
                      <!-- <div class="blue--text subheading font-weight-bold">{{ selected.username }}</div> -->
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-layout
                      tag="v-card-text"
                      text-xs-left
                      wrap
                      >
                      <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Company:</v-flex>
                      <v-flex>{{ selected.company.name }}</v-flex>
                      <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Website:</v-flex>
                      <v-flex>
                        <a :href="`//${selected.website}`" target="_blank">{{ selected.website }}</a>
                      </v-flex>
                      <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Phone:</v-flex>
                      <v-flex>{{ selected.phone }}</v-flex>
                    </v-layout>
                  </v-card>
                </v-scroll-y-transition>
              </v-flex>
            </v-layout>
            <v-card-actions>
              <v-btn color="secondary outline">{{ __('Add New Chapter') }}</v-btn>
            </v-card-actions>
          </v-card>


          <!-- create form -->

          <v-card>
           <v-flex sm6 xs12>
              <v-text-field
                label="Lesson"
                box
                placeholder=""
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
      open: [],
      users: []
    }
  },

  computed: {
    items () {
      return [
        {
          name: 'Courses',
          children: this.users
        }
      ]
    },
    selected () {
      if (!this.active.length) return undefined

      const id = this.active[0]

      return this.users.find(user => user.id === id)
    }
  },

  watch: {
    selected: 'randomAvatar'
  },

  methods: {
    async fetchUsers (item) {
      // Remove in 6 months and say
      // you've made optimizations! :)
      // await pause(400)

      return fetch('https://jsonplaceholder.typicode.com/users')
        .then(res => res.json())
        .then(json => (item.children.push(...json)))
        .catch(err => console.warn(err))
    },
    randomAvatar () {
      this.avatar = avatars[Math.floor(Math.random() * avatars.length)]
    }
  }
}
</script>
