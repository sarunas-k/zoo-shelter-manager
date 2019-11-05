<template>
    <form method="POST" :action="routeAnimalsIndex()" enctype="multipart/form-data">
    <input type="hidden" name="_token" :value="csrf">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="animal-number">Animal number</label>
            <input type="text" class="form-control" id="animal-number" name="animal-number" placeholder="Number" :value="oldvalues['animal-number']">
        </div>
        <div class="form-group col-md-4">
            <label for="species">Species</label>
            <searchable-select :options="species" name="species" placeholder="Species" :default="oldvalues['species']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option>---</option>
                <option v-for="(gender, index) in genders" :key="index" :selected="oldvalues['gender'] == gender ? 'selected' : ''">{{gender}}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" :value="oldvalues['name']">
        </div>
        <div class="form-group col-md-4">
            <label for="birthdate">Date of Birth</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" :value="oldvalues['birthdate']">
        </div>
        <div class="form-group col-md-4">
            <label for="color">Color</label>
            <searchable-select :options="colors" name="color" placeholder="Color" :default="oldvalues['color']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="breed">Breed</label>
            <select class="form-control" id="breed" name="breed[]" multiple>
                <optgroup :label="value.name" v-for="(value, index) in species.filter(item => item.breeds.length)" :key="index">
                    <option v-for="(breed, i) in value.breeds" :key="i" :value="breed.id" :selected="oldvalues['breed'] == breed.id ? 'selected' : ''">{{breed.name}}</option>
                </optgroup>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="staff">Responsible staff</label>
            <searchable-select :options="staff" name="staff" placeholder="Staff" :default="oldvalues['staff']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="microchip">Microchip number</label>
            <input type="text" class="form-control" id="microchip" name="microchip" placeholder="Microchip number"
                :value="oldvalues['microchip']">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
                <option>---</option>
                <option v-for="(size, index) in sizes" :key="index" :selected="oldvalues['size'] == size ? 'selected' : ''">{{size}}</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="intake-date">Intake Date</label>
            <input type="datetime-local" class="form-control" id="intake-date" name="intake-date"
                :value="oldvalues['intake-date'] ? oldvalues['intake-date'] : date">
        </div>
        <div class="form-group col-md-4">
            <label for="living-area">Living area</label>
            <searchable-select :options="livingareas" name="living-area" placeholder="Living area" :default="oldvalues['living-area']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="intake-type">Intake type</label>
            <select class="form-control" id="intake-type" name="intake-type">
                <option>---</option>
                <option v-for="type in intaketypes" :key="type.id" :value="type.id" :selected="oldvalues['intake-type'] == type.id ? 'selected' : ''">{{type.name}}</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="call">Reference call</label>
            <searchable-select :options="calls" name="call" placeholder="Reference call" :default="oldvalues['call']"/>
        </div>
        <div class="form-group col-md-4">
            <label for="bring-in-person">Person bringing animal in</label>
            <searchable-select :options="people" name="bring-in-person" display="full_name_with_address" placeholder="Person" :default="oldvalues['bring-in-person']"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <input type="hidden" name="is-neutered" value="0">
            <input type="checkbox" name="is-neutered" id="is-neutered" :checked="oldvalues['is-neutered'] == '1' ? 'checked' : ''">
            <label for="is-neutered">Spayed/neutered</label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <input-file name="animal-image" :multiple="true" :onlyImages="true" @inputChange="onImageInputChange">
                Add Image
            </input-file>
        </div>
        <div class="form-group col-md-10">
            <image-upload-preview :files="files"/>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
</template>

<script>
import SearchableSelect from './SearchableSelect.vue';
import ImageUploadPreview from './ImageUploadPreview.vue';
import InputFile from './InputFile.vue';
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
        csrf:        { type: String, default: '' },
        oldvalues:   { type: Array, default: '' },
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
    },
    components: {
        SearchableSelect,
        ImageUploadPreview,
        InputFile
    }
}
</script>

<style scoped>
    form {
        margin-bottom: 3rem;
    }
</style>