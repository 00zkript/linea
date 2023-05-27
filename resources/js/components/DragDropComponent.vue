<template lang="">
    <div class="dropzone">
        <input type="file" :id="id" :name="name" :multiple="multiple" :accept="accept" hidden>
        <div class="dropzone_close" @click="deleteAll()"><i class="fa fa-xmark"></i></div>
        <div class="dropzone_container"
            :class="{
                hover: isHover,
                dropped: isDropped,
                invalid: isInvalid,
            }"
            @dragover.prevent="isHover = true"
            @dragleave.prevent="isHover = false"
            @drop.prevent="dropAddFile"
        >
            <div class="dropzone_text">
                <p>Arrastra y suelta tu foto o haz clic <b class="dropzone_btn" @click="openFileinput()">aquí</b> <br>para subirla</p>
            </div>
            <div class="dropzone_previews">
                <div class="dropzone_preview">
                    <img src="https://dummyimage.com/200/aaa/fff"  class="dropzone_preview_img">
                    <div class="dropzone_preview_actions">
                        <button class="dropzone_preview_action search"><i class="fa fa-search"></i></button>
                        <button class="dropzone_preview_action move"><i class="fa fa-arrows-up-down-left-right"></i></button>
                        <button class="dropzone_preview_action delete"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="dropzone_preview">
                    <img src="https://dummyimage.com/200/aaa/fff"  class="dropzone_preview_img">
                    <div class="dropzone_preview_actions">
                        <button class="dropzone_preview_action search"><i class="fa fa-search"></i></button>
                        <button class="dropzone_preview_action move"><i class="fa fa-arrows-up-down-left-right"></i></button>
                        <button class="dropzone_preview_action delete"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="dropzone_preview">
                    <img src="https://dummyimage.com/200/aaa/fff"  class="dropzone_preview_img">
                    <div class="dropzone_preview_actions">
                        <button class="dropzone_preview_action search"><i class="fa fa-search"></i></button>
                        <button class="dropzone_preview_action move"><i class="fa fa-arrows-up-down-left-right"></i></button>
                        <button class="dropzone_preview_action delete"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropzone_loading"></div>
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        name: String,
        values: Array,
        accept: {
            type: String,
            default: '*',
        },
        size: Number,
        multiple: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            isHover: false,
            isDropped: false,
            isInvalid: false,
            files: [],
            previews: [],
        }
    },
    methods: {
        validateFile( file ) {
            if (!file) return false;

            const mb = 1048576;
            const size = file.size / mb;
            const type = file.type;
            const ext  = file.name.split('.').pop();
            const errors = [];


            if ( !['image/jpeg','image/png','image/jpg', 'application/pdf'].includes(type) || !['jpeg', 'jpg', 'png', 'pdf'].includes(ext) ){
                errors.push('¡Tipo de archivo incorrecto! Solo se aceptan archivos de tipo JPG, PNG o PDF.');
            }

            if( this.size && size > this.size ){
                errors.push('¡Tamaño de imagen incorrecto! El tamaño de imagen excede el permitido ('+this.size+'MB).');
            }

            return errors;
        },
        inputAddFile(e) {
            e.preventDefault();
            const input = e.target;
            const files = input.files;
            // const file = files[0];

            this.isHover = false;
            this.isDropped = false;
            this.isDropped = true;
            this.files = files;

            files.forEach( file => {
                this.previews.push({
                    path: URL.createObjectURL(file),
                    name: file.name,
                    type: file.type
                })
            });

        },
        dropAddFile(e) {
            e.preventDefault();
            const input = document.querySelector('#'.this.id);
            const files = e.dataTransfer.files;
            // const file = files[0];

            this.isHover = false;
            this.isDropped = false;
            this.isDropped = true;
            this.files = files;

            files.forEach( file => {
                this.previews.push({
                    path: URL.createObjectURL(file),
                    name: file.name,
                    type: file.type
                })
            });

        },

        deleteAll() {},
        delete() {},
    },
    mounted() {
    }
}
</script>

<style>

    .dropzone{
        width: 100%;
        position: relative;
        border: 1px solid;
        border-radius: 1rem;
    }
    .dropzone_close{
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        text-align: center;
        font-size: 14pt;
    }
    .dropzone_close i{
        background: red;
        border-radius: 50%;
        color: #fff;
        padding: 0.25rem;
        width: 1.6rem;
        height: 1.6rem;
    }
    .dropzone_container{
        margin: 1.5rem 1rem 1rem 1rem;
        border: 1px dashed;
        border-radius: 1rem;
        justify-content: center;
        text-align: center;
    }
    .dropzone_text{
        padding: 1.5rem;
        font-size: 12pt;
    }
    .dropzone_previews{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin: 0.75rem;
    }
    .dropzone_preview{
        width: 150px;
        margin: 0.25rem;
        padding: 0.25rem;
        border: 1px solid;
        border-radius: 1rem;
        margin: 0.5rem;
    }
    .dropzone_preview_img{
        width: 100%;
        border-radius: 1rem;
    }
    .dropzone_preview_actions{
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
    }
    .dropzone_preview_action{
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
        border-radius: 0.5rem;
        padding: 0.25rem;
    }
    .dropzone_preview_action.delete{
        color: #ff0000;
        border: 1px solid #ff0000;
    }
    .dropzone_preview_action.move{
        color: #1e90ff;
        border: 1px solid #1e90ff;
    }
    .dropzone_preview_action.search{
        color: #1e90ff;
        border: 1px solid #1e90ff;
    }


</style>
