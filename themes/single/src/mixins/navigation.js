export const navigation = {
  methods: {
    go () {
      return {
        forward: () => {
          this.$router.go(1)
        },
        back: () => {
          this.$router.go(-1)
        },
        to: (n) => {
          this.$router.go(n)
        }
      }
    }
  }
}
