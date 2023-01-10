<script setup>
// defineProps({
// });
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

        <!-- Dropdown -->
        <div class="dropdown">
          <button type="button" class="btn btn-white btn-sm dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi-download me-2"></i> Export
          </button>

          <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown">
            <span class="dropdown-header">Options</span>
            <a id="export-copy" class="dropdown-item" href="javascript:;">
              <img class="avatar avatar-xss avatar-4x3 me-2" src="@/resources/svg/illustrations/copy-icon.svg" alt="Image Description">
              Copy
            </a>
            <a id="export-print" class="dropdown-item" href="javascript:;">
              <img class="avatar avatar-xss avatar-4x3 me-2" src="@/resources/svg/illustrations/print-icon.svg" alt="Image Description">
              Print
            </a>
            <div class="dropdown-divider"></div>
            <span class="dropdown-header">Download options</span>
            <a id="export-excel" class="dropdown-item" href="javascript:;">
              <img class="avatar avatar-xss avatar-4x3 me-2" src="@/resources/svg/brands/excel-icon.svg" alt="Image Description">
              Excel
            </a>
            <a id="export-csv" class="dropdown-item" href="javascript:;">
              <img class="avatar avatar-xss avatar-4x3 me-2" src="@/resources/svg/components/placeholder-csv-format.svg" alt="Image Description">
              .CSV
            </a>
            <a id="export-pdf" class="dropdown-item" href="javascript:;">
              <img class="avatar avatar-xss avatar-4x3 me-2" src="@/resources/svg/brands/pdf-icon.svg" alt="Image Description">
              PDF
            </a>
          </div>
        </div>
        <!-- End Dropdown -->

        <!-- Dropdown -->
        <div class="dropdown">
          <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <i class="bi-filter me-1"></i> Filter <span class="badge bg-soft-dark text-dark rounded-circle ms-1">2</span>
          </button>

          <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered" aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
            <!-- Card -->
            <div class="card">
              <div class="card-header card-header-content-between">
                <h5 class="card-header-title">Filter users</h5>

                <!-- Toggle Button -->
                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                  <i class="bi-x-lg"></i>
                </button>
                <!-- End Toggle Button -->
              </div>

              <div class="card-body">
                <form>
                  <div class="mb-4">
                    <small class="text-cap text-body">Role</small>

                    <div class="row">
                      <div class="col">
                        <!-- Check -->
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="usersFilterCheckAll" checked>
                          <label class="form-check-label" for="usersFilterCheckAll">
                            All
                          </label>
                        </div>
                        <!-- End Check -->
                      </div>
                      <!-- End Col -->

                      <div class="col">
                        <!-- Check -->
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="usersFilterCheckEmployee">
                          <label class="form-check-label" for="usersFilterCheckEmployee">
                            Employee
                          </label>
                        </div>
                        <!-- End Check -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
                  </div>

                  <div class="row">
                    <div class="col-sm mb-4">
                      <small class="text-cap text-body">Position</small>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select js-datatable-filter form-select form-select-sm" data-target-column-index="2" data-hs-tom-select-options='{
                                  "placeholder": "Any",
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                          <option value="">Any</option>
                          <option value="Accountant">Accountant</option>
                          <option value="Co-founder">Co-founder</option>
                          <option value="Designer">Designer</option>
                          <option value="Developer">Developer</option>
                          <option value="Director">Director</option>
                        </select>
                        <!-- End Select -->
                      </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm mb-4">
                      <small class="text-cap text-body">Status</small>

                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select js-datatable-filter form-select form-select-sm" data-target-column-index="4" data-hs-tom-select-options='{
                                  "placeholder": "Any status",
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                          <option value="">Any status</option>
                          <option value="Completed" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-success"></span>Completed</span>'>Completed</option>
                          <option value="In progress" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-warning"></span>In progress</span>'>In progress</option>
                          <option value="To do" data-option-template='<span class="d-flex align-items-center"><span class="legend-indicator bg-danger"></span>To do</span>'>To do</option>
                        </select>
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Col -->

                    <div class="col-12 mb-4">
                      <span class="text-cap text-body">Location</span>

                      <!-- Select -->
                      <div class="tom-select-custom">
                      
                      </div>
                      <!-- End Select -->
                    </div>
                    <!-- End Col -->
                  </div>
                  <!-- End Row -->

                  <div class="d-grid">
                    <a class="btn btn-primary" href="javascript:;">Apply</a>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Card -->
          </div>
        </div>
        <!-- End Dropdown -->
      </div>
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="table-responsive datatable-custom position-relative">
      <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                "columnDefs": [{
                  "targets": [0, 7],
                  "orderable": false
                }],
                "order": [],
                "info": {
                  "totalQty": "#datatableWithPaginationInfoTotalQty"
                },
                "search": "#datatableSearch",
                "entries": "#datatableEntries",
                "pageLength": 15,
                "isResponsive": false,
                "isShowPaging": false,
                "pagination": "datatablePagination"
              }'>
        <thead class="thead-light">
            <slot name="head" />
        </thead>

        <tbody>
          <slot name="body" />
        </tbody>
      </table>
    </div>
    <!-- End Table -->

    <!-- Footer -->
    <div class="card-footer">
      <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
        <div class="col-sm mb-2 mb-sm-0">
          <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
            <span class="me-2">Showing:</span>

            <!-- Select -->
            <div class="tom-select-custom">
              <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                        "searchInDropdown": false,
                        "hideSearch": true
                      }'>
                <option value="10">10</option>
                <option value="15" selected>15</option>
                <option value="20">20</option>
              </select>
            </div>
            <!-- End Select -->

            <span class="text-secondary me-2">of</span>

            <!-- Pagination Quantity -->
            <span id="datatableWithPaginationInfoTotalQty"></span>
          </div>
        </div>
        <!-- End Col -->

        <div class="col-sm-auto">
          <div class="d-flex justify-content-center justify-content-sm-end">
            <!-- Pagination -->
            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Footer -->
</template>
