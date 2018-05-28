<template>
  <section>
    <v-toolbar dark color="primary" class="elevation-2 sticky">
      <v-btn icon exact :to="{name: 'users.index'}"><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title v-html="trans('Create User')"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn color="secondary" v-html="trans('Save')"></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-form ref="form" v-model="resource.form.model">
        <v-layout row wrap>
          <v-flex xs12 sm8 md9>
            <v-card>
              <v-subheader tag="h1" v-html="trans('Basic Information')"></v-subheader>
              <v-card-text>
                <v-layout row wrap class="ma-0">
                  <v-text-field
                  :label="trans('First Name')"
                  name="firstname"
                  prepend-icon="account_box"
                  v-focus
                  v-model="resource.item.firstname"
                  v-title
                  v-validate="'required'"
                  ></v-text-field>
                  <v-text-field
                  :label="trans('Middle Name')"
                  name="middlename"
                  v-model="resource.item.middlename"
                  v-title
                  ></v-text-field>
                  <v-text-field
                  :label="trans('Last Name')"
                  name="lastname"
                  v-model="resource.item.lastname"
                  v-title
                  ></v-text-field>
                </v-layout>
              </v-card-text>
            </v-card>
          </v-flex>
          <v-flex xs12 sm4 md3>
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
        item: {
          firstname: '',
          middlename: '',
          lastname: ''
        },
        form: {
          model: false
        }
      }
    }
  }
}
</script>

<style lang="stylus">
</style>
