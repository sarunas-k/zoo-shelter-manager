<template>
<div class="reports">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="date-from">From:</label>
            <input type="date" class="form-control" id="date-from" name="date-from" v-model="params.dateFrom">
        </div>
        <div class="form-group col-md-4">
            <label for="date-to">Until:</label>
            <input type="date" class="form-control" id="date-to" name="date-to" v-model="params.dateTo">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <select class="custom-select" size="7" v-model="params.reportId">
                <option value="0" selected>All animals in shelter</option>
                <option value="1">Intakes</option>
                <option value="2">Adoptions</option>
                <option value="3">Reclaims</option>
                <option value="4">Fosters</option>
                <option value="5">Deceased</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <button class="btn btn-primary btn-block" @click="createReport">Create report</button>
        </div>
    </div>
    <div class="report-content" :style="{opacity: tableOpacity}">
        {{label}} <strong>{{content}}</strong>
    </div>
</div>
</template>


<script>
    export default {
        mounted() {
            console.log('Vue: Reports Component mounted.');
            this.params.dateFrom = this.todaysDate;
            this.params.dateTo = this.todaysDate;
        },
        data: function() {
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
            updateView: function() {
                let reportId = this.response.reportId;
                if (reportId == '0') {
                    this.label = 'Animals in shelter:';
                    this.content = this.response.animalsCount;
                } else if (reportId == '1') {
                    this.label = 'Intakes from ' + this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                    this.content = this.response.animalsCount;
                } else if (reportId == '2') {
                    this.label = 'Adoptions from ' + this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                    this.content = this.response.adoptionsCount;
                } else if (reportId == '3') {
                    this.label = 'Reclaims from ' + this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                    this.content = this.response.reclaimsCount;
                } else if (reportId == '4') {
                    this.label = 'Fosters from ' + this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                    this.content = this.response.fostersCount;
                } else if (reportId == '5') {
                    this.label = 'Deceased from ' + this.response.dateFrom + ' to ' + this.response.dateTo + ':';
                    this.content = this.response.deceasedCount;
                }
                
            },
            createReport: function() {
                if (!this.params.dateFrom || !this.params.dateTo) {
                    this.label = '';
                    this.content = 'Incorrect dates';
                    return;
                }
                // Make XMLHttpRequest to get animal records and pass animal record filters
                this.fetch('/api/reports');
            },
            fetch: function(url) {
                if (!url)
                    return;
                
                this.isLoading = true;
                console.log("Fetching URL: " + url);

                axios.get(url, { params: this.params })
                .then((response) => { // success
                    console.log("Response:");
                    console.log(response);
                    this.response = response.data;
                    this.updateView();
                })
                .catch(function (error) { // error
                    // handle error
                    console.log(error);
                })
                .then(() => { // finally
                    // always executed
                    console.log('Finished axios request');
                    this.isLoading = false;
                });
            }
        },
        computed: {
            tableOpacity: function() {
                return this.isLoading ? 0.6 : 1;
            },
            todaysDate: function() {
                let today = new Date();
                let month = today.getMonth() + 1; // months start from "0"
                let day = today.getDate();
                if (month < 10) month = '0' + month;
                if (day < 10) day = '0' + day;
                return today.getFullYear() + '-' + month + '-' + day;
            }
        }
    }
</script>
