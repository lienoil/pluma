<template>
  <div>
    <v-card v-for="n in 24" :class="`mb-4 elevation-${n}`" :key="n">
      <slot name="content"></slot>
    </v-card>
  </div>
</template>

<script>
export default {
  name: 'Loop'
}
</script>
