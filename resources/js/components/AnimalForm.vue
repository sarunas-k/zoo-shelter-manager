<template>
    <form method="POST" :action="getRouteFormSubmit()" enctype="multipart/form-data">
    <input type="hidden" name="_token" :value="csrf">
    <input type="hidden" name="_method" value="PATCH" v-if="editform">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="animal-number">Animal number</label>
            <input type="text" class="form-control" id="animal-number" name="animal-number" placeholder="Number" :value="oldvalues[editform ? 'list_number' : 'animal-number']">
        </div>
        <div class="form-group col-md-4">
            <label for="species">Species</label>
            <searchable-select :options="species" name="species" placeholder="Species" :default="oldvalues[editform ? 'species_id' : 'species']" @selected="onSpeciesChange"/>
        </div>
        <div class="form-group col-md-4">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option>---</option>
                <option v-for="(gender, index) in genders" :key="'gender'+index" :selected="oldvalues['gender'] == gender ? 'selected' : ''">{{gender}}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" :value="oldvalues['name']">
        </div>
        <div class="form-group col-md-4">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
                <option>---</option>
                <option v-for="(size, index) in sizes" :key="'size'+index" :selected="oldvalues['size'] == size ? 'selected' : ''">{{size}}</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="color">Color</label>
            <searchable-select :options="colors" name="color" placeholder="Color" :default="oldvalues[editform ? 'color_id' : 'color']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="breed">Breed</label>
            <select class="form-control" id="breed" name="breed[]" multiple>
                <template v-for="speciesItem in species">
                    <option v-for="(breed, index) in speciesItem.breeds" :key="`${speciesItem.name}breed${index}`" :value="breed.id" :selected="isSelectedBreed(breed.id)" v-show="selectedSpecies == speciesItem.name">{{breed.name}}</option>
                </template>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="birthdate">Date of Birth</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" :value="oldvalues['birthdate']">
            <span style="display: block; text-align: center">or</span>
            <input type="number" class="form-control" id="age-digit" name="age-digit" min="1" :value="oldvalues['age-digit']" style="width: 50%; float: left">
            <select class="form-control" id="age-unit" name="age-unit" style="width: 50%">
                <option :selected="oldvalues['age-unit'] == 'years' ? 'selected' : ''">years</option>
                <option :selected="oldvalues['age-unit'] == 'months' ? 'selected' : ''">months</option>
                <option :selected="oldvalues['age-unit'] == 'weeks' ? 'selected' : ''">weeks</option>
                <option :selected="oldvalues['age-unit'] == 'days' ? 'selected' : ''">days</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="microchip">Microchip number</label>
            <input type="text" class="form-control" id="microchip" name="microchip" placeholder="Microchip number"
                :value="oldvalues[editform ? 'chip_number' : 'microchip']">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="staff">Responsible staff</label>
            <searchable-select :options="staff" name="staff" placeholder="Staff" :default="oldvalues[editform ? 'staff_id' : 'staff']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="intake-date">Intake Date</label>
            <input type="datetime-local" class="form-control" id="intake-date" name="intake-date"
                :value="(editform ? oldvalues['intake_date'].replace(' ', 'T') : oldvalues['intake-date']) || date">
        </div>
        <div class="form-group col-md-4">
            <label for="living-area">Living area</label>
            <searchable-select :options="livingareas" name="living-area" placeholder="Living area" :default="oldvalues[editform ? 'living_area_id' : 'living-area']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="bring-in-person">Person bringing animal in</label>
            <searchable-select :options="people" name="bring-in-person" display="full_name_with_address" placeholder="Person" :default="oldvalues[editform ? 'bring_in_person_id' : 'bring-in-person']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="call">Reference call</label>
            <searchable-select :options="calls" name="call" placeholder="Reference call" :default="oldvalues[editform ? 'call_id' : 'call']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="intake-type">Intake type</label>
            <select class="form-control" id="intake-type" name="intake-type">
                <option>---</option>
                <option v-for="(type, index) in intaketypes" :key="'intaketype'+index" :value="type.id" :selected="oldvalues[editform ? 'intake_type_id' : 'intake-type'] == type.id ? 'selected' : ''">{{type.name}}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <input type="hidden" name="is-neutered" value="0">
            <input type="checkbox" name="is-neutered" id="is-neutered" :checked="oldvalues[editform ? 'is_neutered' : 'is-neutered'] == '1' ? 'checked' : ''">
            <label for="is-neutered">Spayed/neutered</label>
        </div>
    </div>
    <div class="form-row" v-if="editform">
        <div class="animal-images" style="width: 100%">
            <div v-for="(image, index) in oldvalues['images']" :key="'image'+index" class="animal-image-container" style="position: relative; float: left; width: 150px; height: 150px; margin-right: 1em; margin-bottom: 1em">
                <span @click="deleteImage(image.id)" class="delete-button" style="background-color: #FFF; padding: 2px 8px; position: absolute; x: 0; y: 0; cursor: pointer">x</span>
                <img :src="'/storage' + image.path.slice(6)" :id="image.id" class="animal-image" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
    <image-upload/>
    <button type="submit" class="btn btn-success">Save</button>
</form>
</template>

<script>
import SearchableSelect from './SearchableSelect.vue';
import ImageUpload from './ImageUpload.vue';
export default {
    mounted() {
        console.log('Vue: AnimalForm Component mounted.');
    },
    data: function() {
        return {
            selectedSpecies: null
        }
    },
    methods: {
        getRouteFormSubmit() {
            let route = '/animals';
            if (this.editform)
                route += `/${this.oldvalues['id']}`;
            return route;
        },
        onSpeciesChange(option) {
            if (option.name)
                this.selectedSpecies = option.name;
        },
        isSelectedBreed(breedId) {
            if (this.editform && this.oldvalues['breeds'].find(breed => breed.id == breedId)) {
                return 'selected';
            } else if (this.oldvalues['breed'] == breedId) {
                return 'selected'
            }
            return '';
        },
        deleteImage(imageId) {
            axios.delete(`/api/images/${imageId}`, null, null)
            .then((response) => { // success
                this.oldvalues['images'] = this.oldvalues['images'].filter(image => image.id !== imageId);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(() => {
                // always executed
            });
        }
    },
    props: {
        csrf:        { type: String, default: '' },
        oldvalues:   { type: Array | Object, default: '' },
        species:     { type: Array, default: '' },
        staff:       { type: Array, default: '' },
        livingareas: { type: Array, default: '' },
        colors:      { type: Array, default: '' },
        sizes:       { type: Array, default: '' },
        genders:     { type: Array, default: '' },
        date:        { type: String, default: '' },
        intaketypes: { type: Array, default: '' },
        calls:       { type: Array, default: '' },
        people:      { type: Array, default: '' },
        editform:    { type: Boolean, default: false}
    },
    components: {
        SearchableSelect,
        ImageUpload
    }
}
</script>

<style scoped>
    form {
        margin-bottom: 3rem;
    }
</style>