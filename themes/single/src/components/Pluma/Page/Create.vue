<template>
  <div>
    <v-toolbar light color="white" class="elevation-1 sticky">
      <v-toolbar-title class="grey--text text--darken-1">Create Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn ripple color="primary" @click="save(resource.item)">Save</v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex sm8>
            <input type="hidden" name="_token" :value="resource.token">

            <div class="mb-3">
              <v-text-field
                :error-messages="errors.collect('title')"
                label="Title"
                name="title"
                solo
                v-model="resource.item.title"
                v-validate="'required'"
                @input="resource.item.code = $options.filters.slugify(resource.item.title)"
              ></v-text-field>
              <p class="caption error--text mt-1" v-if="errors.has('title')" v-html="errors.first('title')"></p>
            </div>

            <v-card>
              <v-card-text>
                <v-text-field
                  :append-icon-cb="() => {resource.lock.code = !resource.lock.code}"
                  :append-icon="resource.lock.code ? 'lock' : 'lock_open'"
                  :error-messages="errors.collect('code')"
                  label="Code"
                  name="code"
                  v-bind="{'readonly': resource.lock.code}"
                  v-model="resource.item.code"
                  v-validate="'required'"
                ></v-text-field>
              </v-card-text>
              <v-text-field box multi-line></v-text-field>
              <!-- <img src="@/assets/editor.png" width="100%"> -->
            </v-card>
          </v-flex>
          <v-flex sm4>

            <mediabox icon="landscape" title="Featured Image"></mediabox>
            <v-divider></v-divider>

            <v-card>
              <v-card-text>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil maiores aliquam sit dolore facere saepe laborum velit ducimus error ipsa, quo cum non, impedit iure voluptatibus ullam illum tempore. Hic!
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis nihil aut voluptas, laborum quasi. Possimus autem ipsum unde omnis, rem aliquid illo, voluptates! Dolore nobis nostrum, veritatis ut eum deserunt!
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis repellat, officiis adipisci laborum sunt! Delectus, optio qui, officiis magni reiciendis quidem eveniet expedita, saepe culpa rem distinctio error ad voluptatem.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore amet id obcaecati, exercitationem eveniet? Autem accusamus eius similique suscipit in! Optio minima atque laboriosam accusamus, facere deserunt laudantium nobis cum.
                ad ab eaque maiores voluptatum aperiam, magni excepturi blanditiis quibusdam consequatur quos neque odio fuga labore quis earum dignissimos repudiandae eius natus! Libero at non obcaecati esse similique, expedita animi inventore doloremque qui accusamus suscipit laboriosam recusandae possimus mollitia eligendi quae consequuntur est natus, dignissimos quam cupiditate? Adipisci eaque ad dolorum ipsam dolorem inventore maiores laboriosam fuga eveniet earum excepturi, ea consequatur laborum, atque expedita alias rem dolore autem sed iste. Tempore vitae ab aliquid at dicta ipsa iste eos voluptatibus porro, aliquam, cupiditate ipsam sunt accusantium excepturi? Perspiciatis corrupti eveniet perferendis architecto laudantium tenetur, voluptatibus, facere sed quidem iusto minima autem illum cum temporibus voluptas et error repudiandae sint possimus sunt cumque ad minus nulla quo! Et totam, repellendus nisi quidem laborum porro ullam architecto ab obcaecati natus enim veniam iure tempore eligendi odio, sit eveniet vel repudiandae est vitae hic esse qui ex eaque! Dignissimos assumenda illo debitis iure voluptates sequi aliquam asperiores cum aperiam beatae delectus laudantium aut cupiditate sunt quis sint, minima velit nemo rerum deserunt ab in, veniam facere. Fugiat, dicta ut. Voluptatum asperiores, sapiente dolor necessitatibus iste optio voluptatem quod accusantium, distinctio hic impedit aut voluptate harum placeat laborum nostrum facilis rerum dolorem. Sequi, perferendis! Iure cum deleniti atque voluptas! Molestias magnam reprehenderit nemo eveniet, velit quisquam odio voluptatibus esse aliquam ipsa totam quidem dolorem officia sequi, earum quae magni molestiae commodi fugit recusandae quaerat, quia eligendi mollitia! Autem blanditiis fugit dolorum laudantium asperiores similique, fugiat quasi error maiores quas modi, vitae libero minus!
              </v-card-text>
            </v-card>

          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
    <v-snackbar
      :timeout="snackbar.timeout"
      :color="snackbar.color"
      :top="snackbar.y === 'top'"
      :bottom="snackbar.y === 'bottom'"
      :right="snackbar.x === 'right'"
      :left="snackbar.x === 'left'"
      v-model="snackbar.model"
    >
      <v-icon color="snackbar.color">{{ snackbar.icon }}</v-icon>
      &nbsp;<span v-html="snackbar.text"></span>
      <v-btn dark flat ripple @click="snackbar.model = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import Mediabox from '@/components/components/Mediabox.vue'

export default {
  name: 'Create',
  components: { Mediabox },
  data () {
    return {
      resource: {
        item: {
          title: '',
          code: '',
          feature: '',
          user_id: '',
          body: '',
          delta: ''
        },
        lock: {
          code: true
        },
        token: this.$token,
        errors: [],
        form: { model: true }
      },
      snackbar: {
        color: 'info',
        icon: 'info',
        timeout: 10000,
        model: false,
        text: '',
        x: 'right',
        y: 'top'
      }
    }
  },
  methods: {
    save (resource) {
      this.$http.post('/api/v1/pages/save', resource)
        .then(response => {
          let self = this

          switch (response.status) {
            case 200:
            default:
              this.snackbar = Object.assign(this.snackbar, {
                color: 'success',
                icon: 'check',
                model: true,
                text: 'Page successfully saved'
              })
              setTimeout(function () {
                self.$router.push({name: 'pages.index'})
              }, 900)
              break
          }
        })
        .catch(error => {
          this.snackbar = Object.assign(this.snackbar, {
            color: 'error',
            icon: 'error',
            model: true,
            text: 'An error occurred'
          })
          switch (error.response.status) {
            case 422:
            default:
              for (var key in error.response.data) {
                this.errors.add(key, error.response.data[key].join('\n'), 'server')
              }
              break
          }
        })
    }
  },
  mounted () {
    //
  }
}
</script>

<style scoped>
  /*DITO MUNA TO HA Pero lipat to sa global pag-kwan ;)*/
.sticky {
  position: -webkit-sticky;
  position:sticky;
  top:0;
  z-index:4
}
</style>
