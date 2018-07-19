<template>
  <section>
    <dialogbox></dialogbox>
    <v-btn @click="openDialogbox">Open Dialog Test</v-btn>

    <!-- data table -->
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md9 xs12>
          <v-card>
            <v-toolbar flat dark class="primary">
              <v-text-field
                dark
                flat
                label="Search Courses"
                prepend-inner-icon="search"
                solo-inverted
              ></v-text-field>
            </v-toolbar>
            <v-data-table
              v-model="selected"
              :headers="headers"
              :items="desserts"
              :pagination.sync="pagination"
              select-all
              item-key="name"
              class="table__striped no__border"
            >
              <template slot="headers" slot-scope="props">
                <tr>
                  <th>
                    <v-checkbox
                      :input-value="props.all"
                      :indeterminate="props.indeterminate"
                      primary
                      hide-details
                      @click.native="toggleAll"
                    ></v-checkbox>
                  </th>
                  <th
                    v-for="header in props.headers"
                    :key="header.text"
                    :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                    @click="changeSort(header.value)"
                  >
                    <v-icon small>arrow_forward</v-icon>
                    {{ header.text }}
                  </th>
                </tr>
              </template>
              <template slot="items" slot-scope="props">
                <tr :active="props.selected" @click="props.selected = !props.selected">
                  <td>
                    <v-checkbox
                      :input-value="props.selected"
                      primary
                      hide-details
                    ></v-checkbox>
                  </td>
                  <td class="text-xs-left">{{ props.item.name }}</td>
                  <td class="text-xs-center">{{ props.item.calories }}</td>
                  <td class="text-xs-center">{{ props.item.fat }}</td>
                  <td class="text-xs-center">{{ props.item.carbs }}</td>
                  <td class="text-xs-center">{{ props.item.protein }}</td>
                  <td class="text-xs-center">{{ props.item.iron }}</td>
                </tr>
              </template>
            </v-data-table>
          </v-card>
        </v-flex>

        <v-flex md3 xs12>
          <v-card flat class="transparent mb-3">
            <v-btn large block class="secondary">
              <v-icon left>add</v-icon> Create
            </v-btn>
            <v-btn large block flat>
              <v-icon left>delete</v-icon> View Trashed Page</v-btn>
          </v-card>
          <!-- <v-card flat class="text-xs-center transparent mb-3">
            <p class="body-1 grey--text">3 items selected</p>
            <v-btn flat block class="secondary--text">Move to Trash</v-btn>
          </v-card> -->
        </v-flex>
      </v-layout>
      <div style="height: 300px"></div>
    </v-container>
    <!-- data table -->
  </section>
</template>

<style>
  .v-input__slot {
    margin-bottom: 0;
  }
</style>

<script>
// import Dialogbox from '@/components/Components/Dialog/Dialogbox.vue'
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  data () {
    return {
      pagination: {
        sortBy: 'name'
      },
      selected: [],
      headers: [
        {
          text: 'Dessert (100g serving)',
          value: 'name',
          align: 'left'
        },
        { text: 'Calories', value: 'calories', align: 'center' },
        { text: 'Fat (g)', value: 'fat', align: 'center' },
        { text: 'Carbs (g)', value: 'carbs', align: 'center' },
        { text: 'Protein (g)', value: 'protein', align: 'center' },
        { text: 'Iron (%)', value: 'iron', align: 'center' }
      ],
      desserts: [
        {
          value: false,
          name: 'Frozen Yogurt',
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: '1%'
        },
        {
          value: false,
          name: 'Ice cream sandwich',
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: '1%'
        },
        {
          value: false,
          name: 'Eclair',
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: '7%'
        },
        {
          value: false,
          name: 'Cupcake',
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: '8%'
        },
        {
          value: false,
          name: 'Gingerbread',
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
          iron: '16%'
        },
        {
          value: false,
          name: 'Jelly bean',
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
          iron: '0%'
        },
        {
          value: false,
          name: 'Lollipop',
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
          iron: '2%'
        },
        {
          value: false,
          name: 'Honeycomb',
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
          iron: '45%'
        },
        {
          value: false,
          name: 'Donut',
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
          iron: '22%'
        },
        {
          value: false,
          name: 'KitKat',
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
          iron: '6%'
        }
      ],
      searchbar: false,
      hidden: false
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox'
    })
  },

  methods: {
    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            // icon: 'add',
            // iconColor: 'success--text',
            image: 'https://img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
            title: 'Delete Resources',
            text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
            persistent: false,
            width: '100%',

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false,
            alignedCenter: false
          }
        )
      )
    },

    toggleAll () {
      if (this.selected.length) this.selected = []
      else this.selected = this.desserts.slice()
    },
    changeSort (column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending
      } else {
        this.pagination.sortBy = column
        this.pagination.descending = false
      }
    }
  }
}
</script>
