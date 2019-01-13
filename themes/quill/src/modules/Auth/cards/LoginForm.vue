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
                                    <input id="email" type="text" class="form-control" v-model="email" name="username" required autofocus>
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
                                    <button @click="handleSubmit" type="submit" class="btn btn-primary">
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
import Cookies from 'js-cookie';
import user from '@/utils/user/user';

export default {
  created() {
    if (user.isLoggedIn()) {
      // this.$router.push({name: 'dashboard.index'});
    }
  },
  data(){
    return {
      csrfToken: window.$csrfToken,
      email: '',
      password: '',
    }
  },
    methods : {
        handleSubmit(e){
            e.preventDefault()

            axios.post('api/v1/login', {
                username: this.email,
                password: this.password
              })
              .then(response => {
                console.log(response.data)
                if (response.data.success) {
                  this.$router.push({name: 'dashboard.index'});
                }
              })
              .catch(function (error) {
                console.error(error);
              });
            if (this.password.length > 0) {
            }
        }
    },
    beforeRouteEnter (to, from, next) {
        if (localStorage.getItem('jwt')) {
            return next('board');
        }

        next();
    }
}
</script>
