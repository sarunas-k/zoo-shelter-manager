<template>
    <div class="animals-wrapper">
        <list-filter :options="this.filterOptions" :checkedFilters="this.checkedFilters" @filter-change="onFilterChange"/>

        <pagination-links v-if="animals.length" :currentPage="pageCurrentNum" :totalPages="pageLastNum" :navigatePrev="onNavigatePrev" :navigateNext="onNavigateNext" :total="total"/>

        <animals-list :animals="animals" :isLoading="isLoading" :initialized="initialized" :csrf="csrf"/>

        <pagination-links v-if="animals.length" :currentPage="pageCurrentNum" :totalPages="pageLastNum" :navigatePrev="onNavigatePrev" :navigateNext="onNavigateNext" :total="total"/>
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
                pageCurrentNum: null,
                pageLastNum: null,
                pageNextUrl: null,
                pagePrevUrl: null,
                total: null,
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
                this.fetch('/api/animals', params);
                history.pushState(params, null, null);
            },
            onNavigateNext() {
                if (!this.pageNextUrl)
                    return;
                
                this.fetch(this.pageNextUrl);
                let state = {...this.checkedFilters, 'page': this.pageCurrentNum + 1};
                    history.pushState(state, null, null);
            },
            onNavigatePrev() {
                if (!this.pagePrevUrl)
                    return;
                
                this.fetch(this.pagePrevUrl);
                let state = {...this.checkedFilters, 'page': this.pageCurrentNum - 1};
                    history.pushState(state, null, null);
            },
            fetch(url, parameters) {
                if (!url)
                    return;
                
                if (this.nonshelter) parameters = {...parameters, ...{nonShelter: true}};

                this.isLoading = true;

                axios.get(url, { params: parameters })
                .then((response) => { // success
                    this.animals = response.data.data;
                    this.pageCurrentNum = response.data.current_page;
                    this.pageLastNum = response.data.last_page;
                    this.pageNextUrl = response.data.next_page_url;
                    this.pagePrevUrl = response.data.prev_page_url;
                    this.total = response.data.total;
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
            },
            nonshelter: {
                type: Boolean,
                required: false,
                default: false,
                note: 'If true, show only non shelter animals'

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
