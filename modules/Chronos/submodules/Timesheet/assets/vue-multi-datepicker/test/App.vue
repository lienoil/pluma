<template>
  <div id="app">
    <v-app>
      <v-container fluid>
        <v-layout row wrap>

          <v-flex lg4>
            <vue-component
              class="white elevation-1 mb-3"
              v-model="dates"
              :config.sync="config"
              @change="change"
            ></vue-component>
          </v-flex>
          <v-flex lg6>
            <v-btn color="primary" @click="dates = ''">Reset</v-btn>

            <v-card class="elevation-1">
              <v-toolbar card class="transparent">
                <v-toolbar-title>Form</v-toolbar-title>
              </v-toolbar>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, itaque nam consectetur consequuntur ea nesciunt earum suscipit harum, voluptate amet rem ipsa incidunt inventore officiis debitis voluptatibus quasi aut, ipsum odio dolore. Maxime voluptatem quibusdam quisquam voluptatibus, error est obcaecati corporis, laborum consequatur voluptas labore, natus veniam. A quae eaque debitis. Dolor modi, blanditiis reprehenderit, ratione aut deserunt veniam maxime qui. Voluptatum, et. Tenetur voluptate optio ex tempora deserunt rerum non, molestias. Aspernatur alias libero, veniam reiciendis eaque nemo at minima, sint ducimus impedit numquam perferendis nam cum similique culpa consequatur doloribus! Quis est quasi inventore, quibusdam dolorum! Obcaecati, sapiente!
            </v-card>



            <div v-for="y in dates.split(',')">
              <v-chip>{{ y }}</v-chip>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import Component from '../src/Component.vue'

export default {
  name: 'app',
  components: { 'vue-component': Component },
  data () {
    return {
      dates: '',
      config: {
        mode: 'multiple'
      },
    }
  },
  methods: {
    change (selectedDates, dateStr, instance) {
      //
    }
  }
}
</script>

<style>
  @import '~vue-event-calendar/dist/style.css';
  @import '~vuetify/dist/vuetify.min.css';
</style>
