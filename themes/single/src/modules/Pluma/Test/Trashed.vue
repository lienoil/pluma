<template v-cloak>
  <section>
    <v-container fluid grid-list-lg>
      <v-flex xs12>
        <v-card>
          <v-card-text>
            <empty-state v-if="course.emptyState"></empty-state>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-container>
  </section>
</template>

<script>
import EmptyState from './partials/EmptyState.vue'

export default {
  components: {
    EmptyState
  },
  data () {
    return {
      course: {
        emptyState: true,
        orderMd3: false,
        md8: true,
        md4: true,
        title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea corporis sapiente, blanditiis voluptas, commodi aliquid officia magni temporibus nulla iusto, unde corrupti deserunt ipsum error labore praesentium voluptatem ipsam saepe.',
        created: '3 weeks ago',
        author: 'John Lenon',
        thumbnail: 'https://px6vg4ekvl21gtxs836x5jyx-wpengine.netdna-ssl.com/wp-content/uploads/2017/03/segmentation-hero@2x-1.png',
        chapters: [
          {
            chapterTitle: 'Chapter 1',
            chapterSubTitle: 'How to interpret and analyse information received',
          },
          {
            chapterTitle: 'Chapter 2',
            chapterSubTitle: 'How to plan a response to information received',
          },
          {
            chapterTitle: 'Chapter 3',
            chapterSubTitle: 'How to use appropriate communication techniques',
          }
        ],
      },
    }
  },
}
</script>
