<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="/login">
                          <input type="hidden" name="_token" :value="csrfToken">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" v-model="username" name="username" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button @click.prevent="login" type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Cookies from 'js-cookie'
import user from '@/utils/user/user'
import store from '@/store'
import login from '@/utils/auth/login'

export default {
  store,

  data() {
    return {
      username: '',
      password: '',
      csrfToken: window.$csrfToken,
    }
  },

  methods: {
    login: function (e) {
      const { username, password } = this
      login({ username, password }).then(() => {
        this.$router.go('/admin')
      })
    },
  }
}
</script>
