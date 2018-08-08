<template>
  <div>
      <v-card
        class="mb-5"
        >
        <v-tabs
          class="transparent"
          v-model="active"
          color="emphasis--medium"
          slider-color="accent"
          >
          <v-tab
            ripple
            key="overview"
            id="overview"
            >
            {{ trans('Overview') }}
          </v-tab>
          <v-tab
            ripple
            key="resources"
            id="overview"
            >
            {{ trans('Resources') }}
          </v-tab>

          <v-tab-item href="#overview">
            <v-card
              >
              <v-card-text>
                <div class="primary--text text--lighten-2 body-1">
                  <strong>PSDM SUP</strong>
                </div>
                <h2 v-html="course.title"></h2>
                <div class="grey--text">
                  {{ course.created }} {{ trans('by') }}
                  <a
                    class="author"
                    href=""
                    v-html="course.author"
                    >
                  </a>
                </div>
              </v-card-text>
              <v-card-text
                v-html="course.description"
                >
              </v-card-text>
            </v-card>
          </v-tab-item>
          <v-tab-item ref="#resources">
            <v-card
              flat
              class="pa-5 transparent"
              >
              <v-card-text class="text-xs-center">
                <assignment-icon width="60" height="60"></assignment-icon>
              </v-card-text>
              <v-card-text class="text-xs-center">
                {{ trans('No assignment for this course.') }}
              </v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs>
      </v-card>

      <!-- comment system -->
      <v-card
        flat
        class="transparent text-xs-center"
        >
        <comment-icon width="120" height="120"></comment-icon>
        <v-card-text class="grey--text">
          <h3>{{ trans('No comments yet') }}</h3>
          <p>Be the first to comment.</p>
        </v-card-text>
      </v-card>

      <!-- ckeditor@inline -->
      <v-card height="100" style="cursor: text;">
        <v-card-text>
          <p class="grey--text">
            {{ trans('Post a Comment...') }}
            <span><em>{{ trans('Sample comment card') }}</em></span>
          </p>
        </v-card-text>
      </v-card>
      <!-- ckeditor@inline -->
      <v-card-actions class="py-3 px-0">
        <v-spacer></v-spacer>
        <v-btn color="secondary">
          {{ trans('Post Comment') }}
        </v-btn>
      </v-card-actions>


    <!-- comment system -->
  </div>
</template>

<script>
export default {
  name: 'CourseResources',

  data () {
    return {
      course: {
        title: 'Communicate and Relate Effectively at the Workplace at Operations Level',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea corporis sapiente, blanditiis voluptas, commodi aliquid officia magni temporibus nulla iusto, unde corrupti deserunt ipsum error labore praesentium voluptatem ipsam saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dignissimos alias odio architecto atque minus earum, iste aliquam laboriosam, reprehenderit sint in quas voluptas, consequatur. Neque libero doloribus esse qui.',
        created: '3 weeks ago',
        author: 'Lemony Snicket',
      }
    }
  }
}
</script>

