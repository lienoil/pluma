<v-snackbar
  :timeout="snackbar.timeout"
  :color="snackbar.color"
  :top="snackbar.y === 'top'"
  :bottom="snackbar.y === 'bottom'"
  :right="snackbar.x === 'right'"
  :left="snackbar.x === 'left'"
  multi-line
  v-model="snackbar.model"
>
  <v-icon left color="snackbar.color" v-html="snackbar.icon"></v-icon>
  {{-- &nbsp; <span v-html="snackbar.text"></span> --}}
  &nbsp; <span>Lorem ipsum dolor sit amet, consectetur eos quis voluptatibus laudantium?</span>
  <v-btn dark flat @click="snackbar.model = false">Close</v-btn>
</v-snackbar>
