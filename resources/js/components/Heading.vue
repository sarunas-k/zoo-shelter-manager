<template>
    <h1 :class="[headingClass, {bold: bold}]"><slot></slot></h1>
</template>

<script>
export default {
    mounted() {
        console.log('Vue: Heading Component mounted.');
    },
    computed: {
        headingClass() {
            if (Number.isInteger(this.level) && this.level > 0 && this.level < 7)
                return `h${this.level}`;
            
            return 'h1';
        }
    },
    props: {
        level: {
            type: Number,
            required: false,
            default: 1
        },
        bold: {
            type: Boolean,
            required: false,
            default: true
        }
    }
}
</script>

<style scoped>
    .bold {
        font-weight: bold;
    }
</style>