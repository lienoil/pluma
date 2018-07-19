<template>
  <div class="text-xs-center text--disabled">
    <empty-box-icon class="ma-5" width="120px" height="120px" color="#b0b0b0"></empty-box-icon>
    <div class="text--disabled">
      <div class="headline"><strong>{{ trans(title) }}</strong></div>
      <div class="subheading"><small>{{ trans(description) }}</small></div>
    </div>
  </div>
</template>

<script>
import EmptyBoxIcon from '@/components/Icons/EmptyBoxIcon'

export default {
  name: 'MainMediaWindowEmptyState',

  components: {
    EmptyBoxIcon
  },

  props: {
    title: {
      type: String,
      default: 'No Media Found'
    },
    description: {
      type: String,
      default: 'Drag files here or use the "My Library" button'
    }
  }
}
</script>
