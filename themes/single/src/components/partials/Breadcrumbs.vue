<template>
  <v-breadcrumbs>
    <v-icon slot="divider">keyboard_arrow_right</v-icon>
    <v-breadcrumbs-item
      :to="breadcrumb.path"
      :key="i"
      exact
      v-for="(breadcrumb, i) in breadcrumbs"
    >
      <small v-html="breadcrumb.text"></small>
    </v-breadcrumbs-item>
  </v-breadcrumbs>
</template>

<script>
export default {
  name: 'Breadcrumbs',
  props: {
    items: { type: [Object, Array], default: () => { return [] } }
  },
  computed: {
    breadcrumbs: function () {
      return [
        {path: 'admin', text: 'Admin'},
        {path: 'collections', text: 'Collections'},
        {path: 'admin/pages', text: 'Pages'},
        {path: 'admin/pages/songs', text: 'Songs'},
        {path: 'admin/pages/songs/the-beatles', text: 'The Beatles'},
        {path: 'admin/pages/songs/the-beatles/the-long-and-winding-road', text: 'The Long and Winding Road'}
      ]
      // let pathArray = this.$route.path.split('/')
      // pathArray.shift()
      // let breadcrumbs = pathArray.reduce((breadcrumbArray, path, idx) => {
      //   breadcrumbArray.push({
      //     path: '/' + path,
      //     to: breadcrumbArray[idx]
      //       ? '/' + breadcrumbArray[idx].path + '/' + path
      //       : '/' + path,
      //     text: this.$route.matched[idx - 1] ? this.$route.matched[idx - 1].meta.title : path.charAt(0).toUpperCase() + path.slice(1)
      //   })
      //   return breadcrumbArray
      // }, [])
      // return breadcrumbs
    }
  }
}
</script>
