export default {
  name: 'route',
  methods: {
    route: (name, defaultString) => {
      console.log(this.$routes)
      return name
    }
  }
}