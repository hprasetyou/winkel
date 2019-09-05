<template>
    <div>
        <v-text-field v-show="editMode && !readOnly" :label="label" v-model="inputVal" required>
        </v-text-field>
        <v-layout row px-3 wrap v-show="!editMode || readOnly">
            <v-flex xs3>
                <label for="">{{ label }}</label>
            </v-flex>
            <v-flex xs9>
                <label for="">{{ value }}</label>
            </v-flex>
        </v-layout>
    </div>
</template>
<script>
export default {
    props:{
        readOnly:{
            type:Boolean,
            default:false
        },
        editMode:{
            type:Boolean,
            default:false
        },
        value:{},
        label:{
            type:String
        }
    },
    data(){
        return {
            inputVal:''
        }
    },
    watch:{
        value(){
            this.inputVal = this.value;
        },
        inputVal(){
            // this.value = this.inputVal;
            this.$emit('input',this.inputVal);
        }
    }
}
</script>