<template>
    <div>
        <h1>form</h1>
        <v-card>
            <v-card-text>
                <v-form ref="form">
                    <v-layout row wrap>
                        <v-flex xs6 px-2>
                            <div v-if="formDefinition.left">
                                <div v-for="(item,i) in formDefinition.left" :key="i">
                                    <v-text-field :label="item.label" required>
                                    </v-text-field>
                                </div>
                            </div>
                        </v-flex>
                        <v-flex xs6 px-2>
                            <div v-if="formDefinition.right">
                                <div v-for="(item,i) in formDefinition.right" :key="i">
                                    <v-text-field :label="item.label" required>
                                    </v-text-field>
                                </div>
                            </div>
                        </v-flex>
                        <v-flex xs12 px-2>
                            <v-btn color="success">
                                Validate
                            </v-btn>
                        </v-flex>
                    </v-layout>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
export default {
    data(){
        return {
            formDefinition: []
        }
    },
    mounted() {
       this.formDefinition = this.$route.meta.formDefinition
       console.log(this.formDefinition);
       
    },
}
</script>