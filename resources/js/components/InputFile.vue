<template>
    <div class="file-input-wrapper">
        <label :for="name" class="file-input-label">
            <p :data-feather="onlyImages ? 'image' : ''"></p>
            <p>
                <slot></slot>
            </p>
        </label>
        <input type="file" class="form-control-file file-input" :name="multiple ? `${name}[]` : name" :id="name" ref="fileInput" :multiple="multiple" @change="onInputChange">
    </div>
</template>

<script>
export default {
    mounted() {
        //console.log('Vue: InputFile Component mounted.');
    },
    props: {
        name: {
            type: String,
            required: true,
            default: ''
        },
        multiple: {
            type: Boolean,
            required: false,
            default: false
        },
        onlyImages: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        onInputChange(event) {
            this.$emit('inputChange', event);
        }
    }
}
</script>

<style scoped>
.file-input {
    display: none;
}
.file-input-label {
    padding: 20px;
    border: 1px solid #CCC;
    font-size: 16px;
    text-align: center;
}
.file-input-label:hover {
    background-color: #EEE;
    cursor: pointer;
}
.file-input-label p {
    margin-bottom: 0;
}
.file-input-label svg {
    height: 32px;
    width: 32px;
}
</style>