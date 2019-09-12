<template>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Enter animal number, name, date of birth, microchip number..." aria-label="Search" @keyup.enter="submitSearch" v-model="query">
</template>

<script>
    export default {
        mounted() {
            console.log('Vue: SearchField Component mounted.')
        },
        data: function() {
            return {
                query: ''
            }
        },
        methods: {
            submitSearch: function() {
                if (!this.query)
                    return;

                window.location.href = window.location.origin + '/search?q=' + this.query;
            }
        }
    }
</script>
