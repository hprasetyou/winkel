<template>
    <div>
        <v-layout row>
            <h3>{{ title }}</h3>
            <v-spacer></v-spacer>
            <v-btn color="" @click="$router.push(baseUrl)">
                Back
            </v-btn>
            <v-btn color="error" @click="deleteConfirmation">
                Delete
            </v-btn>
            <v-btn color="primary" @click="editMode = !editMode">{{ editMode?'Cancel':'Edit' }}</v-btn>
            <v-btn color="success" @click="saveData" v-if="editMode">
                Save
            </v-btn>
        </v-layout>
        <v-divider></v-divider>
        <br>
        <v-card>
            <v-card-text>
                <v-form ref="form">
                    <v-layout row wrap>
                        <v-flex xs6 px-2 v-for="(group, g) in ['left','right']" :key="g">
                            <template v-if="formDefinition[group]">
                                <div v-for="(item,i) in formDefinition[group]" :key="i">
                                    <v-text-field v-show="editMode" :label="item.label" v-model="data[item.model]"
                                        required>
                                    </v-text-field>
                                    <v-layout row wrap v-show="!editMode">
                                        <v-flex xs3>
                                            <label for="">{{ item.label }}</label>
                                        </v-flex>
                                        <v-flex xs9>
                                            <label for="">{{ data[item.model] }}</label>
                                        </v-flex>
                                    </v-layout>
                                </div>
                            </template>
                        </v-flex>
                    </v-layout>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
    import { mapMutations } from "vuex";
    export default {
        data() {
            return {
                editMode: false,
                formDefinition: [],
                dataUrl: '',
                data: {},
                baseUrl: '',
                title: ''
            }
        },
        mounted() {
            this.formDefinition = this.$route.meta.formDefinition
            this.dataUrl = this.$route.meta.dataUrl
            this.title = this.$route.meta.title;
            this.baseUrl = this.$route.meta.baseUrl;
            this.getData();
        },
        methods: {
            ...mapMutations(["showSnackbar", "closeSnackbar"]),
            openSnackbar(options) {
                this.showSnackbar(options)
            },
            getData() {
                this.axios.get(`${this.dataUrl}/${this.$route.params.id}`)
                    .then(response => {
                        this.data = response.data;
                    })
            },
            saveData() {
                this.axios.put(`${this.dataUrl}/${this.$route.params.id}`, this.data)
                    .then(response =>{
                        this.data = response.data;
                        this.openSnackbar({
                            text:"All changes saved!",
                            color: "success"
                        })
                        this.editMode = false;
                    }).catch(err => {
                        this.openSnackbar({
                            text:"An error has occured",
                            color: "error"
                        })
                    })
            },
            deleteConfirmation(){
                this.$confirm('Delete this data?').then(res => {
                    if(res){
                        this.deleteData();
                    }
                })
            },
            deleteData() {
                this.axios.delete(`${this.dataUrl}/${this.$route.params.id}`)
                    .then(response => {
                        this.$router.push(this.baseUrl);
                        this.openSnackbar({
                            text:"Data has been deleted!",
                            color: "success"
                        })
                    })
            },

        },
    }

</script>
