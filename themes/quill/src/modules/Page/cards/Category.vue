<template v-if="resource.categories.items.length">
  <v-card-text>
    <v-select
      append-icon="keyboard_arrow_down"
      :input-value="resource.item.category_id"
      :items="resource.categories.items"
      auto
      clearable
      item-text="name"
      item-value="id"
      label="{{ __('Choose Categories') }}"
      v-model="resource.item.category_id"
      >
      <template slot="selection" scope="data">
        <v-chip
          :selected="data.selected"
          :key="JSON.stringify(data.item)"
          @input="data.parent.selectItem(data.item)"
          >
          <v-avatar v-if="data.item.icon">
            <v-icon
              class="primary primary--text"
              v-html="data.item.icon">
            </v-icon>
          </v-avatar>
          <span v-html="data.item.name"></span>
        </v-chip>
      </template>
      <template slot="item" scope="data">
        <template v-if="typeof data.item !== 'object'">
          <v-list-tile-content v-text="data.item"></v-list-tile-content>
        </template>
        <template v-else>
          <v-list-tile-avatar v-if="data.item.icon">
            <v-icon v-html="data.item.icon"></v-icon>
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
            <v-list-tile-sub-title v-html="data.item.description"></v-list-tile-sub-title>
          </v-list-tile-content>
        </template>
      </template>
    </v-select>
    <input type="hidden" name="category_id" :value="resource.item.category_id">
  </v-card-text>
</template>

<template v-else>
  <v-card-text class="grey lighten-4 pa-5 grey--text text-xs-center">
    <div>
      {{ __('No categories defined.') }}
    </div>
  </v-card-text>
</template>

<script>
export default {
  name: 'Category',

  data () {
    return {
      resource: {
        categories: {
          items: {

          }
        }
      }
    }
  },
</script>
