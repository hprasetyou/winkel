<template>
    <td>
        <v-text-field v-model="data[rowKey]" v-if="editState && editable && type != 'method'" />
        <span v-if="!editState || !editable">
            <template v-if="type == 'method'">
                {{ rowKey(data) }}
            </template>
            <template v-else>
                {{ parseColValue(data,rowKey) }}
            </template>
        </span>
    </td>
</template>
<script>
    export default {
        props: ['rowKey', 'data', 'editable', 'type', 'editState'],
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
