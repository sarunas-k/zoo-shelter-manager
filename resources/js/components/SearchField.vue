<template>
    <div class="search-field w-100">
        <input class="form-control form-control-dark" type="text" placeholder="Enter animal number, name, microchip number..." aria-label="Search" @keyup.enter="submitSearch" v-model="query">
    </div>
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
