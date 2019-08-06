<template>
    <v-simple-table>
        <thead>
            <tr>
                <th v-for="(header, i) in headers" :key="i" class="text-left">{{header.text}}</th>
                <th v-if="editState">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,key) in itemData" :key="item.id">
                <input-cell v-for="(header, i) in headers" :key="i" :data="item" :conf="header" :editState="item.editState"/>
                <td v-if="editState">
                    <v-icon small class="mr-2" @click="clickEdit(key)">
                        edit
                    </v-icon>
                    <v-icon small @click="deleteRow(item)">
                        delete
                    </v-icon>
                </td>
            </tr>
        </tbody>
    </v-simple-table>
</template>
<script>
import inputCell from './table/inputCell.vue';
    export default {
        components:{
            inputCell
        },
        props: {
            headers: {
                type: Array
            },
            itemData: {
                type: Array
            },
            editState:{
                type:Boolean,
                default:false
            }
        },
        methods: {
            clickEdit(key){
              this.$set(this.itemData[key],'editState',!this.itemData[key].editState);              
            }
        },
    }

</script>
