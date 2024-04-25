<template>
  <div class="animals-list" v-if="initialized">
      <table class="table  table-bordered mb-4 table-animals-list" :style="{opacity: tableOpacity}">
            <tbody>
                <tr v-show="initialized && animals.length == 0"><td colspan="12" class="text-center">No animal records found.</td></tr>
                <tr v-for="(animal, index) in animals" v-bind:key="index">
                    <td class="animal-image-container">
                        <a :href="routeAnimalDetailsPage(animal.id)">
                            <img v-if="animal.images.length > 0" :src="storagePath + '/app/' + animal.images[0].path" class="animal-image"/>
                            <img v-if="animal.images.length == 0" :src="storagePath + '/app/images/no_image.jpeg'" class="animal-image"/>
                        </a>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Number</span><br>
                            <span class="column-value">
                                <a :href="routeAnimalDetailsPage(animal.id)">{{ animal.list_number }}</a>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Species</span><br>
                            <span class="column-value">{{ animal.species.name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Gender</span><br>
                            <span class="column-value">{{ animal.gender }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Age</span><br>
                            <span class="column-value">{{ animal.age }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Color</span><br>
                            <span class="column-value">{{ animal.color.name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Name</span><br>
                            <span class="column-value">{{ animal.name }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Size</span><br>
                            <span class="column-value">{{ animal.size }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Intake date</span><br>
                            <span class="column-value">{{ (animal.intake_date).substr(0, 11) }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="column-value-container">
                            <span class="bold">Status</span><br>
                            <span class="column-value">
                                <span v-if="animal.active_fosters.length" class="badge badge-pill badge-primary">In Foster</span>
                                <span v-if="animal.active_adoptions.length" class="badge badge-pill badge-success">Adopted</span>
                                <span v-if="animal.active_reclaims.length" class="badge badge-pill badge-success">Reclaimed</span>
                                <span v-if="!animal.active_fosters.length && !animal.active_adoptions.length && !animal.active_reclaims.length && !animal.adoptable" class="badge rounded-pill text-bg-warning">Not For Adoption</span>
                                <span v-if="animal.adoptable" class="badge rounded-pill text-bg-primary">For Adoption</span>
                            </span>
                        </div>
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
        storagePath() {
            return window.storagePath;
        },
        rootPath() {
            return window.rootPath;
        },
        tableOpacity() {
            return this.isLoading ? 0.6 : 1
        },
        userIsAdmin() {
            if (window.currentUser) {
                try {
                    const user = JSON.parse(window.currentUser);
                    if (user instanceof Object)
                        return user.is_admin;
                } catch (e) {
                    return false;
                }
            }
            return false;
        }
    },
    methods: {
        routeAnimalDetailsPage(id) {
            return this.rootPath + '/animals/' + id;
        },
        routeAnimalEditPage(id) {
            return this.rootPath + '/animals/' + id + '/edit';
        },
    }
}
</script>

<style scoped>
table {
    text-align: center;
    border-spacing: 0 10px;
    border-collapse: unset;
    border: 0;
}
th {
    background-color: #eee;
    color: black;
    font-weight: normal;
    font-family: sans-serif;
    line-height: 2em;
}
td {
    max-width: 120px;
    white-space: nowrap;
    border: 0;
}
th, td {
    vertical-align: middle;
}
tr {
    background-color: #f1f1f1;
}
.animal-image-container {
    height: 100px;
    width: 100px;
}
.animal-image-container .animal-image {
    height: 100%;
    width: 100%;
    object-fit: contain;
    border-radius: 10%;
}
.column-value-container {
    text-align: left;
    display: inline-block;
    width: 75%;
}
</style>