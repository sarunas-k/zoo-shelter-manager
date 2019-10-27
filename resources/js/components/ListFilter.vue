<template>
    <div class="list-filter" :class="{disabled: !initialized}">
        <div class="list-filter-buttons">
            <span v-for="(filterValues, filterName, index) in options" :key="index" :class="['dropdown', `filter-${filterName}`]">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" :id="`menuButton${filterName}`" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">{{filterName}}</span>
                </button>
                <div class="dropdown-menu px-2" @click="$event.stopPropagation()" :aria-labelledby="`menuButton${filterName}`">
                    <div 
                        v-for="(value, i) in filterValues"
                        :key="i"
                        :class="[
                                'form-check', 
                                'dropdown-item', 
                                `filter-value-${value}`, 
                                {'dropdown-item-active': checkedFilterItems[filterName].includes(value)}
                                ]"
                    >
                        <input v-model="checkedFilterItems[filterName]" class="form-check-input" type="checkbox" :value="value" :id="value" @change="emitFilterChangeEvent">
                        <label class="form-check-label" :for="value">
                            {{value}}
                        </label>
                    </div>
                </div>
            </span>
            <br>
        </div>
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
            console.log('[Prop] Filter options:', this.options);
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
        props: {
            options: {
                type: Object,
                required: true,
                default: {},
                note: 'Initial filters data e.g. { size: ["Small", "Medium", "Large"], etc... }'
            },
            checkedFilters: {
                type: Object,
                required: false,
                note: 'Filters that need to be selected'
            }
        }['options', 'checkedFilters'],
        watch: { 
      	    options() {
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
.list-filter .filter-badges {
    margin-top: 15px;
    margin-bottom: 15px;
}
.list-filter .filter-badges .filter-badge {
    cursor: pointer;
    background-color: #FFFFFF;
    border: 1px solid #5b5b5b;
    color: #5b5b5b;
    font-weight: normal;
}
.list-filter .filter-badges .filter-badge:hover {
    border: 1px solid #000000;
    color: #000000;
}
.list-filter .dropdown-menu {
    max-height: 300px;
    overflow: auto;
}
.list-filter .dropdown-item {
    margin-bottom: 1px;
}
.list-filter .dropdown-item-active {
    background-color: #EEEEEE;
}
.filter-title {
    text-transform: uppercase;
}
</style>
