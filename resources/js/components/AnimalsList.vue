<template>
  <div class="animals-list">
  <!-- <div class="animals-list" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 15px; margin-bottom: 20px;"> -->
      <!-- <div class="animals-list-item" style="display: flex; padding: 15px; box-shadow: 0px 0px 3px 3px rgba(0,0,0,0.08);">
          <div class="img" style="width: 70px; height: 70px; background-color: black"/>
          <h4 style="margin-left: 10px;">Animal #1</h4>
      </div>
      <div class="animals-list-item" style="display: flex; padding: 15px; box-shadow: 0px 0px 3px 3px rgba(0,0,0,0.08);">
          <div class="img" style="width: 70px; height: 70px; background-color: gray"/>
          <h4 style="margin-left: 10px;">Animal #1</h4>
      </div>
      <div class="animals-list-item" style="display: flex; padding: 15px; box-shadow: 0px 0px 3px 3px rgba(0,0,0,0.08);">
          <div class="img" style="width: 70px; height: 70px; background-color: black"/>
          <h4 style="margin-left: 10px;">Animal #1</h4>
      </div> -->
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
                        <delete-button :csrf="csrf" :action="routeAnimalDetailsPage(animal.id)"/>
                    </td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
import DeleteButton from './DeleteButton.vue';
export default {
    components: {
        DeleteButton
    },
    mounted() {
        console.log('Vue: AnimalsList Component mounted');
    },
    props: {
        animals: {
            type: Array,
            required: true,
            default: [],
            note: 'Array of animal entries'
        },
        isLoading: {
            type: Boolean,
            required: true,
            default: false,
            note: 'True, if animal entries are currently loading from API'
        },
        initialized: {
            type: Boolean,
            required: true,
            default: false,
            note: 'True, when initial entries are loaded'
        },
        csrf: {
            type: String,
            required: true,
            default: '',
            note: 'CSRF Token'
        }
    },
    computed: {
        tableOpacity() { 
            return this.isLoading ? 0.6 : 1
        }
    },
    methods: {
        routeAnimalDetailsPage(id) {
            return '/animals/' + id;
        },
        routeAnimalEditPage(id) {
            return '/animals/' + id + '/edit';
        },
    }
}
</script>

<style scoped>

</style>