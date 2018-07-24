<template>
  <v-autocomplete
    :items="iconmenu.items"
    :label="iconmenu.label"
    :multiple="iconmenu.multiple"
    append-icon="keyboard_arrow_down"
    box
    chips
    hide-details="iconmenu.hideDetails"
    item-text="name"
    item-value="name"
    v-model="iconmenu.model"
    >
    <template
      slot="selection"
      slot-scope="props"
      >
      <v-chip
        :selected="props.selected"
        close
        class="chip--select-multi"
        @input="props.parent.selectItem(props.item)"
      >
        <v-avatar
          :class="iconmenu.chipColor"
          >
          <v-icon
            :class="iconmenu.iconColor"
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
        <v-list-tile-content v-text="props.item"></v-list-tile-content>
      </template>
      <template v-else>
        <v-list-tile-action>
          <v-icon v-html="props.item.icon"></v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title v-if="props.item.name" v-html="props.item.name"></v-list-tile-title>
          <v-list-tile-sub-title v-if="props.item.group" v-html="props.item.group"></v-list-tile-sub-title>
        </v-list-tile-content>
      </template>
    </template>
  </v-autocomplete>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'IconMenu',
  computed: {
    ...mapGetters({
      iconmenu: 'iconmenu/iconmenu'
    })
  }
}
</script>
