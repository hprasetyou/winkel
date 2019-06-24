<template>
    <div>
        <v-layout row>
            <v-spacer></v-spacer>
            <v-btn color="primary" :to="`${this.$route.path}/new`">New</v-btn>
        </v-layout>
        <v-divider></v-divider>
        <br>
        <v-data-table v-model="selected" select-all :headers="headers" :items="tableData" :pagination.sync="pagination"
            :total-items="totalItem" :loading="loading" class="elevation-1">
            <template v-slot:items="props">
                <td>
                    <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                </td>
                <td @click.stop.prevent="gotoDetail(props.item.id)" v-for="(header,i) in headers" :key="i">{{ props.item[header.value] }}</td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        mounted() {
            console.log(this.$route);

        },
        props: {
            headers: {
                type: Array
            },
            dataUrl: {
                type: String
            }
        },
        data() {
            return {
                selected: [],
                rowsPerPage: 5,
                pagination: {},
                totalItem: 0,
                loading: true,
                tableData: [],
            }
        },
        watch: {
            pagination: {
                handler() {
                    this.getDataFromApi()
                        .then(data => {
                            this.tableData = data.items
                            this.totalItem = data.total
                        })
                },
                deep: true
            }
        },
        computed: {
            pages() {
                console.log(this.pagination);

                if (this.pagination.rowsPerPage == null ||
                    this.pagination.totalItems == null
                ) return 0

                return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
            }
        },
        methods: {
            gotoDetail(id){
                this.$router.push(`${this.$route.path}/${id}`)
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
                    console.log(this.pagination);

                    axios.get(this.dataUrl, {
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
            }

        },
    }

</script>
