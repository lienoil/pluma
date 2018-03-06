<v-snackbar
  :bottom="snackbar.y === 'bottom'"
  :color="snackbar.color"
  :left="snackbar.x === 'left'"
  :dark="snackbar.theme === 'dark'"
  :light="snackbar.theme === 'light'"
  :multi-line="snackbar.mode === 'multi-line'"
  :right="snackbar.x === 'right'"
  :timeout="snackbar.timeout"
  :top="snackbar.y === 'top'"
  :vertical="snackbar.mode === 'vertical'"
  v-model="snackbar.model"
  multi-line
>
  <alert-icon :class="snackbar.color" small :mode="snackbar.type"></alert-icon>
  &nbsp; <span v-html="snackbar.text"></span>
  <v-btn :dark="snackbar.theme === 'dark'" :light="snackbar.theme === 'light'" flat @click="snackbar.model = false">Close</v-btn>
</v-snackbar>
