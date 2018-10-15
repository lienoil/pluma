<template>
  <div v-if="!template.selected">
    <choose-template v-model="template.selected"></choose-template>
  </div>
  <div v-else>
    <component :is="template.selected.code"></component>
  </div>
</template>

<script>
import CreateHomePage from './templates/CreateHomePage.vue'
import ChooseTemplate from './partials/ChooseTemplate.vue'

export default {
  name: 'Create',
  components: { CreateHomePage, ChooseTemplate },
  data () {
    return {
      template: {
        selected: null
      }
    }
  }
}
</script>
