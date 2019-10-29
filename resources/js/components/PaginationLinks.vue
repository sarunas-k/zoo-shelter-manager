<template>
    <nav aria-label="Pagination" class="pagination-links">
        <ul class="pagination">
          <li class="page-item" style="cursor: pointer">
            <a class="page-link" aria-label="Previous" @click="navigatePrev">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><span class="page-link">Page {{ currentPage }} of {{ totalPages }}</span></li>
          <li class="page-item" style="cursor: pointer">
            <a class="page-link" aria-label="Next" @click="navigateNext">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
    </nav>
</template>

<script>
export default {
    mounted() {
        console.log('Vue: PaginationLinks Component mounted.');
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
        }
    }
}
</script>

<style scoped>

</style>