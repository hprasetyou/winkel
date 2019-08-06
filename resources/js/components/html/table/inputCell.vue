<template>
    <td>
        <template  v-if="editState && conf.editable && conf.type != 'method'">
            <v-text-field  v-if="conf.type == 'number'" type="number" v-model="data[conf.value]" />
            <v-text-field  v-else v-model="data[conf.value]" />
        </template>
        <span v-if="!editState || !conf.editable">
            <template v-if="conf.type == 'method'">
                {{ conf.value(data) }}
            </template>
            <template v-else>
                {{ parseColValue(data,conf.value) }}
            </template>
        </span>
    </td>
</template>
<script>
    export default {
        props: ['conf.value', 'data', 'editState','conf'],
        methods: {
            parseColValue(colData, key) {
                const keys = key.split('.');
                let o = colData;
                for (const k of keys) {
                    o = o[k];
                }
                return o
            },
        },
    }

</script>
