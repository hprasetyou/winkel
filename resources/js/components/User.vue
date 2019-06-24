<template>
    <div>
       <winkle-table :headers="header" :dataUrl="dataUrl">
           
       </winkle-table>
    </div>
</template>

<script>
    import winkleTable from './html/winkelTable.vue'
    export default {
        components:{
            winkleTable
        },
        data(){
            return {
                dataUrl:'/api/user',
                header: [{
                        text: 'ID',
                        align: 'left',
                        value: 'id'
                    },
                    {
                        text: 'Email',
                        value: 'email'
                    },
                    {
                        text: 'Name',
                        value: 'name'
                    }
                ]
            }
        }
       
    }

</script>
