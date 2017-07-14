<template>
    <form method="POST" @submit.prevent="submit">
        <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="scale-transition">
            <v-toolbar card class="white" prominent v-if="meta">
                <v-toolbar-title>{{meta.title}} <span v-if="meta.subtitle" class="grey--text">{{meta.subtitle}}</span></v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text>
                <v-layout row>
                    <v-flex>
                        <v-text-field
                            name="email"
                            label="Email"
                            class="input-group"
                            v-model="email"
                            type="email"
                        ></v-text-field>
                        <v-text-field
                            name="password"
                            label="Password"
                            v-model="password"
                            hint="At least 6 characters"
                            min="6"
                            :append-icon="visible ? 'visibility' : 'visibility_off'"
                            :append-icon-cb="() => (visible = !visible)"
                            :type="visible ? 'text': 'password'"
                            class="input-group"
                        ></v-text-field>
                        <v-text-field
                            name="password_confirmation"
                            label="Confirm Password"
                            v-model="password_confirmation"
                            hint="Retype password"
                            min="6"
                            :append-icon="visible ? 'visibility' : 'visibility_off'"
                            :append-icon-cb="() => (visible = !visible)"
                            :type="visible ? 'text': 'password'"
                            class="input-group"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-btn primary dark type="submit">
                        <v-progress-circular
                            v-if="submitting"
                            class="white--text"
                            indeterminate
                        ></v-progress-circular>
                        <span v-else>
                            Register
                        </span>
                    </v-btn>
                </v-layout>
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
    let Register = {
        name: 'register',
        props: ['meta'],
        data () {
            return {
                visible: false,
                submitting: false,
            }
        },
        methods: {
            submit: function (e) {
                this.submitting = true;
            }
        }
    }

    export default Register;
</script>

<style scoped>
    .card--flex-toolbar--stylized {
        margin-top: -64px;
    }
</style>
