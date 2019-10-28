<template>
    <form method="POST" :action="routeAnimalsIndex()" enctype="multipart/form-data">
    <input type="hidden" name="_token" :value="csrf">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="animal-number">Animal number</label>
            <input type="text" class="form-control" id="animal-number" name="animal-number" placeholder="Number" :value="oldObj['animal-number']">
        </div>
        <div class="form-group col-md-4">
            <label for="species">Species</label>
            <searchable-select :options="speciesObj" name="species" placeholder="Species" :default="oldObj['species']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option>---</option>
                <option v-for="(gender, index) in gendersObj" :key="index" :selected="oldObj['gender'] == gender ? 'selected' : ''">{{gender}}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" :value="oldObj['name']">
        </div>
        <div class="form-group col-md-4">
            <label for="birthdate">Date of Birth</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" :value="oldObj['birthdate']">
        </div>
        <div class="form-group col-md-4">
            <label for="color">Color</label>
            <searchable-select :options="colorsObj" name="color" placeholder="Color" :default="oldObj['color']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="breed">Breed</label>
            <select class="form-control" id="breed" name="breed[]" multiple>
                <optgroup :label="value.name" v-for="(value, index) in speciesObj.filter(item => item.breeds.length)" :key="index">
                    <option v-for="(breed, i) in value.breeds" :key="i" :value="breed.id" :selected="oldObj['breed'] == breed.id ? 'selected' : ''">{{breed.name}}</option>
                </optgroup>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="staff">Responsible staff</label>
            <searchable-select :options="staffObj" name="staff" placeholder="Staff" :default="oldObj['staff']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="microchip">Microchip number</label>
            <input type="text" class="form-control" id="microchip" name="microchip" placeholder="Microchip number"
                :value="oldObj['microchip']">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
                <option>---</option>
                <option v-for="(size, index) in sizesObj" :key="index" :selected="oldObj['size'] == size ? 'selected' : ''">{{size}}</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="intake-date">Intake Date</label>
            <input type="datetime-local" class="form-control" id="intake-date" name="intake-date"
                :value="oldObj['intake-date'] ? oldObj['intake-date'] : date">
        </div>
        <div class="form-group col-md-4">
            <label for="living-area">Living area</label>
            <searchable-select :options="livingareasObj" name="living-area" placeholder="Living area" :default="oldObj['living-area']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <input type="hidden" name="is-neutered" value="0">
            <input type="checkbox" name="is-neutered" id="is-neutered" :checked="oldObj['is-neutered'] == '1' ? 'checked' : ''">
            <label for="is-neutered">Spayed/neutered</label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="animal-image">Image</label><br>
            <input type="file" class="form-control-file" name="animal-image[]" id="animal-image" ref="fileInput" multiple @change="onImageInputChange">
        </div>
        <div class="form-group col-md-9">
            <image-preview :files="files"/>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
</template>

<script>
import SearchableSelect from './SearchableSelect.vue';
import ImagePreview from './ImagePreview.vue';
export default {
    mounted() {
        console.log('Vue: AnimalCreateForm Component mounted.');
    },
    data: function() {
        return {
            files: {}
        }
    },
    methods: {
        routeAnimalsIndex() {
            return '/animals';
        },
        onImageInputChange(event) {
            this.files = event.target.files;
        }
    },
    props: {
        csrf:       { type: String, default: '' },
        old:        { type: String, default: '' },
        species:    { type: String, default: '' },
        staff:      { type: String, default: '' },
        livingareas:{ type: String, default: '' },
        colors:     { type: String, default: '' },
        sizes:      { type: String, default: '' },
        genders:    { type: String, default: '' },
        date:       { type: String, default: '' }
    },
    computed: {
        oldObj() {
            return JSON.parse(this.old);
        },
        speciesObj() {
            return JSON.parse(this.species);
        },
        staffObj() {
            return JSON.parse(this.staff)
                .map((staffer) => { // Append 'name' property for displaying
                    return {...staffer, ...{ name: `${staffer.first_name} ${staffer.last_name}` } }
                });
        },
        livingareasObj() {
            return JSON.parse(this.livingareas);
        },
        colorsObj() {
            return JSON.parse(this.colors);
        },
        sizesObj() {
            return JSON.parse(this.sizes);
        },
        gendersObj() {
            return JSON.parse(this.genders);
        }
    },
    components: {
        SearchableSelect,
        ImagePreview
    }
}
</script>

<style scoped>

</style>