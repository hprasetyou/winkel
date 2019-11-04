<template>
    <div>
        <v-data-table :hide-default-footer="hideAction" :headers="tableHeader" :items="tableData" :options.sync="pagination"
        :footer-props="footerProps"
        :items-per-page="footerProps.itemsPerPageOptions[0]"
            :server-items-length="totalItem" :loading="loading" class="elevation-1">
                <template v-slot:item.action="{ item }">
                    <v-icon v-for="action in actions" :key="action.name"
                        small
                        class="mr-2"
                        @click="rowAction(action.name,item)"
                    >
                        {{action.icon}}
                    </v-icon>
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
            hideAction: {
                type: Boolean,
                default:false
            },
            itemData: {
                type: Array,
                default: ()=>[]
            },
            filterData:{
                type: Array,
                default: ()=>[]
            },
            actions:{

                type: Array,
                default: ()=>[{
                    name:'edit',
                    icon:'edit'
                },{
                    name:'delete',
                    icon:'delete'
                }]
            }
        },
        data() {
            return {
                rowsPerPage: 10,
                pagination: {},
                totalItem: 0,
                loading: true,
                tableData:[],
                footerProps:{    
                    itemsPerPageOptions:[15,30,50]
                }
                
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
                    this.tableData = this.itemData;
                }
            },
            dataUrl: {
                handler() {
                    this.getData()
                },
                deep: true
            },
            filterData: {
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
            },
            tableHeader(){
                const header = this.headers;
                const actionHeader = header.filter(item=>item.value == 'action');
                if(!actionHeader.length>0){
                    header.push({ text: 'Actions', value: 'action', sortable: false })
                }
                return header;
            }
        },
        methods: {
            rowAction(action,data){
                this.$emit(`${action}Row`,data)
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
                        sortDesc,
                        page,
                        rowsPerPage
                    } = this.pagination;
                    
                    const params = {
                                page: page,
                                perpage: rowsPerPage,
                                sortby: sortBy,
                                sortDesc,
                                filter:[],
                                filterValue:[],
                                filterOperator:[]
                    }
                    const filterData = this.filterData;

                    for (let i = 0; i < filterData.length; i++) {
                        params.filter[i] = filterData[i].column.name;
                        params.filterValue[i] = filterData[i].value;
                        params.filterOperator[i] = filterData[i].operator;
                    }
                    this.axios.get(this.dataUrl, {
                            params
                        })
                        .then(response => {
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
                        });
                }else{
                    this.loading = false;
                }

            }

        },
    }

</script>
