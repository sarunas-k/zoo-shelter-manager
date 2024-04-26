<template>
    <div class="search-field w-100">
        <input class="form-control form-control-dark rounded-1" type="text"
            placeholder="Enter id number, name or microchip number" aria-label="Search" @keyup.enter="submitSearch"
            v-model="query">
        <button @click="submitSearch" class="btn btn-secondary btn-sm px-3">Search</button>
    </div>
</template>

<script>
export default {
    mounted() {
        //console.log('Vue: SearchField Component mounted.')
    },
    data: function () {
        return {
            query: ''
        }
    },
    methods: {
        submitSearch: function () {
            if (!this.query)
                return;

            window.location.href = window.location.origin + this.rootPath + 'search?q=' + this.query;
        }
    },
    computed: {
        rootPath() {
            return window.rootPath;
        }
    }
}
</script>
<style scoped>
.search-field {
    position: relative;
}

.search-field button {
    position: absolute;
    top: 5px;
    right: 5px;
}

.search-field input {
    height: calc(1.6em + .75rem + 2px);
}
</style>