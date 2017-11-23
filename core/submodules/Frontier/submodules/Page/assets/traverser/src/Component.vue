<template>
  <div :traversables="dTraversables">
    <draggable v-model="dTraversables" :options="options">
      <slot>
        <transition-group>
          <v-card :key="i" v-for="(t, i) in dTraversables" class="sortable-handle parent-handle draggable-page">
            <v-card-text>
              <div class="headline">{{ t.title }}</div>
              <div class="caption">{{ t.slug }}</div>
            </v-card-text>
            <v-card-text class="grey lighten-4 sortable-container" style="min-height: 100px" v-if="t[childName]">
              <v-traverser v-model="t[childName]" :options="options" :child-name="childName"></v-traverser>
            </v-card-text>
          </v-card>
        </transition-group>
      </slot>
    </draggable>
  </div>
</template>

<script>
  import 'sortablejs/Sortable.min.js';
  import draggable from 'vuedraggable';

  export default {
    name: 'v-traverser',
    components: { draggable },
    model: {
      prop: 'traversables'
    },
    props: {
      traversables: { type: Array },
      options: { type: Object },
      depth: {type: Number, default: 1},
      childName: { type: String, default: 'children' },
    },
    data () {
      return {
        dTraversables: [],
        dDepth: 1,
      }
    },
    methods: {
      mTraversables () {
        let self = this;

        return {
          mount () {
            self.dTraversables = self.traversables;
            self.dDepth = self.depth;
          }
        }
      }
    },
    mounted () {
      this.mTraversables().mount();
    }
  }
</script>

<style lang="scss" scoped>
  /**/
  @for $i from 1 to 10 {
    .pad-#{$i} {
      padding-left: 15px * $i;
    }
  }
</style>
