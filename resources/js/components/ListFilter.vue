<template>
    <div class="list-filter" :class="{disabled: !initialized}">
        <div class="list-filter-buttons float-left ml-3 mt-1">
            <span v-for="(filterValues, filterName, index) in initialFilters" :key="index" :class="['dropdown', `filter-${filterName}`]">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" :id="`menuButton${filterName}`" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">{{filterName}}</span>
                </button>
                <div class="dropdown-menu px-2" @click="$event.stopPropagation()" :aria-labelledby="`menuButton${filterName}`">
                    <div v-for="(value, i) in filterValues" :key="i" :class="['form-check', 'dropdown-item', `filter-value-${value}`]">
                        <input v-model="checkedFilterItems[filterName]" class="form-check-input" type="checkbox" :value="value" :id="value" @change="emitFilterChangeEvent">
                        <label class="form-check-label" :for="value">
                            {{value}}
                        </label>
                    </div>
                </div>
            </span>
            <br>
        </div>
        <br>
        <div class="filter-badges">
            <template v-for="(filterValues, filterName) in checkedFilterItems">
                <span :key="item" v-for="item in checkedFilterItems[filterName]" class="filter-badge badge badge-pill mr-1" @click="removeFromFilter(item, filterName)">{{item}} X</span>
            </template>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log('Vue: ListFilter Component mounted.');
            console.log('[Prop] Initial filters:', this.initialFilters);
            console.log('[Prop] Checked filters:', this.checkedFilters);
        },
        data: function() {
            return {
                initialized: false,
                checkedFilterItems: {}
            }
        },
        methods: {
            removeFromFilter(item, filterName) {
                this.checkedFilterItems[filterName] = this.checkedFilterItems[filterName].filter(i => i !== item);
                this.emitFilterChangeEvent();
            },
            emitFilterChangeEvent() {
                this.$emit('filter-change', this.checkedFilterItems);
            }
        },
        props: ['initialFilters', 'checkedFilters'],
        watch: { 
      	    initialFilters() {
                this.initialized = true;
            },
            checkedFilters() {
                this.checkedFilterItems = {...this.checkedFilters};
            }
        }
    }
</script>

<style scoped>
.disabled {
    pointer-events: none;
    opacity: 0.7;
}
.animals-list .filter-badges {
    clear: left;
    float: left;
    margin-bottom: 15px;
}
.animals-list .filter-badges .filter-badge {
    cursor: pointer;
    background-color: #FFFFFF;
    border: 1px solid #5b5b5b;
    color: #5b5b5b;
    font-weight: normal;
}
.animals-list .filter-badges .filter-badge:hover {
    border: 1px solid #000000;
    color: #000000;
}
.filter-title {
    text-transform: uppercase;
}
</style>
