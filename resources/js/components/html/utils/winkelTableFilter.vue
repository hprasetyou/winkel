<template>
    <div>
        <v-card>
            <v-card-text>
                <v-layout class="filter-toolbar">
                    <v-chip-group>
                        <v-chip close @click:close="removeFilter(i)" v-for="(item ,i) in appliedFilters" :key="i">
                            {{ `${item.column.label} ${findOperatorByValue(item.operator).label} '${item.value}'` }}
                        </v-chip>
                    </v-chip-group>
                    <v-spacer></v-spacer>
                    <v-btn color="" @click="openFilter = !openFilter">
                        Add filter
                    </v-btn>
                    <v-card class="filter-form-card" v-show="openFilter"
                            max-width="344" >
                      <v-form>
                    <v-container>
                        <v-select
                            :items="columns"
                            label="Column"
                            v-model="filterColumn"
                            outlined
                            item-text="label"
                            item-value="name"
                            ></v-select>

                        <v-select
                            :items="operatorTypes"
                            label="Operator"
                            v-model="filterOperator"
                            outlined
                            item-text="label"
                            item-value="value"
                            ></v-select>
                        <template v-if="filterColumn">
                            <v-text-field
                                v-if="['text','number'].indexOf(selectedColumn.type) > -1" 
                                label="Value"
                                v-model="filterValue"
                                outlined
                            ></v-text-field>
                            <v-select v-if="selectedColumn.type == 'enum'" 
                                :items="selectedColumn.options" 
                                label="Value"
                                item-text="text"
                                v-model="filterValue"
                                outlined
                                item-value="value"></v-select>
                            <date v-if="selectedColumn.type == 'date'" v-model="filterValue"  label="Value"></date>
                        </template>
                        <v-btn color="" @click="applyFilter">
                            Apply
                        </v-btn>
                        <v-btn color="" @click="openFilter = false">
                            Close
                        </v-btn>
                    </v-container>
                </v-form>
                        </v-card>
                </v-layout>
            </v-card-text>
        </v-card>
    </div>
</template>
<style>
    .filter-toolbar{
        position: relative;
    }
    .v-sheet.filter-form-card{
        z-index: 9;
        position: absolute;
        right: 0;
        top: 50px;
    }
</style>
<script>
import date from '../form/date.vue';
export default {
    components:{
        date
    },
    data(){
        return {
            openFilter: false,
            appliedFilters:[],
            filterColumn:null,
            filterValue:null,
            filterOperator:null,
            operatorTypeAll:[{
                label:'is equal',
                value:'=',
                member:['enum','date','number']
            },{
                label:'is contain',
                value:'like',
                member:['text']
            },{
                label:'more than',
                value:'>',
                member:['date','number']
            },{
                label:'less than',
                value:'<',
                member:['date','number']
            },{
                label:'more than or equal',
                value:'>=',
                member:['date','number']
            },{
                label:'less than or equal',
                value:'<=',
                member:['date','number']
            }]
        }
    },
    props:{
        columns:{
            type:Array
        },
        prefilter:{
            type: Array,
            default: ()=>[]
        }
    },
    computed: {
        selectedColumn(){
            const filterColumn = this.filterColumn;
            if(filterColumn){
                return this.columns.find(item => item.name == filterColumn);
            }else{
                return false;
            }
        },
        operatorTypes(){
            const types = this.operatorTypeAll
            const columnType = this.selectedColumn.type;

            return types.filter(type => type.member.indexOf(columnType) > -1);
        }
    },
    mounted() {
    },
    watch: {
        prefilter(){
            this.appliedFilters = this.prefilter.map(filter => ({
                column: this.columns.find(item => item.name == filter.name),
                operator:filter.operator,
                value:filter.value
            }));
            this.$emit('data-updated',this.appliedFilters);
        }
    },
    methods: {
        findOperatorByValue(value){
            return this.operatorTypeAll.find(item => item.value == value);
        },
        applyFilter(){ 
            const column = this.selectedColumn;
            if(column && this.filterOperator){
                const data = {
                    column,
                    operator:this.filterOperator,
                    value:this.filterValue
                }
                this.appliedFilters.push(data);
                this.openFilter = false;
                this.filterValue = null;
                this.filterColumn = null;
                this.$emit('data-updated',this.appliedFilters)
            }
        },
        removeFilter(i){
            this.appliedFilters.splice(i,1)
            this.$emit('data-updated',this.appliedFilters)
        }
    }
}
</script>