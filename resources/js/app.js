
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('search-field', require('./components/SearchField.vue').default);
Vue.component('animals-index', require('./components/AnimalsIndex.vue').default);
Vue.component('reports', require('./components/Reports.vue').default);
Vue.component('list-filter', require('./components/ListFilter.vue').default);
Vue.component('delete-button', require('./components/DeleteButton.vue').default);
Vue.component('animal-form', require('./components/AnimalForm.vue').default);
Vue.component('searchable-select', require('./components/SearchableSelect.vue').default);
Vue.component('animals-list', require('./components/AnimalsList.vue').default);
Vue.component('pagination-links', require('./components/PaginationLinks.vue').default);
Vue.component('image-upload-preview', require('./components/ImageUploadPreview.vue').default);
Vue.component('input-file', require('./components/InputFile.vue').default);
Vue.component('settings', require('./components/Settings.vue').default);
Vue.component('image-upload', require('./components/ImageUpload.vue').default);
Vue.component('dialog-box', require('./components/DialogBox.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
