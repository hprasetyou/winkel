<template>
    <v-layout row px-3 py-2 wrap >
        <v-flex xs3>
            <label for="">{{ label }}</label>
        </v-flex>
        <v-flex xs9>
            <label for="">{{ value }}</label>
        </v-flex>
    </v-layout>
</template>
<script>
export default {
    props:['label','value']
}
</script>