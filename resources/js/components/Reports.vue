<template>
<div class="reports">
    <div class="row mb-3 w-50">
        <div class="form-group col-md-8">
            <select class="form-select border border-dark-subtle" size="6" v-model="params.reportId">
                <option value="0" selected>All animals in shelter</option>
                <option value="1">Intakes</option>
                <option value="2">Adoptions</option>
                <option value="3">Reclaims</option>
                <option value="4">Fosters</option>
                <option value="5">Deceased</option>
            </select>
        </div>
    </div>
    <div class="row mb-3" v-if="params.reportId != 0">
        <div class="form-group col-md-4">
            <label class="form-label" for="date-from">From:</label>
            <input type="date" class="form-control border border-dark-subtle" id="date-from" name="date-from" v-model="params.dateFrom">
        </div>
        <div class="form-group col-md-4">
            <label class="form-label" for="date-to">Until:</label>
            <input type="date" class="form-control border border-dark-subtle" id="date-to" name="date-to" v-model="params.dateTo">
        </div>
    </div>
    <div class="row mb-3">
        <div class="form-group col-md-8">
            <button class="btn btn-primary w-50 text-white my-3" @click="createReport">Create report</button>
        </div>
    </div>
    <div class="report" :style="{opacity: tableOpacity}">
        <p>{{label}}</p>
        <p><strong>{{content}}</strong></p>
    </div>
</div>
</template>


<script>
    export default {
        mounted() {
            //console.log('Vue: Reports Component mounted.');
            this.params.dateFrom = this.todaysDate;
            this.params.dateTo = this.todaysDate;
        },
        data() {
            return {
                params: {
                    dateFrom: '',
                    dateTo: '',
                    reportId: '0',
                    },
                response: [],
                isLoading: false,
                label: '',
                content: ''
            }
        },
        methods: {
            updateView() {
                const reportId = this.response.reportId;
                const dateSuffix = this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                switch (reportId) {
                    case '0':
                        this.label = 'Animals in shelter:';
                        this.content = this.response.animalsCount;
                        break;
                    case '1':
                        this.label = 'Intakes from ' + dateSuffix;
                        this.content = this.response.animalsCount;
                        break;
                    case '2':
                        this.label = 'Adoptions from ' + dateSuffix;
                        this.content = this.response.adoptionsCount;
                        break;
                    case '3':
                        this.label = 'Reclaims from ' + dateSuffix;
                        this.content = this.response.reclaimsCount;
                        break;
                    case '4':
                        this.label = 'Fosters from ' + dateSuffix;
                        this.content = this.response.fostersCount;
                        break;
                    case '5':
                        this.label = 'Deceased from ' + dateSuffix;
                        this.content = this.response.deceasedCount;
                        break;
                    default:
                        break;
                }
            },
            createReport() {
                if (!this.params.dateFrom || !this.params.dateTo) {
                    this.label = '';
                    this.content = 'Incorrect dates';
                    return;
                }
                this.fetchReport();
            },
            fetchReport() {
                this.isLoading = true;
                //console.log("Fetching URL: /api/reports");

                axios.get(this.rootPath + 'api/reports', { params: this.params })
                .then((response) => { // success
                    // console.log("Response:");
                    // console.log(response);
                    this.response = response.data;
                    this.updateView();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    //console.log('Finished axios request');
                    this.isLoading = false;
                });
            }
        },
        computed: {
            tableOpacity() { return this.isLoading ? 0.6 : 1 },
            todaysDate() {
                const today = new Date();
                let month = today.getMonth() + 1; // months start from 0
                let day = today.getDate();
                if (month < 10) month = '0' + month;
                if (day < 10) day = '0' + day;
                return today.getFullYear() + '-' + month + '-' + day;
            },
            rootPath() {
                return window.rootPath;
            }
        }
    }
</script>
<style scoped>
.report p {
    margin-bottom: 0.5rem;
}
</style>
