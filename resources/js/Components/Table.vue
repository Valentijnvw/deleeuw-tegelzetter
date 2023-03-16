<script setup>
import {onMounted, ref} from 'vue';
// defineProps()
import DataTable from 'datatables.net';

const table = ref(null);

onMounted(() => {
  table.value = new DataTable('.js-datatable', {
    columnDefs: [{
      "targets": [0, 3],
      // "orderable": false
    }],
    order: [],
    info: {
      // totalQty: "#datatableWithPaginationInfoTotalQty"
    },
    // search: "#datatableSearch",
    // entries: "#datatableEntries",
    pageLength: 15,
    isResponsive: false,
    isShowPaging: false,
    pagination: "datatablePagination"
  });
})

const log = function(e) {
  console.log(this.value);
}

</script>

<template>
    <!-- Header -->
    <div class="card-header card-header-content-md-between">
      <div class="mb-2 mb-md-0">
        <form>
          <!-- Search -->
          <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend input-group-text">
              <i class="bi-search"></i>
            </div>
            <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
          </div>
          <!-- End Search -->
        </form>
      </div>

      <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
        <!-- Datatable Info -->
        <div id="datatableCounterInfo" style="display: none;">
          <div class="d-flex align-items-center">
            <span class="fs-5 me-3">
              <span id="datatableCounter">0</span>
              Selected
            </span>
            <a class="btn btn-outline-danger btn-sm" href="javascript:;">
              <i class="bi-trash"></i> Delete
            </a>
          </div>
        </div>
        <!-- End Datatable Info -->
      </div>
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="table-responsive datatable-custom position-relative">
      <table class="js-datatable table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
        <thead class="thead-light">
            <slot name="head" />
        </thead>

        <tbody>
          <slot name="body" />
        </tbody>
      </table>
    </div>
    <!-- End Table -->

    
</template>
