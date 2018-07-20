<template>
  <v-card flat color="transparent" class="folder-card" @contextmenu="togglemenu">
    <v-card-text class="text-xs-center folder-card__content pa-1">

      <template v-if="metadata.foldertype === 'image'">
        <photo-icon class="folder-card__mimetype" width="31px" height="31px"></photo-icon>
      </template>
      <template v-if="metadata.foldertype === 'audio'">
        <audio-icon :icon-color="$vuetify.theme.primary" class="folder-card__mimetype" width="31px" height="31px"></audio-icon>
      </template>

      <slot>
        <folder-icon :width="size" :height="size" :icon-color="metadata.color"></folder-icon>
        <v-tooltip bottom v-if="!renaming">
          <div slot="activator" class="folder-card__title mt-1" @dblclick="rename" v-html="trans(metadata.title)"></div>
          {{ trans(metadata.title) }}
        </v-tooltip>
      </slot>
      <!-- editmode -->
      <v-text-field v-if="renaming" v-focus required @focus="$event.target.select()" @blur="renamed" @keyup.enter="renamed" hide-details class="ma-0 folder-card__title--renaming" v-model="metadata.title"></v-text-field>
      <!-- editmode -->
    </v-card-text>

    <slot name="contextmenu" :props="{item: metadata, open: contextmenu.show}">
      <context-menu v-if="contextmenu.show" @rename="rename"></context-menu>
    </slot>
  </v-card>
</template>

<script>
export default {
  name: 'File',

  props: {
    metadata: {
      type: [Object],
      default: () => { return {} },
    },
  },
}
</script>
