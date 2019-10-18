<template>
    <div class="animals-list">
        <nav aria-label="Page navigation example" class="float-left">
            <ul class="pagination">
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Previous" @click="navigatePrev">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><span class="page-link">Page {{ response.current_page }} of {{ response.last_page }}</span></li>
              <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li> -->
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Next" @click="navigateNext">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
        </nav>
        <ListFilter :initialFilters="this.initialFilterItems" :checkedFilters="this.filters" @filter-change="onFilterChange"/>
        <table class="table table-sm table-bordered my-4 table-animals-list" :style="{opacity: tableOpacity}">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nr</th>
                    <th scope="col">Species</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Color</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Size</th>
                    <th scope="col">Intake Date</th>
                    <th scope="col">Microchip</th>
                    <th scope="col">Living area</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-show="initialized && animals.length == 0"><td colspan="12" class="text-center">No animal records found.</td></tr>
                <tr v-for="(animal, index) in animals" v-bind:key="index">
                    <th scope="row"><a :href="routeAnimalDetailsPage(animal.id)">{{ animal.list_number }}</a>
                    </th>
                    <td>{{ animal.species.name }}</td>
                    <td>{{ animal.gender }}</td>
                    <td>{{ animal.color.name }}</td>
                    <td>{{ animal.name }}</td>
                    <td>{{ animal.birthdate }}</td>
                    <td>{{ animal.size }}</td>
                    <td>{{ (animal.intake_date).substr(0, 11) }}</td>
                    <td>{{ animal.chip_number }}</td>
                    <td>{{ animal.living_area.name }}</td>
                    <td><a :href="routeAnimalEditPage(animal.id)" class="btn btn-primary btn-sm">Edit</a></td>
                    <td>
                        <form method="POST" :action="routeAnimalDetailsPage(animal.id)">
                            <input type="hidden" name="_token" v-bind:value="csrf">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span>X</span>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Previous" @click="navigatePrev">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><span class="page-link">Page {{ response.current_page }} of {{ response.last_page }}</span></li>
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Next" @click="navigateNext">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
        </nav>
    </div>
</template>


<script>
    import ListFilter from './ListFilter.vue'
    export default {
        mounted() {
            console.log('Vue: AnimalsList Component mounted.');
            this.fetch(this.url, {'appendFilters': true});
            this.attachOnPopStateHandler();
        },
        data: function() {
            return {
                animals: [],
                response: [],
                isLoading: false,
                initialized: false,
                filters: {},
                initialFilterItems: {},
                url: '/api/animals'
            }
        },
        methods: {
            attachOnPopStateHandler() {
                window.onpopstate = (event) => {
                    console.log(`[POP STATE] location: ${document.location}, state: ${JSON.stringify(event.state)}`);
                    if (event.state) {
                        this.filters = {...event.state};
                        delete this.filters.page;
                    }
                    else {
                        for (let filterName in this.filters)
                            this.filters[filterName] = [];
                    }
                    this.fetch(this.url, event.state);
                };
            },
            onFilterChange(params) {
                this.filters = {...params};
                // Start pagination from page 1 after submitting new filter
                params['page'] = 1;
                console.log('Fetch with filters', params);
                this.fetch('/api/animals', params);
                history.pushState(params, null, null);
                    console.log("History: pushed state: " + JSON.stringify(params));
            },
            navigateNext() {
                console.log('Navigate next');
                if (!this.response.next_page_url)
                    return;
                
                this.fetch(this.response.next_page_url);
                let state = {...this.filters, 'page': this.response.current_page + 1};
                    history.pushState(state, null, null);
                    console.log("History: pushed state: " + JSON.stringify(state));
            },
            navigatePrev() {
                console.log('Navigate previous');
                if (!this.response.prev_page_url)
                    return;
                
                this.fetch(this.response.prev_page_url);
                // MAYBE no need to add history item when navigating BACK through list.
                let state = {...this.filters, 'page': this.response.current_page - 1};
                    history.pushState(state, null, null);
                    console.log("History: pushed state: " + JSON.stringify(state));
            },
            routeAnimalDetailsPage(id) {
                return '/animals/' + id;
            },
            routeAnimalEditPage(id) {
                return '/animals/' + id + '/edit';
            },
            fetch(url, parameters) {
                if (!url)
                    return;
                
                this.isLoading = true;
                console.log("Fetching URL: " + url);
                console.log("Parameters: " + JSON.stringify(parameters));

                axios.get(url, parameters ? { params: parameters } : null)
                .then((response) => { // success
                    console.log(`Response: ${response}`);
                    this.response = response.data;
                    this.animals = response.data.data;
                    if (response.data.filters) {
                        this.initialFilterItems = response.data.filters;
                        this.filters = {...this.initialFilterItems};
                        for (let name in this.filters)
                            this.filters[name] = [];
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
        props: ['csrf'],
        computed: {
            tableOpacity() { return this.isLoading ? 0.6 : 1 }
        },
        components: {
            ListFilter
        }
    }
</script>

<style scoped>
</style>
