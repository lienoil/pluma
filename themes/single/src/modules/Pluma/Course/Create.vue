<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md4 xs12>
          <v-card hover>
            <v-card-text>
              <v-layout row wrap justify-center align-center>
                <v-card flat>
                  <v-card-text>
                    <h3>Progressive Web Application</h3>
                    <p>Lorem ipsum dolor</p>
                    <span class="grey--text">Last accessed: Aug 02, 2018</span>
                  </v-card-text>
                </v-card>
                <v-spacer></v-spacer>
                <v-card flat>
                  <v-progress-circular
                    :rotate="-90"
                    :size="100"
                    :width="10"
                    :value="value"
                    color="pink lighten-1"
                    >
                    {{ value }}%
                  </v-progress-circular>
                </v-card>
              </v-layout>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<style lang="stylus" scoped>
  .v-progress-circular
    margin: 1rem
</style>

<script>
export default {
  name: 'CourseProgress',

  data () {
    return {
      value: 90,
      interval: {},
    }
  },

  // beforeDestroy () {
  //   clearInterval(this.interval)
  // },

  // mounted () {
  //   this.interval = setInterval(() => {
  //     if (this.value === 100) {
  //       return (this.value = 0)
  //     }
  //     this.value += 10
  //   }, 1000)
  // }
}
</script>
