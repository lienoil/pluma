<template>
<v-card>
    <v-card-title class="text-xs-center">
      <img class="mb-3" width="80rem" :src="app.meta.logo" :alt="app.meta.title">
      <h4 class="headline" v-html="app.meta.title"></h4>
      <div class="subheading" v-html="app.meta.tagline"></div>
    </v-card-title>

    <v-card-text>

      <!-- Login Form -->
      <v-form lazy-validation v-model="resource.form.model" method="POST" autocomplete="off" @keyup.enter="login" @submit.prevent="login">

        <input type="hidden" v-model="resource.item._token" name="_token">

        <v-text-field
          :data-vv-as="trans('Username or Email')"
          :error-messages="errors.collect('username')"
          :label="trans('Username or Email')"
          autocomplete="off"
          box
          name="username"
          v-focus
          v-model="resource.item.username"
          v-validate="'required'"
          >
        </v-text-field>

        <v-text-field
          @click:append="() => (resource.item.passwordVisible = !resource.item.passwordVisible)"
          :append-icon="resource.item.passwordVisible ? 'visibility' : 'visibility_off'"
          :data-vv-as="trans('Password')"
          :error-messages="errors.collect('password')"
          :label="trans('Password')"
          :type="resource.item.passwordVisible ? 'text': 'password'"
          autocomplete="off"
          box
          name="password"
          v-model="resource.item.password"
          v-validate="'required'"
          >
        </v-text-field>

        <v-btn
          :loading="resource.form.loading"
          @click.prevent="login(resource.item)"
          block
          class="mx-0 mb-4"
          color="primary"
          large
          ripple
          type="submit"
          >
          {{ 'Login' }}
        </v-btn>

        <v-checkbox
          :label="trans('Remember me')"
          color="primary"
          hide-details
          name="remember"
          v-model="resource.item.remember"
          >
        </v-checkbox>
      </v-form>
      <!-- Login Form -->

    </v-card-text>

    <v-card-actions>
      <a
        class="text-emphasis--medium"
        exact
        :to="{name: 'password.forgot'}"
        v-html="trans('Forgot password?')"></a>
      <v-spacer></v-spacer>
      <a class="caption text-emphasis--medium" :to="{name: 'register.show'}" v-html="trans('Create Account')"></a>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  data () {
    return {
      app: {
        meta: {
          title: 'App Name'
        }
      },
      errors: { collect: function () {} },
      resource: { form: {}, item: {} }
    }
  },
}
</script>
