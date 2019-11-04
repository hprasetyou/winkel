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
                                    drag: 'Click to select image'}" @change="onChange">

                </picture-input>
                <input type="hidden" v-model="inputVal">
                <v-img v-if="value" :src="value" v-show="!editMode || readOnly" alt="" />
            </v-flex>
        </v-layout>
    </div>
</template>
<script>
import PictureInput from 'vue-picture-input';
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
            inputVal:""
        }
    },
    components: {
        PictureInput
    },
    methods: {
        onChange (image) {
        if (image) {
            this.image = image
            this.uploadImage(image).then(data=>{
                console.log(data);
                this.inputVal = data.data.img
            })
            
        } else {
            console.log('FileReader API not supported: use the <form>, Luke!')
        }
        },
        uploadImage(image){
            return new Promise((resolve,reject) =>{
            this.axios.post('/imageUploader',{image}).then(data=>{
                resolve(data)
            })
            })
        }
    },
    watch: {
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