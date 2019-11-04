<template>
    <div>
        <v-text-field v-show="editMode && !readOnly" :label="label" v-model="inputVal" required>
        </v-text-field>
        <value-form :label="label" :value="value" v-show="!editMode || readOnly" />
    </div>
</template>
<script>
import valueForm from './valueForm';
export default {
    components:{
        valueForm
    },
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