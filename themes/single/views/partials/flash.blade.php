<v-snackbar
  :timeout="snackbar.timeout"
  :color="snackbar.color"
  :top="snackbar.y === 'top'"
  :bottom="snackbar.y === 'bottom'"
  :right="snackbar.x === 'right'"
  :left="snackbar.x === 'left'"
  v-model="snackbar.model"
>
  <v-icon color="snackbar.color" v-html="snackbar.icon"></v-icon>
  &nbsp;<span v-html="snackbar.text"></span>
  <v-btn dark flat ripple @click="snackbar.model = false">Close</v-btn>
</v-snackbar>
