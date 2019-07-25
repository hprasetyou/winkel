<template>
    <winkel-form :formDefinition="formDefinition" @data-updated="onUpdated" :dataUrl="dataUrl" :baseUrl="baseUrl" :title="title">
        <template v-slot:afterChilds>
            <v-card>
                    <v-simple-table>
                        <tbody>
                        <tr>
                            <td>Total</td>
                            <td>{{ data.total }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </v-simple-table>
            </v-card>
        </template>
    </winkel-form>
</template>
<script>
import winkelForm from '../../html/form/Form.vue';
export default {
    components:{
        winkelForm
    },
    data() {
        return {
            formDefinition:{},
            dataUrl:'',
            baseUrl:'',
            title:'',
            data:{}
        }
    },
    methods: {
        onUpdated(data){
            this.data = data;
        }
    },
    mounted() {        
        this.formDefinition = this.$route.meta.formDefinition
        this.dataUrl = this.$route.meta.dataUrl
        this.title = this.$route.meta.title;
        this.baseUrl = this.$route.meta.baseUrl;
    }
}
</script>