<template>
    <div>
       <winkle-table :title="title" :headers="header" :dataUrl="dataUrl">
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
