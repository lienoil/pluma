<v-snackbar
  :bottom="snackbar.y === 'bottom'"
  :color="snackbar.color"
  :left="snackbar.x === 'left'"
  :dark="theme.dark"
  :light="!theme.dark"
  :multi-line="snackbar.mode === 'multi-line'"
  :right="snackbar.x === 'right'"
  :timeout="snackbar.timeout"
  :top="snackbar.y === 'top'"
  :vertical="snackbar.mode === 'vertical'"
  v-model="snackbar.model"
  multi-line
>
  <alert-icon :class="snackbar.color" small :mode="snackbar.type"></alert-icon>
  &nbsp;
  <span v-html="snackbar.text"></span>
  <v-btn :dark="theme.dark" :light="!theme.dark" flat @click="snackbar.model = false">Close</v-btn>
</v-snackbar>
