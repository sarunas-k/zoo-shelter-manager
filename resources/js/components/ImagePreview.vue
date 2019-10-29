<template>
    <div class="image-preview" v-if="imageSrcs.length">
        <div v-for="(src, i) in imageSrcs" :key="i">
            <img :src="src" :alt="`Animal image preview ${i+1}`"/>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            imageSrcs: []
        }
    },
    methods: {
        renderImages() {
            if (!this.files)
                return;
            
            this.imageSrcs = [];
            for (let i = 0; i < this.files.length; i++) {
                let image = this.files[i];
                let reader = new FileReader();
                reader.addEventListener('load', (event) => {
                    this.imageSrcs.push(event.target.result);
                });
                reader.readAsDataURL(image);
            }
        }
    },
    props: {
        files: {
            required: true,
            default: [],
            note: 'File list'
        }
    },
    watch: {
        files() {
            this.renderImages();
        }
    }
}
</script>

<style scoped>
    .image-preview img {
        height: 100px;
        float: left;
        padding: 10px;
        margin: 0 10px;
        border: 1px solid #EEE;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    }
</style>