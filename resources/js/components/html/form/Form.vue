<template>
    <div>
        <v-form ref="form">
            <v-layout row pa-3>
                <h3>{{ title }}</h3>
                <v-spacer></v-spacer>
                <v-btn color="" @click="$router.push(baseUrl)">
                    Back
                </v-btn>
                <v-btn color="error" v-if="!isNew" @click="deleteConfirmation">
                    Delete
                    <v-icon dark right>delete</v-icon>
                </v-btn>
                <v-btn color="primary" @click="editMode = !editMode">{{ editMode?'Cancel':'Edit' }}
                    <v-icon dark right>{{ editMode?'cancel':'edit' }}</v-icon></v-btn>
                <v-btn color="success" @click="saveData" v-if="editMode">
                    Save
                    <v-icon dark right>check</v-icon>
                </v-btn>
                <slot name="additional-actions"></slot>
            </v-layout>
            <v-divider></v-divider>
            <br>
            <v-card>
                <v-card-text>
                    <v-layout row wrap>
                        <v-flex lg4 mb-5 xs12 px-3 v-for="(group, g) in ['left','center','right']" :key="g">
                            <template v-if="formDefinition[group]">
                                <div v-for="(item,i) in formDefinition[group]" :key="i">
                                    <component :is="`${item.type}Form`"
                                    :items="item.items"
                                    :readOnly="item.readOnly"
                                    :editMode="editMode"
                                    :objUrl="item.objUrl"
                                    :itemImage="item.itemImage"
                                    v-model="data[item.model]"
                                    :disableAdd="item.disableAdd"
                                    :propToShow="item.propToShow"
                                    :label="item.label"></component>
                                </div>
                            </template>
                        </v-flex>
                    </v-layout>
                </v-card-text>
            </v-card>
            <br>
            <v-card  v-for="(child, i) in formDefinition.child" :key="i">
                <v-card-title row>
                    <span>{{ child.label }}</span>
                    <v-spacer></v-spacer>
                    <v-btn color="" @click="data[child.model].push({})">
                        Add
                    </v-btn>
                </v-card-title>
                <popupForm :dialog="child.dialog" />
                <v-divider></v-divider>
                <winkel-simple-table :hideAction="true" :headers="child.header"  :editState="editMode" :itemData="data[child.model]" />
            </v-card>
            <br/>
            <slot name="afterChilds"></slot>
        </v-form>
    </div>
</template>
<script>
    import {
        mapMutations
    } from "vuex";
    import winkelSimpleTable from '../simpleTable';
    import selectForm from './selectForm.vue';
    import popupForm from './popupForm.vue';
    import imageForm from './imageForm.vue';
    import inputForm from './inputForm.vue';
    import one2manyForm from './one2manyForm.vue';
    import textareaForm from './textareaForm.vue';
    import dateForm from './dateForm.vue';
    export default {
        components: {
            winkelSimpleTable,
            popupForm,
            imageForm,
            inputForm,
            textareaForm,
            selectForm,
            one2manyForm,
            dateForm
        },
        props:{
            formDefinition:{
                type:Object,
                default(){
                    return []
                }
            },
            dataUrl:{
                type:String
            },
            baseUrl:{
                type:String
            },
            title:{
                type:String
            }
        },
        data() {
            return {
                editMode: false,
                isNew: false,
                data:{}
            }
        },
        mounted() {
            if (this.$route.params.id == 'new') {
                this.editMode = true;
                this.isNew = true;
            } else {
                this.getData();
            }
        },
        watch: {
            dataUrl: {
                handler() {
                    if (this.$route.params.id == 'new') {
                        this.editMode = true;
                        this.isNew = true;
                    } else {
                        this.getData();
                    }
                },
                deep: true
            }
        },
        methods: {
            ...mapMutations(["showSnackbar", "closeSnackbar"]),
            openSnackbar(options) {
                this.showSnackbar(options)
            },
            getData() {
                if(this.dataUrl.length > 4){
                    this.axios.get(`${this.dataUrl}/${this.$route.params.id}`)
                        .then(response => {
                            this.data = response.data;
                            this.$emit('data-updated',response.data)
                        })
                }
            },
            saveData() {
                let action = false;
                if (this.isNew) {
                    action = this.axios.post(`${this.dataUrl}`, this.data)
                } else {
                    action = this.axios.put(`${this.dataUrl}/${this.$route.params.id}`, this.data)
                }
                action.then(response => {
                    this.data = response.data;
                    this.openSnackbar({
                        text: "All changes saved!",
                        color: "green"
                    });
                    this.editMode = false;
                    if (this.isNew) {
                        this.isNew = false;
                        this.$router.push(`${this.baseUrl}/${response.data.id}`)
                    }
                    this.$emit('data-updated',response.data)
                }).catch(err => {
                    this.openSnackbar({
                        text: "An error has occured",
                        color: "error"
                    })
                })
            },
            deleteConfirmation() {
                this.$confirm('Delete this data?').then(res => {
                    if (res) {
                        this.deleteData();
                    }
                })
            },
            deleteData() {
                this.axios.delete(`${this.dataUrl}/${this.$route.params.id}`)
                    .then(response => {
                        this.$router.push(this.baseUrl);
                        this.openSnackbar({
                            text: "Data has been deleted!",
                            color: "green"
                        })
                    })
            },

        },
    }

</script>
