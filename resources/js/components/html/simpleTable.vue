<template>
  <v-simple-table>
    <thead>
      <tr>
        <th v-for="(header, i) in headers" :key="i" class="text-left">{{header.text}}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in itemData" :key="item.id">
        <td v-for="(header, i) in headers" :key="i">{{ parseColValue(item,header.value) }}</td>
      </tr>
    </tbody>
  </v-simple-table>
</template>
<script>
export default {
    props:{
        headers:{
            type:Array
        },
        itemData:{
            type:Array
        }
    },
    methods: {
        parseColValue(colData,key){
            const keys = key.split('.');
            let o = colData;
            for (const k of keys) {
                o = o[k];
            }
            return o
        }
    },
}
</script>
