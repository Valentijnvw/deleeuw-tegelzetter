<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StepForm from '@/Components/StepForm.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { useIMask  } from 'vue-imask';
import { onMounted } from 'vue';
import flatpickr from 'flatpickr';
import TomSelect from 'tom-select';

const props = defineProps({
    
});

const form = useForm({
    naam: '',
    omschrijving: '',
    klant_moneybird_id: '',
    email: '',
    start_datum: '',
    eind_datum: '',
    aannemer_id: '',
});

const submitForm = () => {

}

onMounted(() => {
  $("#ex2").flatpickr();
})

</script>

<style src="../../../../node_modules/tom-select/dist/css/tom-select.css">
  /* @import "flatpickr"; */
  /* @import "tom-select"; */
</style>

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
        <div class="card p-4">
          <form @submit.prevent="submitForm">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Opdracht naam</label>
                  <input type="text" v-model="form.naam" class="form-control" placeholder="Opdracht naam">
                </div>
                <div class="mb-3">
                  <label class="form-label" for="exampleFormControlInput1">Start datum</label>
                  <input type="text" v-model="form.start_datum" class="form-control" placeholder="John Doe">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="exampleFormControlInput1">Omschrijving</label>
              <textarea type="text" v-model="form.omschrijving" class="form-control" placeholder="Opdracht omschrijving" rows="4" />
            </div>
          </form>
        </div>
    </AuthenticatedLayout>
</template>