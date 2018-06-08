<template>
  <section>
    <v-toolbar dark color="primary" class="elevation-2 sticky">
      <v-btn icon exact :to="{name: 'users.index'}"><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title v-html="trans('Create account')"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon><v-icon>more_vert</v-icon></v-btn>
      <v-btn large color="secondary" v-html="trans('Save')"></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-form ref="form" lazy-validation v-model="resource.form.model" autocomplete="off">
        <input type="hidden" name="_token" :value="resource.item._token">
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
                  data-vv-validate-on="blur"
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
                  data-vv-validate-on="blur"
                  name="middlename"
                  v-model.lazy="resource.item.middlename"
                ></v-text-field>
                <v-text-field
                  :data-vv-as="trans('Last name')"
                  :error-messages="errors.collect('lastname')"
                  :label="trans('Last Name')"
                  box
                  data-vv-validate-on="blur"
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
                  data-vv-validate-on="blur"
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
                  data-vv-validate-on="blur"
                  name="username"
                  v-model.lazy="resource.item.username"
                  v-validate="'required|unique:users,username'"
                ></v-text-field>
                <v-text-field
                  :append-icon-cb="() => (resource.passwordVisible = !resource.passwordVisible)"
                  :append-icon="resource.passwordVisible ? 'visibility' : 'visibility_off'"
                  :data-vv-as="trans('Password')"
                  :error-messages="errors.collect('password')"
                  :label="trans('Password')"
                  :type="resource.passwordVisible ? 'text': 'password'"
                  autocomplete="off"
                  box
                  data-vv-validate-on="blur"
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
                  autocomplete="off"
                  box
                  data-vv-validate-on="blur"
                  name="password_confirmation"
                  :type="resource.passwordVisible ? 'text': 'password'"
                  v-model.lazy="resource.item.password_confirmation"
                  v-validate="'required'"
                ></v-text-field>

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
                      :data-vv-as="trans('Birthday')"
                      :error-messages="errors.collect('birthday')"
                      :label="trans('Birthday')"
                      append-icon="birthday"
                      autocomplete="off"
                      box
                      data-vv-validate-on="blur"
                      name="birthday"
                      v-model.lazy="resource.item.details.birthday"
                      v-validate="'date'"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
          </v-flex>
          <v-flex xs12 sm4 md3 lg3>
            <p v-for="(item, i) in resource.item" :key="i">
              {{ i }}: {{ item }}
            </p>
          </v-flex>
        </v-layout>
      </v-form>
    </v-container>
  </section>
</template>

<script>
export default {
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
          details: {}
        },
        form: {
          dirty: false,
          model: false
        }
      }
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
    }
  },
  beforeRouteLeave (to, from, next) {
    if (this.resource.form.dirty) {
      this.$root.dialogbox({
        color: 'warning',
        title: 'Are you sure you want to leave this page?',
        text: 'You have made changes. They will be lost if you continue without saving.',
        width: '',
        actionText: 'Leave',
        actionCallback () {
          this.model = false
          next()
        },
        cancelCallback () {
          next(false)
        }
      })
    } else {
      next()
    }
  }
}
</script>

<style lang="stylus">
</style>
