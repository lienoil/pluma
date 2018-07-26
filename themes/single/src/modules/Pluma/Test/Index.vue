<template v-cloak>
  <section>
    <toolbar-menu :items="toolbarMenu">
    </toolbar-menu>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex md9 xs12>
          <v-card flat class="mb-3 text-xs-center">
            <v-card-title
              class="emphasis--medium"
              >
              Dialogbox
            </v-card-title>
            <v-card-text>
              <dialogbox></dialogbox>
              <v-btn
                color="secondary"
                @click="openDialogbox"
                >
                Open Dialog Test
              </v-btn>
            </v-card-text>
          </v-card>

          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              Icon Menu
            </v-card-title>
            <v-card-text>
              <icon-menu :items="iconmenu"></icon-menu>
            </v-card-text>
          </v-card>

          <!-- <v-card class="mb-3">
            <v-card-media>

            </v-card-media>
            <lightbox
              id="mylightbox"
              :images="dataset.images"
              :image_class=" 'img-responsive' "
              :album_class=" 'my-album-class' "
              :options="options">
            </lightbox>
          </v-card> -->
        </v-flex>

        <v-flex md3 xs12>
          <v-card class="mb-3">
            <v-card-title class="emphasis--medium">
              Tag Card
            </v-card-title>
            <v-card-text>
              <tag :items="tag"></tag>
            </v-card-text>
          </v-card>

          <v-card class="mb-3">
            <v-card-title>
              Category Card
            </v-card-title>
            <v-card-text>
              <category :items="category"></category>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-flex xs12>
          <data-iterator :items="library"></data-iterator>

          <!-- grid / list view -->
          <template v-if="toolbarMenu.list">
            <data-table :items="courses"></data-table>
          </template>

          <template v-else>
            <data-iterator :items="courses"></data-iterator>
          </template>
          <!-- grid / list view -->
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<style>
  .v-input__slot {
    margin-bottom: 0;
  }
</style>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'
import Lightbox from 'vue-simple-lightbox'

export default {
  store,

  components: {
    Lightbox,
  },

  data () {
    return {
      dataset: {
        images: [
          {
            src: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            title: 'Lightbox Image Title'
          },
          {
            src: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            title: 'Byrushan'
          }
        ],
      },

      toolbarMenu: {
        color: 'primary',
        list: false,
        raisedColor: 'secondary',
        raisedTitle: 'Create',
      },

      createCategory: {
        multiple: false,
      },

      iconmenu: {
        model: '',
        label: 'Choose Icon Menu'
      },

      category: {
        hasSaved: false,
        isEditing: true,
        categoryList: false,
        categoryCreate: true,
        label: 'Choose Category',
        items: [
          { name: 'Video', icon: 'mdi-anchor' },
          { name: 'Image', icon: 'photo' },
        ],
        chipColor: 'secondary',
        iconColor: 'white--text',
      },

      tag: {
        model: [],
        clearable: false,
        items: [
          'Programming',
          'Reading',
          'Eating'
        ],
      },

      courses: {
        selected: [],
        bulkDestroy: false,
        selectAll: true,
        search: '',
        cardLink: 'tests/show',
        chip: true,
        hover: true,
        lg3: false,
        showMimetype: false,
        showToolbar: false,
        headers: [
          { text: '', value: 'selected' },
          { text: 'ID', value: 'id' },
          { text: 'Featured', value: 'thumbnail' },
          { text: 'Title', value: 'title' },
          { text: 'Category', value: 'category' },
          { text: 'Timestamp', value: 'timestamp' },
          { text: 'Part', value: 'part' },
          { text: 'Status', value: 'status' },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false,
            align: 'center'
          },
        ],
        items: [
          {
            id: '1',
            title: 'Develop Personal Effectiveness at Operations Level',
            thumbnail: '//cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
            status: 'enrolled'
          },
          {
            id: '2',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//cdn.dribbble.com/users/904433/screenshots/2994633/animation_fin.gif',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '3',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
          {
            id: '4',
            title: 'Develop Personal Effectiveness at Supervisory Level',
            thumbnail: '//i.pinimg.com/564x/74/2b/8e/742b8e6e87ef56e698b9c8bc4e930dae.jpg',
            category: 'DPE OPS',
            timestamp: '2 hours ago',
            description: 'Apply knowledge and skills such as establishing personal goals and relating them to workplace goals. Far far away, behind the word',
            part: '6',
          },
        ]
      },

      library: {
        cardMediaHeight: '120px',
        pagination: {
          rowsPerPage: 6
        },
        showToolbar: true,
        cardActions: false,
        lg2: true,
        lg3: false,
        md2: true,
        md4: false,
        showCardText: false,
        showPart: false,
        xs12: false,
        items: [
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: 'https://cdn.dribbble.com/users/2559/screenshots/3145041/illushome_1x.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/1.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/2.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/3.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/4.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          },
          {
            title: 'Ubuntu Solarized Wallpaper',
            thumbnail: '//byrushan.com/projects/ma/1-6-1/jquery/dark/img/headers/sm/5.png',
            timestamp: '3 hours ago',
            mimetype: 'image/png',
            size: '24 KB',
            icon: 'photo'
          }
        ]
      },
    }
  },

  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox',
      iconmenu: 'iconmenu/iconmenu',
      dataiterator: 'dataiterator/dataiterator',
      toolbar: 'toolbar/toolbar',
    })
  },

  methods: {
    toggleList () {
      this.dataset.list = !this.dataset.list
    },

    toggleGrid () {
      this.dataset.list = !this.dataset.grid
    },

    openDialogbox () {
      this.$store.dispatch(
        'dialogbox/PROMPT_DIALOG',
        Object.assign(
          this.dialogbox,
          {
            model: true,
            // icon: 'add',
            // iconColor: 'success--text',
            image: '//img.stackshare.io/stack/26394/laravel_logo-circle-tp-xs.png',
            title: 'Delete Resources',
            text: 'You are about to permanently delete those resources.This action is irreversible. Do you want to proceed?',
            persistent: true,
            width: '100%',
            alignedCenter: true,

            actionText: 'Delete',
            actionColor: 'error',
            actionCallback () {
              this.model = false
              // store.dispatch.saveUserOrSomeShitLikeThat
              // then...
            },

            discard: false,
          }
        )
      )
    },

    // toggleAll () {
    //   if (this.courses.selected.length) this.courses.selected = []
    //   else this.courses.selected = this.courses.items.slice()
    // },

    changeSort (column) {
      if (this.courses.pagination.sortBy === column) {
        this.courses.pagination.descending = !this.courses.pagination.descending
      } else {
        this.courses.pagination.sortBy = column
        this.courses.pagination.descending = false
      }
    },

    save () {
      this.category.isEditing = !this.category.isEditing
      this.category.hasSaved = true
    }
  }
}
</script>
