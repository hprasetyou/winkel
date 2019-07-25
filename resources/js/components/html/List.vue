<template>
    <div>
        <v-layout row pa-3>
            <h3>{{ title }}</h3>
            <v-spacer></v-spacer>
            <v-btn color="primary" :to="`${this.$route.path}/new`">New</v-btn>
        </v-layout>
        <v-divider></v-divider>
        <br>
       <winkle-table @editRow="cellClicked" :headers="header" :dataUrl="dataUrl">
       </winkle-table>
       
    </div>
</template>

<script>
    import winkleTable from './winkelTable.vue';

    export default {
        components:{
            winkleTable
        },
        data(){
            return {
                title: '',
                dataUrl:'',
                header: []
            }
        },
        mounted() {
            this.updateConf()
        },
        methods: {
            cellClicked(data){
                this.$router.push(`${this.$route.path}/${data.id}`)
                
            },
            updateConf(){
                this.title = this.$route.meta.title;
                this.header = this.$route.meta.header;
                this.dataUrl = this.$route.meta.dataUrl;
            }
        },
        watch: {
            '$route.path':function(to, from){
                this.updateConf();
            }
        }
       
    }

</script>
