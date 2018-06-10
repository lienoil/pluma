<v-snackbar
  :color="theme.dark ? `theme--light light` : `theme--dark dark`"
  :bottom="snackbar.y === 'bottom'"
  :left="snackbar.x === 'left'"
  :dark="!theme.dark"
  :multi-line="snackbar.mode === 'multi-line'"
  :right="snackbar.x === 'right'"
  :timeout="snackbar.timeout"
  :top="snackbar.y === 'top'"
  :vertical="snackbar.mode === 'vertical'"
  v-model="snackbar.model"
  >
  {{-- <alert-icon small :mode="snackbar.type"></alert-icon>
  &nbsp; --}}
  {{-- :class="!theme.dark ? `white--text` : `grey--text text--darken-3`" --}}
  <span class="body-1" v-html="snackbar.text"></span>

  {{-- :dark="!theme.dark" :light="theme.dark" --}}
  <v-btn icon v-if="snackbar.close" @click="snackbar.model = false" small><v-icon small color="grey darken-2">close</v-icon></v-btn>
</v-snackbar>
