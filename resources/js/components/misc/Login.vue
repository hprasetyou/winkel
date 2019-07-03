<template>
    <v-card>
        <v-card-text>
            <form @submit="doLogin()">
                <v-text-field v-model="credential.username" label="E-mail" required></v-text-field>
                <v-text-field v-model="credential.password" type="password" class="input-group--focused"></v-text-field>
                <v-btn @click="doLogin" color="success">
                    Login
                </v-btn>
            </form>
        </v-card-text>
    </v-card>
</template>
<script>
import * as config from '../../res/config';

    export default {
        data() {
            return {
                credential: {}
            }
        },
        methods: {
            doLogin() {
                console.log('submitt');
                
                this.$http.post('/oauth/token', {
                    "client_id": config.API_CLIENT_ID,
                    "client_secret": config.API_CLIENT_SECRET,
                    "scope": "*",
                    "username": credential.username,
                    "password": credential.password,
                    "grant_type": "password"
                }).then(o => {
                    console.log(o);

                })
            }
        }
    }

</script>
