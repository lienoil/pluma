<template>
    <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
        <v-toolbar card class="white" prominent v-if="meta">
            <v-toolbar-title>{{meta.title}} <span v-if="meta.subtitle" class="grey--text">{{meta.subtitle}}</span></v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
            <v-layout row>
                <v-flex>
                    <v-text-field
                        name="username"
                        label="Email or username"
                        class="input-group"
                        v-model="username"
                    ></v-text-field>
                    <v-text-field
                        name="password"
                        label="Password"
                        v-model="password"
                        @keyup.ctrl="() => (visible = !visible)"
                        hint="At least 6 characters"
                        min="6"
                        :append-icon="visible ? 'visibility' : 'visibility_off'"
                        :append-icon-cb="() => (visible = !visible)"
                        :type="visible ? 'text': 'password'"
                        class="input-group"
                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout>
                <v-btn primary type="submit" @click="() => (visible = !visible)" dark>Login</v-btn>
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
</template>

<script>
    let Login = {
        name: 'login',
        props: ['meta'],
        data () {
            return {
                visible: false,
            }
        }
    }

    export default Login;
</script>

<style scoped>
    @import "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
    .card--flex-toolbar--stylized {
        margin-top: -64px;
    }

    .hr {
        text-align: center;
        position: relative;
    }

    .hr:after,
    .hr:before {
        content: "";
        display: block;
        width: 40%;
        height: 1px;
        margin: 2px 1rem;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0,0,0,0.15);
    }

    .hr:after {
        text-align: left;
        position: absolute;
        left: 0;
    }
    .hr:before {
        position: absolute;
        text-align: right;
        right: 0;
    }

    [class*="application-"] .color--google:hover {
        background-color: #db3236;
        color: #fff;
    }
    [class*="application-"] .color--facebook:hover {
        background-color: #3a589e;
        color: #fff;
    }
</style>
