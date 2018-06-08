<template>
  <v-dialog v-model="$root.dialog.model">
    <slot name="dialog">
      <v-card>
        <v-card-title v-html="trans($root.dialog.title)"></v-card-title>
        <v-card-text v-html="trans($root.dialog.text)"></v-card-text>
        <v-card-actions v-if="$root.dialog.cancel || $root.dialog.action">
          <v-spacer></v-spacer>
          <v-btn v-if="$root.dialog.cancel" large @click.native="$root.dialog.model = false">Cancel</v-btn>
          <v-btn v-if="$root.dialog.action" large @click.native="$root.dialog.actionCallback()" color="primary">Save</v-btn>
        </v-card-actions>
      </v-card>
    </slot>
  </v-dialog>
</template>
