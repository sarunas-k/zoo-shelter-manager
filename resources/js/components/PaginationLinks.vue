<template>
    <nav aria-label="Pagination" class="pagination-links">
        <ul class="pagination">
          <li class="page-item page-item-previous">
            <a class="page-link" aria-label="Previous" @click="navigatePrev">
              <span aria-hidden="true">&laquo;</span>
              <span class="visually-hidden">Previous</span>
            </a>
          </li>
          <li class="page-item"><span class="page-link">{{ currentPage }} of {{ totalPages }}</span></li>
          <li class="page-item page-item-next">
            <a class="page-link" aria-label="Next" @click="navigateNext">
              <span aria-hidden="true">&raquo;</span>
              <span class="visually-hidden">Next</span>
            </a>
          </li>
          <li>
            <span class="pagination-total">Total found: {{ total }}</span>
          </li>
        </ul>

    </nav>
</template>

<script>
export default {
    mounted() {
        //console.log('Vue: PaginationLinks Component mounted.');
    },
    props: {
        navigatePrev: {
            type: Function,
            required: true,
            note: 'Handler for navigating to previous page'
        },
        navigateNext: {
            type: Function,
            required: true,
            note: 'Handler for navigating to next page'
        },
        currentPage: {
            type: Number,
            required: true,
            default: 1,
            note: 'Current page number of a list'
        },
        totalPages: {
            type: Number,
            required: true,
            default: 1,
            note: 'Total number of pages in a list'
        },
        total: {
            type: Number,
            required: true,
            note: 'Total number of entries in a list'
        }
    }
}
</script>

<style scoped>
.pagination-total {
  line-height: 35px;
  margin-left: 1em;
  font-size: 0.9em;
}
.page-item.page-item-previous,
.page-item.page-item-next {
   cursor: pointer;
}
</style>