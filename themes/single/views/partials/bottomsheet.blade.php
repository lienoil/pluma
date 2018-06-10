<v-bottom-sheet v-model="bottomsheet.model" lazy :persistent="bottomsheet.persistent" :full-width="bottomsheet.fullWidth" :inset="bottomsheet.inset">
  <v-card>
    <v-layout column wrap justify-center>
      <v-btn large @click.native="bottomsheet.discardCallback()" flat block color="error">@{{ trans(bottomsheet.discardText) }}</v-btn>
      <v-btn large @click.native="bottomsheet.saveAsDraftCallback()" flat block color="primary">@{{ trans(bottomsheet.saveAsDraftText) }}</v-btn>
      <v-divider></v-divider>
      <v-btn large @click.native="bottomsheet.cancelCallback()" flat block>@{{ trans(bottomsheet.cancelText) }}</v-btn>
    </v-layout>
  </v-card>
</v-bottom-sheet>
