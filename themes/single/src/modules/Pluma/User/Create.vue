<template>
  <v-form
    @keup.enter="submit"
    @submit.prevent="submit"
    autocomplete="off"
    ref="form"
    >
    <v-toolbar class="elevation-2 sticky">
      <v-btn icon exact :to="{name: 'users.index'}"><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title v-html="trans('Create User')"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn type="submit" color="primary" :loading="resource.form.loading" @click.native="submit()">{{ trans('Save') }}</v-btn>
      <!-- <v-divider class="vertical"></v-divider> -->
      <v-menu left>
        <v-btn slot="activator" icon><v-icon>more_vert</v-icon></v-btn>
        <v-list dense>
          <v-list-tile @click="draft" v-shortkey="['ctrl', 'shift', 'p']" @shortkey="draft">
            <v-list-tile-action><v-icon>save</v-icon></v-list-tile-action>
            <v-list-tile-content>{{ trans('Save as draft') }}</v-list-tile-content>
          </v-list-tile>
          <v-divider></v-divider>
          <v-list-tile @click="reset" v-shortkey="['alt', 'r']" @shortkey="reset">
            <v-list-tile-action><v-icon>refresh</v-icon></v-list-tile-action>
            <v-list-tile-content>{{ trans('Delete and reset fields values') }}</v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <input type="hidden" name="_token" :value="resource.item._token">
      <input type="hidden" name="api_token" :value="resource.item.api_token">
      <v-layout row wrap>
        <v-flex xs12 sm8 md9 lg9>
          <v-card>
            <v-card-text>
              <div class="body-2 pa-0" v-html="trans('Basic Information')"></div>
              <v-text-field
                :data-vv-as="trans('First name')"
                :error-messages="errors.collect('firstname')"
                :label="trans('First Name')"
                box
                name="firstname"
                v-focus
                v-model.lazy="resource.item.firstname"
                v-validate="'required'"
              ></v-text-field>
              <v-text-field
                :data-vv-as="trans('Middle name')"
                :error-messages="errors.collect('middlename')"
                :label="trans('Middle Name')"
                box
                name="middlename"
                v-model.lazy="resource.item.middlename"
              ></v-text-field>
              <v-text-field
                :data-vv-as="trans('Last name')"
                :error-messages="errors.collect('lastname')"
                :label="trans('Last Name')"
                box
                name="lastname"
                v-model.lazy="resource.item.lastname"
                v-validate="'required'"
              ></v-text-field>

              <div class="body-2 pa-0 mt-4" v-html="trans('Account')"></div>
              <v-text-field
                :data-vv-as="trans('Email')"
                :error-messages="errors.collect('email')"
                :label="trans('Email')"
                append-icon="alternate_email"
                autocomplete="off"
                box
                name="email"
                type="email"
                v-model.lazy="resource.item.email"
                v-validate="'required|email'"
              ></v-text-field>
              <v-text-field
                :data-vv-as="trans('User Name')"
                :error-messages="errors.collect('username')"
                :label="trans('User Name')"
                append-icon="account_circle"
                autocomplete="off"
                box
                name="username"
                v-model.lazy="resource.item.username"
                v-validate="'required'"
              ></v-text-field>
              <!-- unique:users,username -->
              <v-text-field
                :append-icon-cb="() => (resource.passwordVisible = !resource.passwordVisible)"
                :append-icon="resource.passwordVisible ? 'visibility' : 'visibility_off'"
                :data-vv-as="trans('Password')"
                :error-messages="errors.collect('password')"
                :label="trans('Password')"
                :type="resource.passwordVisible ? 'text': 'password'"
                autocomplete="off"
                box
                name="password"
                v-model.lazy="resource.item.password"
                v-validate="'required'"
              ></v-text-field>

              <v-text-field
                :append-icon-cb="() => (resource.passwordVisible = !resource.passwordVisible)"
                :append-icon="resource.passwordVisible ? 'visibility' : 'visibility_off'"
                :data-vv-as="trans('Confirm Password')"
                :error-messages="errors.collect('password_confirmation')"
                :label="trans('Confirm Password')"
                :type="resource.passwordVisible ? 'text': 'password'"
                autocomplete="off"
                box
                name="password_confirmation"
                v-model.lazy="resource.item.password_confirmation"
                v-validate="'required'"
              ></v-text-field>

              <input type="text" v-for="(role, i) in resource.item.roles" name="roles[]" :value="role">

              <div class="body-2 pa-0 mt-4" v-html="trans('Background Details')"></div>
              <v-layout row wrap>
                <v-flex xs3>
                  <v-radio-group
                    v-model="resource.item.details.gender"
                  >
                    <v-radio
                      :key="gender"
                      :label="gender"
                      :value="gender"
                      color="primary"
                      ripple
                      class="mb-3"
                      v-for="gender in ['Female', 'Male']"
                    ></v-radio>
                  </v-radio-group>
                </v-flex>
                <v-flex xs9>
                  <v-text-field
                    :append-icon-cb="() => { resource.calendar.model = !resource.calendar.model }"
                    :data-vv-as="trans('Birthday')"
                    :error-messages="errors.collect('birthday')"
                    :hint="`MM/DD/YYYY ${trans('format')}`"
                    :label="trans('Birthday')"
                    append-icon="calendar_today"
                    autocomplete="off"
                    box
                    name="birthday"
                    v-model.lazy="resource.item.details.birthday"
                  ></v-text-field>
                  <v-dialog
                    :close-on-content-click="false"
                    absolute
                    full-width
                    lazy
                    max-width="290px"
                    min-width="290px"
                    offset-y
                    transition="scale-transition"
                    v-model="resource.calendar.model"
                  >
                    <v-date-picker v-model="resource.item.details.birthday" reactive></v-date-picker>
                  </v-dialog>
                </v-flex>
              </v-layout>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  $_veeValidate: {
    validator: 'new'
  },
  name: 'UserCreate',
  data () {
    return {
      resource: {
        passwordVisible: false,
        item: {
          _token: this.$root.$token,
          api_token: this.$user.token,
          firstname: '',
          middlename: '',
          lastname: '',
          roles: [],
          details: {}
        },
        calendar: {
          model: false
        },
        form: {
          loading: false,
          dirty: false,
          model: false
        }
      }
    }
  },

  computed: {
    ...mapGetters({
      snackbar: 'snackbar/snackbar',
      dialogbox: 'dialogbox/dialogbox'
    })
  },

  methods: {
    toast (snack, hide) {
      if (typeof hide !== 'undefined' && hide) {
        this.$store.dispatch('snackbar/HIDE_TOAST', Object.assign(this.snackbar, snack, { model: false }))
      } else {
        this.$store.dispatch('snackbar/SHOW_TOAST', Object.assign(this.snackbar, snack, { model: true }))
      }
    },

    prompt (config) {
      this.$store.dispatch('dialogbox/PROMPT_DIALOG', Object.assign(this.dialogbox, config, { model: true }))
    },

    draft () {
      alert("That's the command for saving to draft")
    },

    reset () {
      this.$refs['form'].reset()
      this.$validator.reset()
      this.resource.form.loading = false
      this.toast({text: 'Form was reset', buttonIcon: 'close'})
    },

    submit () {
      // this.resource.form.loading = true
      // this.$validator.validate()
      //   .then(success => {
      //     if (success) {
      //       this.$store.dispatch(USER_STORE, this.resource.items)
      //         .then(({data, status}) => {
      //           if (data && status === 200) {
      //             this.reset()
      //             this.$root.alert({
      //               text: this.trans(data.text)
      //             })
      //           }
      //         })
      //         .catch(err => {
      //           this.$root.alert({
      //             // color: 'error',
      //             text: this.trans('An unknown error occured.')
      //           })
      //           console.log('UserCreateError', err)
      //         })
      //     }

      //     this.resource.form.loading = false
      //   })
    }
  },

  watch: {
    'resource.item.firstname' (value) {
      this.resource.form.dirty = true
    },
    'resource.item.username' (value) {
      this.resource.form.dirty = true
    },
    'resource.item.email' (value) {
      this.resource.form.dirty = true
    },
    'resource.item.details.birthday' (date) {
      if (!date) {
        return null
      }

      const [year, month, day] = date.split('-')

      return `${month}/${day}/${year}`
    }
  },

  beforeRouteLeave (to, from, next) {
    let self = this

    if (this.resource.form.dirty) {
      this.prompt({
        title: 'You have unsaved changes',
        text: 'You will lose your data permanently when you navigate away without saving.',
        persistent: false,

        actionText: 'Save to Drafts',
        actionCallback () {
          this.model = false
          // store.dispatch.saveUserOrSomeShitLikeThat
          // then...
          self.toast({text: 'User saved to drafts'})
          next()
        },

        discard: true,
        discardText: 'Discard changes',
        discardCallback () {
          this.model = false
          self.toast({
            text: 'Data was discarded',
            timeout: 8000,
            buttonCallback () {
              this.model = false
            }
          })
          next()
        }
      })
      // this.$root.dialogbox({
      //   saveAsDraftCallback () {
      //     this.model = false
      //     setTimeout(function () {
      //       self.$root.alert({
      //         text: 'User saved to draft',
      //         timeout: 20000000,
      //         x: 'right',
      //         y: 'bottom'
      //       })
      //       next()
      //     }, 900)
      //   },
      //   cancelCallback () {
      //     this.model = false
      //     next(false)
      //   },
      //   discardCallback () {
      //     this.model = false
      //     next()
      //   }
      // })
      // next(false)
    } else {
      next()
    }
  }
}
</script>

<style lang="stylus">
  .dark {
    background-color: #000;
  }
  .light {
    background-color: #fff;
  }
</style>
