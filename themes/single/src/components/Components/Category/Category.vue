<template>
  <v-card>
    <v-template
      v-model="dataset.categoryList"
      v-if="dataset.categoryList"
      >
      <v-card-text>
        <icon-menu :items="categoryIcon">
        </icon-menu>
      </v-card-text>
      <v-card-text>
        <v-text-field
          box
          label="Category Name"
          name="category"
        ></v-text-field>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          flat
          @click="dataset.categoryList = !dataset.categoryCreate"
          >
          Cancel
        </v-btn>
      </v-card-actions>
    </v-template>

    <v-template v-else>
      <v-card-text>
        <v-autocomplete
          :items="dataset.items"
          :label="dataset.label"
          :multiple="dataset.multiple"
          append-icon="keyboard_arrow_down"
          box
          chips
          hide-details="dataset.hideDetails"
          item-text="name"
          item-value="name"
          v-model="dataset.model"
          >
          <template
            slot="selection"
            slot-scope="props"
            >
            <v-chip
              :selected="props.selected"
              class="chip--select-multi"
              @input="props.parent.selectItem(props.item)"
              >
              <v-avatar
                :class="dataset.chipColor"
                >
                <v-icon
                  :class="dataset.iconColor"
                  small
                  v-html="props.item.icon"
                  >
                </v-icon>
              </v-avatar>
              {{ props.item.name }}
            </v-chip>
          </template>
          <template
            slot="item"
            slot-scope="props"
            >
            <template v-if="typeof props.item !== 'object'">
              <v-list-tile-content
                v-text="props.item"
                >
              </v-list-tile-content>
            </template>
            <template v-else>
              <v-list-tile-action>
                <v-icon
                  v-html="props.item.icon"
                  >
                </v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title
                  v-if="props.item.name"
                  v-html="trans(props.item.name)"
                  >
                </v-list-tile-title>
                <v-list-tile-sub-title
                  v-if="props.item.group"
                  v-html="trans(props.item.group)"
                  >
                </v-list-tile-sub-title>
              </v-list-tile-content>
            </template>
          </template>
        </v-autocomplete>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          flat
          color="secondary"
          @click="dataset.categoryList = !dataset.categoryList"
          >
          <v-icon left>add</v-icon>
          Create
        </v-btn>
      </v-card-actions>
    </v-template>
  </v-card>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'
import iconmenu from '@/components/Components/IconMenu'

export default {
  store,
  iconmenu,
  name: 'Category',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {

      },
      categoryIcon: {
        label: 'Category Icon',
        multiple: false,
        chipColor: 'secondary',
        iconColor: 'white--text'
      },
    }
  },

  methods: {
    remove (item) {
      this.dataset.model.splice(this.dataset.model.indexOf(item), 1)
      this.dataset.model = [...this.dataset.model]
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.category, this.items)
  },

  computed: {
    ...mapGetters({
      category: 'category/category'
    })
  }
}
</script>
