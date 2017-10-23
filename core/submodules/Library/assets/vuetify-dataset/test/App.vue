<template>
  <div id="app">
    <v-app>
      <v-container fluid grid-list-lg>
        <v-flex sm9>
          <span v-html="`Selected ${selected.length} of ${items.length}`"></span>
          <v-dataset select-all="primary" :table="toggle" :card="!toggle" v-model="selected" :items="items" :headers="headers" @change="change" @infinite="listen">
            <!-- <template slot="items" scope="prop">
              <span v-html="prop"></span>
              <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                <td>
                  <v-checkbox
                    color="primary"
                    hide-details
                    :input-value="prop.selected"
                  ></v-checkbox>
                </td>
                <td>
                  <v-avatar tile size="35px">
                    <img :src="prop.item.thumbnail">
                  </v-avatar>
                </td>
                <td v-html="prop.item.id"></td>
                <td v-html="prop.item.name"></td>
              </tr>
            </template> -->
            <template slot="card" scope="{prop}">
              <v-card-media v-if="prop.thumbnail" :src="prop.thumbnail" height="250">
                <v-layout column wrap>
                  <v-card-actions>
                    <v-btn icon><v-icon class="success--text">check_circle</v-icon></v-btn>
                  </v-card-actions>
                  <v-spacer></v-spacer>
                </v-layout>
              </v-card-media>
              <v-card-text v-html="prop.name"></v-card-text>
              <v-card-actions class="grey--text">
                <v-icon left>fa-external-link</v-icon>
                <v-spacer></v-spacer>
                <span>1234 KB</span>
              </v-card-actions>
            </template>
          </v-dataset>

          <v-btn color="primary" ripple @click="toggle = !toggle">Toggle</v-btn>
          <v-card-actions>
            <v-switch v-model="toggle" :value="true"></v-switch>
          </v-card-actions>
        </v-flex>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import Component from '../src/Component.vue'

export default {
  name: 'app',
  components: { 'v-dataset': Component },
  data () {
    return {
      toggle: !false,
      selected: [],
      headers: [{ text: 'ID', align: 'left', value: 'id' },{ text: 'Name', align: 'left', value: 'name' }],
      items: [],
      msg: 'Welcome to Your Vue.js App'
    }
  },
  methods: {
    listen ($state) {
      let self = this;
      setTimeout(() => {
        let options = ['witch', 'nature', 'car', 'dessert', 'beach', 'wheel', 'mountains', 'desert', 'water', 'grass']

        let c = Math.floor(Math.random()*options.length)
        self.items.push({id: 1, thumbnail: 'http://source.unsplash.com/400x400?'+options[c], name: options[c], code: 'lorem'})

        $state.loaded()

        console.log(c, options[c], self.items)

        if (self.items.length === 21) {
          $state.complete()
        }
      }, 1000)
    },
    change ({infiniteLoading,value}) {
      // infiniteLoading.$emit('$InfiniteLoading:reset')
      // alert(value)
    }
  },
  mounted () {
    let self = this;

    setTimeout(function () {
      self.items = [{id: 1,thumbnail: 'http://source.unsplash.com/400x400?witch', name: 'Lorem', code: 'lorem'}, {id: 2,thumbnail: 'http://source.unsplash.com/400x400?nature', name: 'Ipsum', code: 'ipsum'}]
      console.log('APP.mounted', self.items)
    }, 1000)
  },
  watch: {
    'toggle': function (val) {
    }
  }
}
</script>

<style>
  @import "~vuetify/dist/vuetify.css";
</style>
