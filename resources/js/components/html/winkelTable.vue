<template>
    <div>
        <v-data-table v-model="selected" select-all :headers="headers" :items="tableData" :pagination.sync="pagination"
        :rows-per-page-items="[15,30,50]"
            :total-items="totalItem" :loading="loading" class="elevation-1">
            <template v-slot:items="props">
                <td>
                    <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                </td>
                <td @click.stop.prevent="clickCell(props.item.id)" v-for="(header,i) in headers" :key="i">{{ parseColValue(props.item, header.value) }}</td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        props: {
            headers: {
                type: Array
            },
            dataUrl: {
                type: String,
                default:''
            },
            itemData: {
                type: Array,
                default: ()=>[]
            }
        },
        data() {
            return {
                selected: [],
                rowsPerPage: 10,
                pagination: {},
                totalItem: 0,
                loading: true,
                tableData:[]
            }
        },
        watch: {
            pagination: {
                handler() {
                    this.getData()
                },
                deep: true
            },
            itemData:{
                handler() {
                    this.tableData = this.itemData
                    console.log(this.tableData);
                    
                }
            },
            dataUrl: {
                handler() {
                    this.getData()
                },
                deep: true
            }
        },
        computed: {
            pages() {
                if (this.pagination.rowsPerPage == null ||
                    this.pagination.totalItems == null
                ) return 0

                return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
            }
        },
        methods: {
            clickCell(id){
                this.$emit('cellClick',{id})
            },
            parseColValue(colData,key){
                const keys = key.split('.');
                let o = colData;
                for (const k of keys) {
                    o = o[k];
                }
                return o
            },
            getDataFromApi() {
                this.loading = true
                return new Promise((resolve, reject) => {
                    const {
                        sortBy,
                        descending,
                        page,
                        rowsPerPage
                    } = this.pagination

                    this.axios.get(this.dataUrl, {
                            params: {
                                page: page,
                                perpage: rowsPerPage,
                                sortby: sortBy,
                                descending
                            }
                        })
                        .then(response => {
                            // handle success
                            this.loading = false;
                            resolve({
                                items: response.data.data,
                                total: response.data.total
                            })
                        })

                })
            },
            getData(){
                if(this.dataUrl.length >1){
                    this.getDataFromApi()
                        .then(data => {
                            this.tableData = data.items
                            this.totalItem = data.total
                        })
                }else{
                    this.loading = false;
                }

            }

        },
    }

</script>
