<template>
  <div>
    <v-radio-group v-model="dataset.selected" :mandatory="mandatory">
      <v-radio color="primary" class="mb-4" :label="label" value=""></v-radio>
      <v-radio color="primary" class="mb-2" v-for="(item, i) in list"
        :label="item.name" :key="i" :value="JSON.stringify(item)"></v-radio>
    </v-radio-group>
  </div>
</template>

<script>
  export default {
    name: 'radio',
    model: {
      prop: 'selected'
    },
    props: {
      list: { type: Array, default: () => { return [] } },
      label: { type: String, default: 'None' },
      mandatory: { type: Boolean, default: false },
      multiple: { type: Boolean, default: false },
      selected: null,
    },
    data () {
      return {
        dataset: {
          items: [],
          selected: null
        },
        searchform: {
          model: false
        }
      }
    },
    mounted () {
      this.dataset.items = this.list
      this.dataset.selected = this.selected
      // console.log('-ww|ww-', this.selected, this.dataset.selected)
    },
    watch: {
      'list': function (value) {
        this.dataset.items = value
      },
      'selected': function (value) {
        this.dataset.selected = value
      },
      'dataset.selected': function (value) {
        this.$emit('input', value)
      }
    }
  }
</script>
