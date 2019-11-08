<template>
    <td>
        <template v-if="item.type == 'method'">
            <div>
                {{ logicValue }}
            </div>
        </template>
        <template v-else>
            <component 
            :is="`${item.type}Form`" 
            :items="item.items" 
            :readOnly="item.readOnly" 
            :editMode="editState"
            :objUrl="item.objUrl" 
            :itemImage="item.itemImage" 
            v-model="data[item.model]" 
            :hideLabel="true"
            @valChange="onValChange"
            :disableAdd="item.disableAdd"
            :propToShow="item.propToShow" :label="item.label"></component>
        </template>

    </td>
</template>
<script>
    import selectForm from '../form/selectForm.vue';
    import imageForm from '../form/imageForm.vue';
    import inputForm from '../form/inputForm.vue';
    import one2manyForm from '../form/one2manyForm.vue';
    import textareaForm from '../form/textareaForm.vue';
    import dateForm from '../form/dateForm.vue';
    export default {
        components: {
            imageForm,
            inputForm,
            textareaForm,
            selectForm,
            one2manyForm,
            dateForm
        },
        props: ['item.value','parentEditMode', 'data', 'editState', 'item'],
        methods: {
            onValChange(val){
                
                return this.item.onChange(val,this.data);
            }
        },
        computed: {
            logicValue(){
               const refVal = [];
               this.item.reference.map(item =>{
                   refVal.push(this.data[item])
               });
               console.log(refVal);
               
               return this.item.value(refVal,this.data)
            }
        }
    }

</script>
