<template>
  <v-snackbar
    top
    v-model="snackbar.visible"
    :timeout="snackbar.timeout"
    :color="snackbar.color"
    :multi-line="snackbar.multiline === true">
        
      {{ snackbar.text }}
        
      <v-btn dark @click="closeSnackbar">Close</v-btn>
    
  </v-snackbar>
</template>
<script>
import { mapMutations } from "vuex"
export default {
  computed: {
    snackbar() {
      return this.$store.state.snackbar
    }
  },
  methods: {
    ...mapMutations(["closeSnackbar"])
  }
}
</script>