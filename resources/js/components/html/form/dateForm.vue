<template>
    <div>
        <div v-show="editMode && !readOnly">
            <date v-model="value" :label="label"></date>
        </div>
        <value-form :label="label" :value="value" v-show="!editMode || readOnly" />
    </div>
</template>
<script>
import valueForm from './valueForm';
import date from './date';
export default {
    components:{
        valueForm,
        date
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
            showPicker:false,
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