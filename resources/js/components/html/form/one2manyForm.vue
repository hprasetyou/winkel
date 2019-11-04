<template>
    <div>
        <v-layout v-show="editMode && !readOnly">
            <v-autocomplete v-model="inputVal" :search-input.sync="search" :items="items" :label="label"
                item-text="text" item-value="value" @keyup="searchData">
                <template v-if="!disableAdd" v-slot:append-item>
                    <v-layout px-4>
                        <v-text-field label="New data" v-model="newData">
                            <v-icon slot="append" @click="addData" color="success">check</v-icon>
                        </v-text-field>
                    </v-layout>
                </template>
                <template v-if="itemImage" v-slot:item="data">
                    <v-list-item-avatar>
                        <img :src="data.item.image">
                    </v-list-item-avatar>
                    <v-list-item-content>
                        {{ data.item.text }}
                    </v-list-item-content>
                </template>
            </v-autocomplete>
        </v-layout>
        <div v-show="!editMode || readOnly">
            <value-form :label="label" :value="getItemValue(value)" v-show="!editMode || readOnly" />

            <v-layout row v-if="itemImage && itemData"><v-col
                    md="9"
                    offset-md="3">
                <v-img v-if="itemData[itemImage]" :src="itemData[itemImage]" />
            </v-col>
            </v-layout >
        </div>
    </div>
</template>
<script>
import valueForm from './valueForm';
export default {
    components:{
        valueForm
    },
        props: {
            disableAdd:{
                type: Boolean,
                default: false
            },
            propToShow:{
                type: String,
                default:'name'
            },
            itemImage:{},
            readOnly: {
                type: Boolean,
                default: false
            },
            editMode: {
                type: Boolean,
                default: false
            },
            value: {},
            label: {
                type: String
            },
            objUrl: {
                type: String
            }
        },
        data(){
            return {
                newData:'',
                inputVal:'',
                entries:[],
                search:'',
                inputReady: true
            }
        },
        computed:{
            itemData(){
                if(this.inputVal){
                    return this.entries.find(item => item.id == this.inputVal)
                }else{
                    return false;
                }
            },
            items(){
                return this.entries.map(item=>{
                    const props = this.propToShow.split("-");
                    let text = ''
                    for (const prop of props) {
                        text += item[prop] + ' '
                    }
                    const listItem = {value:item.id,text}
                    if(this.itemImage){
                        listItem.image = item[this.itemImage]
                    }
                    return listItem
                })
            }
        },
        mounted() {
            if(!this.inputVal){
                this.getData();
            }
        },
        methods:{
            getItemValue(key){
                let out = '';
                for (const item of this.items) {
                    if(item.value == key){
                        out = item.text
                    }
                }
                return out;
            },
            getData(s,byId = false) {
                let params = '';
                if(s){
                    params = `?q=${s}`;
                    if(byId){
                        params = `/${s}`;
                    }
                }
                return new Promise((resolve,reject)=>{
                this.axios.get(`/api/${this.objUrl}${params}`)
                            .then(response => {
                                if(byId){
                                    this.entries.push(response.data);
                                }else{
                                    this.entries = response.data.data;
                                }
                                resolve(response)
                            })
                })
            },
            addData(){
                this.axios.post(`/api/${this.objUrl}`,{
                    name:this.newData
                }).then(response => {
                        this.entries.push(response.data)
                        this.inputVal = {
                                value: response.data.id,
                                text: response.data.name
                        }
                        this.newData = ''
                    })
            },
            searchData(){
                const val = this.search;
                if(this.inputReady){
                    this.getData(val).then(data=>{
                        this.inputReady = false;
                    })
                }else{
                    setTimeout(() => {
                        this.inputReady = true;
                    }, 1000);
                }
            }
        },
        watch:{
            value(){
                this.inputVal = this.value;
                this.inputVal = this.value;
                const exist = this.items.find(item=>item.value == this.value);
                if(!exist){
                    this.getData(this.value,true)
                }
                
            },
            inputVal(){
                // this.value = this.inputVal;
                this.$emit('input',this.inputVal);
        }
    }
    }

</script>
