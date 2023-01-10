<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import WachtwoordInput from '@/Components/WachtwoordInput.vue';
import Table from '@/Components/Table.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { truncateString } from '@/util/stringUtils';
const props = defineProps({
    opdrachtenList: Array,
});

console.log(props.opdrachtenList);

</script>

<template>
    <AuthenticatedLayout>
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Overview</li>
              </ol>
            </nav>

            <h1 class="page-header-title">Users</h1>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <a class="btn btn-primary" href="">
              <i class="bi-person-plus-fill me-1"></i> Opdracht toevoegen
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->


      <!-- Card -->
      <div class="card">
        <Table>
          <template #head>
            <tr>
              <th>Klant</th>
              <th>Omschrijving</th>
              <th>Start datum</th>
              <th>Eind datum</th>
            </tr>
          </template>

          <template #body>
            <tr v-for="opdracht in opdrachtenList" :key="opdracht.id">
              <td>{{ opdracht.user.first_name + " " + opdracht.user.last_name }}</td>
              <td>{{ truncateString(opdracht.omschrijving, 100) }}</td>
              <td>{{ opdracht.start_datum }}</td>
              <td>{{ opdracht.eind_datum }}</td>
            </tr>
          </template>
        </Table>
      </div>
      <!-- End Card -->
    </AuthenticatedLayout>

</template>