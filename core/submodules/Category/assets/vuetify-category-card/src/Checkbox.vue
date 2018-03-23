<template>
  <div>
    <v-checkbox v-model="dataset.selected" hide-details color="primary" v-for="(item, i) in dataset.items"
      :label="item.name" :key="i" :value="JSON.stringify(item)"></v-checkbox>
  </div>
</template>

<script>
  export default {
    name: 'checkbox',
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
          selected: []
        },
        searchform: {
          model: false
        }
      }
    },
    mounted () {
      this.dataset.items = this.list
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
