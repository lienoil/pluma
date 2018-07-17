<template>
  <section>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12>

            <v-card height="300px" class="mb-3">
              <dialogbox></dialogbox>
              <v-btn @click="openDialogbox">Open Dialog Test</v-btn>
            </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
// import Dialogbox from '@/components/Components/Dialog/Dialogbox.vue'
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  data () {
    return {

    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox'
    })
  },

  methods: {
    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            title: 'You have unsaved changes',
            text: 'You will lose your data permlorem  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae error quo iusto, labore repellat aspernatur. Culpa nesciunt tenetur recusandae, aliquam nisi harum earum consequuntur adipisci, voluptatibus in consequatur nulla tempore.anently when you navigate away without saving.',
            persistent: false,
            width: '100%',

            actionText: 'Save to Drafts',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false
          }
        )
      )
    }
  }
}
</script>
