<template>
    <div class="list-filter" v-if="initialized">
        <div class="list-filter-buttons">
            <span v-for="(categoryItems, filterCategory, index) in options" :key="index" :class="['dropdown', `filter-${filterCategory}`]">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" :id="`menuButton${filterCategory}`" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">{{filterCategory}}</span>
                </button>
                <div class="dropdown-menu px-2" @click="$event.stopPropagation()" :aria-labelledby="`menuButton${filterCategory}`">
                    <label v-for="(value, i) in categoryItems" :key="i" :class="['form-check', 'form-check-label', 'dropdown-item',
                        `filter-value-${value}`, {'dropdown-item-active': isChecked(value, filterCategory)}]">
                        <input v-model="checkedFilterItems[filterCategory]" class="form-check-input" type="checkbox" :value="value" :id="value" @change="emitFilterChangeEvent">
                        {{value}}
                    </label>
                </div>
            </span>
            <br>
        </div>
        <div class="filter-badges">
            <template v-for="(categoryItems, filterCategory) in checkedFilterItems">
                <span :key="item" v-for="item in categoryItems" class="filter-badge badge badge-pill mr-1" @click="removeFromFilter(item, filterCategory)">{{item}} X</span>
            </template>
        </div>
    </div>
</template>


<script>
    export default {
        mounted() {
            // console.log('Vue: ListFilter Component mounted.');
            // console.log('[Prop] Filter options:', this.options);
            // console.log('[Prop] Checked filters:', this.checkedFilters);
        },
        data: function() {
            return {
                initialized: false,
                checkedFilterItems: {}
            }
        },
        methods: {
            removeFromFilter(item, filterCategory) {
                if (!this.checkedFilterItems || !this.checkedFilterItems[filterCategory])
                    return;

                this.checkedFilterItems[filterCategory] = this.checkedFilterItems[filterCategory].filter(i => i !== item);
                this.emitFilterChangeEvent();
            },
            emitFilterChangeEvent() {
                this.$emit('filter-change', this.checkedFilterItems);
            },
            isChecked(item, filterCategory) {
                if (!this.checkedFilterItems || !this.checkedFilterItems[filterCategory])
                    return false;

                return this.checkedFilterItems[filterCategory].includes(item);
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
        },
        watch: {
      	    options() {
                this.initialized = true;
            },
            checkedFilters: {
                handler: function() { this.checkedFilterItems = {...this.checkedFilters} },
                deep: true
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
