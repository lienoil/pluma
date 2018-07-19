<template>
  <section>
    <h4 class="text--disabled">{{ trans('Most Recent') }}</h4>

    <v-layout row wrap>
      <v-container fluid grid-list-lg>
        <v-layout row wrap justify-center align-center justify-space-between>
          <v-flex v-for="(recent, i) in recents" :key="i">
            <v-card class="recent-card">
              <v-card flat tile color="grey lighten-3">
                <v-card-media src="//source.unsplash.com/200x300?yellow" height="180px">
                </v-card-media>
              </v-card>
              <v-divider></v-divider>
              <v-card-actions>
                <v-btn>Get</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-layout>
  </section>
</template>

<script>
export default {
  name: 'QuickRecentMediaWindow',
  data () {
    return {
      recents: []
    }
  }
}
</script>

<style lang="stylus">
.recent-card {
  min-height: 180px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
</style>
