<template>
    <form method="POST" @submit.prevent="submit">
        <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
            <v-toolbar card class="white" prominent v-if="meta">
                <v-toolbar-title>{{meta.title}} <span v-if="meta.subtitle" class="grey--text">{{meta.subtitle}}</span></v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
                <v-layout row>
                    <input type="hidden" name="_token" :value="csrfToken">
                    <v-flex>
                        <v-text-field
                            :hint="errors.has('username')?errors.first('username'):''"
                            class="input-group"
                            label="Email or username"
                            name="username"
                            persistent-hint
                            type="text"
                            v-model="username"
                            data-vv-name="username"
                            v-validate="'required'"
                        ></v-text-field>
                        <v-text-field
                            :append-icon-cb="() => (visible = !visible)"
                            :append-icon="visible ? 'visibility' : 'visibility_off'"
                            :hint="errors.has('password')?errors.first('password'):''"
                            :type="visible ? 'text': 'password'"
                            class="input-group"
                            label="Password"
                            min="6"
                            name="password"
                            persistent-hint
                            v-model="password"
                            data-vv-name="password"
                            v-validate="'required'"
                        ></v-text-field>
                        <v-checkbox
                            :checked="remember"
                            @click="() => {remember = !remember}"
                            label="Remember Me"
                            light
                            v-model="remember"
                        ></v-checkbox>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-btn
                        primary
                        type="submit"
                    >
                        <v-progress-circular
                            v-if="submitting"
                            class="white--text"
                            indeterminate
                        ></v-progress-circular>
                        <span v-else>Login</span>
                    </v-btn>
                </v-layout>


                <template v-if="meta && meta.social">
                    <div class="hr">
                        <strong class="hr-text grey--text text--lighten-2">or</strong>
                    </div>
                    <v-layout>
                        <v-flex md6 class="text-xs-center">
                            <v-btn block class="color--google elevation-0">
                                <i class="fa fa-google">&nbsp;</i>
                                Google
                            </v-btn>
                        </v-flex>
                        <v-flex md6 class="text-xs-center">
                            <v-spacer></v-spacer>
                            <v-btn block class="color--facebook elevation-0">
                                <i class="fa fa-facebook">&nbsp;</i>
                                Facebook
                            </v-btn>
                        </v-flex>
                    </v-layout>
                </template>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-text>
                <v-layout row>
                    <slot></slot>
                </v-layout>
            </v-card-text>
        </v-card>
    </form>
</template>

<script>
    let Login = {
        name: 'login',
        props: ['meta', 'url'],
        data () {
            return {
                _token: window.csrfToken,
                username: '',
                password: '',
                remember: true,
                submitting: false,
                visible: false,
                rules: [],
            }
        },
        watch: {
            username() {
                return true;
            },
        },
        methods: {
            submit: function (e) {
                this.$validator.validateAll().then(result => {
                    this.submitting = true;

                    let requestBag = {
                        _token: this._token,
                        username: this.username,
                        password: this.password,
                        remember: this.remember,
                    };

                    axios.post(this.url, requestBag)
                        .then(response => {
                            if (response.data && ! response.data.success) {
                                this.errors = this.response.data;
                            } else {
                                window.location = response.data.redirect;
                            }

                            this.submitting = false;
                        })
                        .catch(error => {
                            if (error.response) {
                                console.log(error.response.data);
                            }

                            this.submitting = false;
                        });
                });
            },
        }
    }

    export default Login;
</script>

<style scoped src="./login.css"></style>
