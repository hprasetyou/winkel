<template>
    <div>
        <v-layout row px-3 wrap>
            <v-flex xs3>
                <label for="">{{ label }}</label>
            </v-flex>
            <v-flex xs9>
                <picture-input v-if="editMode && !readOnly" ref="pictureInput" width="600" height="600" margin="16" accept="image/jpeg,image/png"
                    size="10" button-class="btn" :custom-strings="{
            upload: '<h1>Upload</h1>',
            drag: 'Click to select image'
        }" @change="onChange">

                </picture-input>
                <v-img :src="value" v-show="!editMode || readOnly" alt="" />
            </v-flex>
        </v-layout>
    </div>
</template>
<script>
import PictureInput from 'vue-picture-input'
export default {
    name: 'app',
    props:{
        readOnly:{
            type:Boolean,
            default:false
        },
        editMode:{
            type:Boolean,
            default:false
        },
        value:{},
        label:{
            type:String
        }
    },
    data () {
        return {
        }
    },
    components: {
        PictureInput
    },
    methods: {
        onChange (image) {
        console.log(image)
        if (image) {
            console.log('Picture loaded.')
            this.image = image
        } else {
            console.log('FileReader API not supported: use the <form>, Luke!')
        }
        }
    }
}
</script>