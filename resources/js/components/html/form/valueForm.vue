<template>
    <div>
        <label v-if="hideLabel" for="">{{ value }}</label>
        <v-layout v-else row px-3 py-2 wrap >
            <v-flex xs3>
                <label for="">{{ label }}</label>
            </v-flex>
            <v-flex xs9>
                <label for="">{{ value }}</label>
            </v-flex>
        </v-layout>
    </div>
</template>
<script>
export default {
    props:['label','value','hideLabel']
}
</script>