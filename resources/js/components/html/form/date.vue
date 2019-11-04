<template>
    <div>
        <v-menu
          :close-on-content-click="false"
          v-model="menu"
          transition="scale-transition"
          offset-y
          absolute
          full-width
          :nudge-right="40"
          max-width="290px"
          min-width="290px"
        ><template v-slot:activator="{ on }">

          <v-text-field
            slot="activator"
            :label="label"
            v-model="inputVal"
            prepend-icon="event"
            v-on="on"
            readonly
          ></v-text-field>
        </template>
          <v-date-picker
          @change="menu = false"
          v-model="inputVal" no-title scrollable actions>
          </v-date-picker>
        </v-menu>
    </div>
</template>
<script>
export default {
    props:{
        value:{},
        label:{
          type:String
        }
    },
    data: () => ({
        menu: false,
        modal: false,
        inputVal:null
    }),
    watch:{
        value(){
            this.inputVal = this.value;
        },
        inputVal(){
            // this.value = this.inputVal;
            this.$emit('input',this.inputVal);
        }
    }
}
</script>