<template>
    <v-card>
        <v-toolbar color="teal" dark flat>
            <v-toolbar-title>Login form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form lazy-validation @submit="doLogin">
                <v-text-field v-model="credential.username" label="E-mail" required></v-text-field>
                <v-text-field v-model="credential.password" label="Password" type="password"
                    class="input-group--focused"></v-text-field>
            </v-form>
        </v-card-text>

        <v-card-actions>
            <div class="flex-grow-1"></div>
            <v-btn @click="doLogin" color="teal">Login</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
    import * as config from '../../res/config';
    import {
        mapMutations,
        mapGetters,
        mapActions
    } from "vuex";

    export default {
        data() {
            return {
                credential: {}
            }
        },
        computed:{
            ...mapGetters(["hasToken","getToken","getStore"])
        },
        methods: {
            ...mapMutations(["showSnackbar", "closeSnackbar","updateToken"]),
            ...mapActions(["getStoreFromApi"]),
            openSnackbar(options) {
                this.showSnackbar(options)
            },
            doLogin() {

                this.axios.post('/oauth/token', {
                    "client_id": config.API_CLIENT_ID,
                    "client_secret": config.API_CLIENT_SECRET,
                    "scope": "*",
                    "username": this.credential.username,
                    "password": this.credential.password,
                    "grant_type": "password"
                }).then(o => {
                    const token = o.data.access_token;
                    this.updateToken({token});
                    this.getStoreFromApi();
                    window.location = '/dashboard';
                }).catch(e => {                    
                    this.openSnackbar({
                        text: e,
                        color: "error"
                    })
                })
            }
        }
    }

</script>
