<template>
  <div>
    <v-card>
      {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque sint dolorum itaque. Provident voluptate omnis alias laborum eos velit magnam cumque maxime rem quisquam aut deserunt reiciendis, quas ex enim.') }}
      <v-card-text>
        <h1>{{ item.body }}</h1>
        <h1>{{ item.title }}</h1>
        <h1>{{ item.code }}</h1>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import store from '@/store'

export default {
  store,

  name: 'Show',

  mounted () {
    /*eslint-disable*/
    axios.get('/api/v1/pages/' + this.$route.params.code).then(response => {
        console.log(response, 'wew')
        this.item = response.data
      })
  },

  data () {
    return {
      item: {}
    }
  },
}
</script>
