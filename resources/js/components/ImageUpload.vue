<template>
    <div class="form-row row mb-3 mt-4">
        <div class="form-group col-md-2">
            <InputFile name="animal-image" :multiple="true" :onlyImages="true" @inputChange="onImageInputChange">
                <template #text>Add Image</template>
            </InputFile>
        </div>
        <div class="form-group col-md-10">
            <ImageUploadPreview :files="files"/>
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
            console.log(this.files);
            this.files = event.target.files;
        }
    },
    components: {
        ImageUploadPreview,
        InputFile
    }
}
</script>