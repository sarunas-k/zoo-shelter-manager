<template>
    <div class="form-row mt-4">
        <div class="form-group col-md-2">
            <input-file name="animal-image" :multiple="true" :onlyImages="true" @inputChange="onImageInputChange">
                Add Image
            </input-file>
        </div>
        <div class="form-group col-md-10">
            <image-upload-preview :files="files"/>
        </div>
    </div>
</template>

<script>
import ImageUploadPreview from './ImageUploadPreview.vue';
import InputFile from './InputFile.vue';
export default {
    mounted() {
        window.feather.replace();
    },
    data: function() {
        return {
            files: {}
        }
    },
    methods: {
        onImageInputChange(event) {
            this.files = event.target.files;
        }
    },
    components: {
        ImageUploadPreview,
        InputFile
    }
}
</script>