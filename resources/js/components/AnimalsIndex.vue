<template>
    <div class="animals-wrapper">
        <list-filter :options="this.filterOptions" :checkedFilters="this.checkedFilters" @filter-change="onFilterChange"/>

        <pagination-links v-if="animals.length" :currentPage="response.current_page" :totalPages="response.last_page" :navigatePrev="onNavigatePrev" :navigateNext="onNavigateNext"/>

        <animals-list :animals="animals" :isLoading="isLoading" :initialized="initialized" :csrf="csrf"/>

        <pagination-links v-if="animals.length" :currentPage="response.current_page" :totalPages="response.last_page" :navigatePrev="onNavigatePrev" :navigateNext="onNavigateNext"/>
    </div>
</template>


<script>
    import ListFilter from './ListFilter.vue';
    import AnimalsList from './AnimalsList.vue';
    import PaginationLinks from './PaginationLinks.vue';
    export default {
        mounted() {
            console.log('Vue: AnimalsIndex Component mounted.');
            this.fetch(this.url, {'appendFilters': true});
            this.attachOnPopStateHandler();
        },
        data: function() {
            return {
                animals: [],
                response: [],
                isLoading: false,
                initialized: false,
                checkedFilters: {},
                filterOptions: {},
                url: '/api/animals'
            }
        },
        methods: {
            attachOnPopStateHandler() {
                window.onpopstate = (event) => {
                    console.log(`[POP STATE] location: ${document.location}, state: ${JSON.stringify(event.state)}`);
                    if (event.state) {
                        this.checkedFilters = {...event.state};
                        delete this.checkedFilters.page;
                    }
                    else {
                        for (let filterName in this.checkedFilters)
                            this.checkedFilters[filterName] = [];
                    }
                    this.fetch(this.url, event.state);
                };
            },
            onFilterChange(params) {
                this.checkedFilters = {...params};
                // Start pagination from page 1 after submitting new filter
                params['page'] = 1;
                console.log('Fetch with filters', params);
                this.fetch('/api/animals', params);
                history.pushState(params, null, null);
                    console.log("History: pushed state: " + JSON.stringify(params));
            },
            onNavigateNext() {
                console.log('Navigate next');
                if (!this.response.next_page_url)
                    return;
                
                this.fetch(this.response.next_page_url);
                let state = {...this.checkedFilters, 'page': this.response.current_page + 1};
                    history.pushState(state, null, null);
                    console.log("History: pushed state: " + JSON.stringify(state));
            },
            onNavigatePrev() {
                console.log('Navigate previous');
                if (!this.response.prev_page_url)
                    return;
                
                this.fetch(this.response.prev_page_url);
                // MAYBE no need to add history item when navigating BACK through list.
                let state = {...this.checkedFilters, 'page': this.response.current_page - 1};
                    history.pushState(state, null, null);
                    console.log("History: pushed state: " + JSON.stringify(state));
            },
            fetch(url, parameters) {
                if (!url)
                    return;
                
                this.isLoading = true;
                console.log("Fetching URL: " + url);
                console.log("Parameters: " + JSON.stringify(parameters));

                axios.get(url, parameters ? { params: parameters } : null)
                .then((response) => { // success
                    // console.log(`Response: ${JSON.stringify(response)}`);
                    this.response = response.data;
                    this.animals = response.data.data;
                    if (response.data.filters) {
                        this.filterOptions = response.data.filters;
                        this.checkedFilters = {...this.filterOptions};
                        for (let name in this.checkedFilters)
                            this.checkedFilters[name] = [];
                    }
                })
                .catch(function (error) { // error
                    // handle error
                    console.log(error);
                })
                .then(() => { // always executed
                    console.log('Finished axios request');
                    this.isLoading = false;
                    if (!this.initialized)
                        this.initialized = true;
                });
            }
        },
        props: {
            csrf: {
                type: String,
                required: true,
                default: '',
                note: 'CSRF token'
            }
        },
        components: {
            ListFilter,
            AnimalsList,
            PaginationLinks
        }
    }
</script>

<style scoped>
</style>
