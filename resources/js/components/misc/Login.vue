<template>
    <v-card>
        <v-card-text>
            <v-form lazy-validation @submit="doLogin">
                <v-text-field v-model="credential.username" label="E-mail" required></v-text-field>
                <v-text-field v-model="credential.password" type="password" class="input-group--focused"></v-text-field>
                <v-btn @click="doLogin" color="success">
                    Login
                </v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>
<script>
    import * as config from '../../res/config';
    import {
        mapMutations
    } from "vuex";

    export default {
        data() {
            return {
                credential: {}
            }
        },
        methods: {
            ...mapMutations(["showSnackbar", "closeSnackbar"]),
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
                    console.log(o);

                }).catch(e => {
                    console.log(e);
                    
                    this.openSnackbar({
                        text: e,
                        color: "error"
                    })
                })
            }
        }
    }

</script>
