<template>
    <div class="animals-list">
        <nav aria-label="Page navigation example" class="float-left">
            <ul class="pagination">
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Previous" @click="navigatePrev()">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><span class="page-link">Page {{ response.current_page }} of {{ response.last_page }}</span></li>
              <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li> -->
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Next" @click="navigateNext()">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
        </nav>
        <div class="animals-list-filters float-left ml-3 mt-1">
            <span class="dropdown filter-species">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menuButtonSpecies" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    SPECIES
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="menuButtonSpecies" @click="$event.stopPropagation()">
                    <div class="form-check dropdown-item">
                        <input class="form-check-input filter-species-checkbox" type="checkbox" value="" id="checkboxDogs" data-animal-filter="Dogs" @change="checkedFilter($event, 'species')">
                        <label class="form-check-label" for="checkboxDogs">
                            Dogs
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input filter-species-checkbox" type="checkbox" value="" id="checkboxCats" data-animal-filter="Cats" @change="checkedFilter($event, 'species')">
                        <label class="form-check-label" for="checkboxCats">
                            Cats
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input filter-species-checkbox" type="checkbox" value="" id="checkboxTurtles" data-animal-filter="Turtles" @change="checkedFilter($event, 'species')">
                        <label class="form-check-label" for="checkboxTurtles">
                            Turtles
                        </label>
                    </div>
                </div>
            </span>
            <span class="dropdown filter-gender">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menuButtonGender" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    GENDER
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="menuButtonGender" @click="$event.stopPropagation()">
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxMale" data-animal-filter="Male" @change="checkedFilter($event, 'gender')">
                        <label class="form-check-label" for="checkboxMale">
                            Male
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxFemale" data-animal-filter="Female" @change="checkedFilter($event, 'gender')">
                        <label class="form-check-label" for="checkboxFemale">
                            Female
                        </label>
                    </div>
                </div>
            </span>
            <span class="dropdown filter-size">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menuButtonSize" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    SIZE
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="menuButtonSize" @click="$event.stopPropagation()">
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxSizeSmall" data-animal-filter="Small" @change="checkedFilter($event, 'size')">
                        <label class="form-check-label" for="checkboxSizeSmall">
                            Small
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxSizeMedium" data-animal-filter="Medium" @change="checkedFilter($event, 'size')">
                        <label class="form-check-label" for="checkboxSizeMedium">
                            Medium
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxSizeLarge" data-animal-filter="Large" @change="checkedFilter($event, 'size')">
                        <label class="form-check-label" for="checkboxSizeLarge">
                            Large
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxSizeXLarge" data-animal-filter="Very large" @change="checkedFilter($event, 'size')">
                        <label class="form-check-label" for="checkboxSizeXLarge">
                            Very large
                        </label>
                    </div>
                </div>
            </span>
            <span class="dropdown filter-color">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="menuButtonColor" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    COLOR
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="menuButtonColor" @click="$event.stopPropagation()">
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxColorBlack" data-animal-filter="Black" @change="checkedFilter($event, 'color')">
                        <label class="form-check-label" for="checkboxColorBlack">
                            Black
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxColorBrown" data-animal-filter="Brown" @change="checkedFilter($event, 'color')">
                        <label class="form-check-label" for="checkboxColorBrown">
                            Brown
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxColorWhite" data-animal-filter="White" @change="checkedFilter($event, 'color')">
                        <label class="form-check-label" for="checkboxColorWhite">
                            White
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" id="checkboxColorBrownBlack" data-animal-filter="Black and brown" @change="checkedFilter($event, 'color')">
                        <label class="form-check-label" for="checkboxColorBrownBlack">
                            Black and brown
                        </label>
                    </div>
                </div>
            </span>
            <br>
        </div>
        <br>
        <div class="filter-badges">
            <span v-bind:key="item" v-for="item in [...this.checkedFilterItems['species'],...this.checkedFilterItems['gender'],...this.checkedFilterItems['size'],...this.checkedFilterItems['color']]" class="badge badge-pill badge-primary mr-1">{{item}}</span>
        </div>
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
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Previous" @click="navigatePrev()">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><span class="page-link">Page {{ response.current_page }} of {{ response.last_page }}</span></li>
              <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li> -->
              <li class="page-item" style="cursor: pointer">
                <a class="page-link" aria-label="Next" @click="navigateNext()">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
        </nav>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Vue: AnimalsList Component mounted.');
            var url = '/api/animals';
            this.fetch(url);
            window.onpopstate = (event) => {
                console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
                this.fetch(url, event.state);
            };
        },
        data: function() {
            return {
                animals: [],
                response: [],
                isLoading: false,
                checkedFilterItems: {
                    species: [],
                    gender: [],
                    size: [],
                    color: []
                }
            }
        },
        methods: {
            checkedFilter: function(event, filterColumn) {
                let target = event.currentTarget;
                let filterValue = target.getAttribute('data-animal-filter');
                let isFiltered = this.checkedFilterItems[filterColumn].includes(filterValue);
                if (!isFiltered)
                    this.checkedFilterItems[filterColumn].push(filterValue);
                else
                    this.checkedFilterItems[filterColumn].splice(this.checkedFilterItems[filterColumn].indexOf(filterValue), 1);
                this.fetch('/api/animals', this.checkedFilterItems);
                history.pushState(this.checkedFilterItems, null, null);
                    console.log("History: pushed state: " + JSON.stringify(this.checkedFilterItems));
            },
            navigateNext: function() {
                if (!this.response.next_page_url)
                    return;
                
                this.fetch(this.response.next_page_url);
                let params = Object.assign({'page': this.response.current_page + 1}, this.checkedFilterItems);
                    history.pushState(params, null, null);
                    console.log("History: pushed state: " + JSON.stringify(params));
            },
            navigatePrev: function() {
                if (!this.response.prev_page_url)
                    return;
                
                this.fetch(this.response.prev_page_url);
                // MAYBE no need to add history item when navigating BACK through list.
                let params = Object.assign({'page': this.response.current_page - 1}, this.checkedFilterItems);
                    history.pushState(params, null, null);
                    console.log("History: pushed state: " + JSON.stringify(params));
            },
            routeAnimalDetailsPage: function(id) {
                return '/animals/' + id;
            },
            routeAnimalEditPage: function(id) {
                return '/animals/' + id + '/edit';
            },
            getURLparams: function() {
                let url = this.response.request.responseURL;
                if (!url)
                    return null;
                
                let parameters = new URL(url).search;
                return parameters;
            },
            fetch: function(url, params) {
                if (!url)
                    return;
                
                this.isLoading = true;
                console.log("Fetching URL: " + url);
                console.log("Parameters: " + params);

                axios.get(url, params ? { params: params } : null)
                .then((response) => { // success
                    console.log("Response:");
                    console.log(response);
                    this.response = response.data;
                    this.animals = response.data.data;
                })
                .catch(function (error) { // error
                    // handle error
                    console.log(error);
                })
                .then(() => { // always executed
                    console.log('Finished axios request');
                    this.isLoading = false;
                });
            }
        },
        props: ['csrf'],
        computed: {
            tableOpacity: function() {
                return this.isLoading ? 0.6 : 1;
            }
        }
    }
</script>

<style scoped>
.animals-list .filter-badges {
    clear: left;
    float: left;
    margin-bottom: 15px;
}
</style>
