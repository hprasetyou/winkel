<template>
    <div>
        <v-layout v-show="editMode && !readOnly"  >
            <div>
                <v-select :items="items" 
                :label="label"  
                item-text="text"
                v-model="inputVal"
                item-value="value"></v-select>
            </div>
        </v-layout>
        <value-form :label="label" :value="getItemValue(value)" v-show="!editMode || readOnly" />
    </div>
</template>
<script>
import valueForm from './valueForm';
export default {
    components:{
        valueForm
    },
        props: {
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
            items: {
                type: Array,
                default () {
                    return []
                }
            }
        },
        data(){
            return {
                inputVal:''
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
            }
        },
        watch:{
            value(){
                console.log('changee');
                
                this.inputVal = this.value;
            },
            inputVal(){
                // this.value = this.inputVal;
                this.$emit('input',this.inputVal);
        }
    }
    }

</script>
