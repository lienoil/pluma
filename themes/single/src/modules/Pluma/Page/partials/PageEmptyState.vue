<template>
  <v-card flat color="transparent" class="text-xs-center">
    <v-card-text>
      <div><v-icon color="text-emphasis--medium" class="display-4">rounded_corner</v-icon></div>
      <div class="text-emphasis--medium">{{ trans('No pages found. Try creating one, maybe a home page?') }}</div>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn large color="secondary" v-can="{code: 'pages.create'}" exact :to="{name: 'pages.create'}">{{ trans('Create New Page') }}</v-btn>
        <v-spacer></v-spacer>
      </v-card-actions>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'PageEmptyState'
}
</script>
