<template>
  <v-card>
    <v-toolbar flat dense class="emphasis--medium">
      <v-toolbar-title>
        {{ trans('My To-do\'s') }}
      </v-toolbar-title>
    </v-toolbar>
    <v-list two-line>
      <v-list-tile v-for="item in todo.items">
        <v-list-tile-action>
          <v-checkbox></v-checkbox>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>
            {{ trans(item.title) }}
          </v-list-tile-title>
          <v-list-tile-sub-title>
            {{ trans(item.schedule) }}
          </v-list-tile-sub-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-card>
</template>

<script>
  export default {
    name: 'ToDo',

    data () {
      return {
        todo: {
          items: [
            {
              title: 'Update Ubuntu Software',
              schedule: 'Aug 08, 2018'
            },
            {
              title: 'Do Laundry',
              schedule: 'Aug 12, 2018'
            },
          ]
        }
      }
    },
  }
</script>
