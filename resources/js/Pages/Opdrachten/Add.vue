<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StepForm from '@/Components/StepForm.vue';
import MoneybirdContactSelector from '@/Components/MoneybirdContactSelector.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { useIMask  } from 'vue-imask';
import { onMounted } from 'vue';
import flatpickr from 'flatpickr';

const props = defineProps({
    
});

const form = useForm({
    titel: '',
    omschrijving: '',
    klant_moneybird_id: '',
    email: '',
    start_datum: '',
    eind_datum: '',
    aannemer_id: '',
});

const submitForm = () => {
  form.post(route('opdracht.store'));
}

onMounted(() => {
  $(".flatpickr").flatpickr({
    dateFormat: "d-m-Y"
  });

})

</script>

<style>
  /* @import "node_modules/tom-select/dist/css/tom-select.css"; */
  @import "flatpickr";
</style>

<style src="node_modules/tom-select/dist/css/tom-select.bootstrap5.css">

</style>

<template>
    <AuthenticatedLayout>
      <!-- Page Header -->
      <div class="page-header">
          <div class="row align-items-end">
            <div class="col-sm mb-sm-0">
              <h1 class="page-header-title">Opdracht toevoegen</h1>
            </div>
            <!-- End Col -->

          </div>
          <!-- End Row -->
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <!-- End Page Header -->
            <div class="card p-4">
              <form @submit.prevent="submitForm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Opdracht titel</label>
                        <input type="text" v-model="form.titel" class="form-control" placeholder="Opdracht naam">
                      </div>
                      
                      <div class="mb-3">
                        <label class="form-label">Selecteer een klant</label>
                        <MoneybirdContactSelector v-model="form.klant_moneybird_id" id="test123" placeholder="Selecteer een klant" name="moneybird_id" />
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Start datum</label>
                        <input type="text" v-model="form.start_datum" class="form-control flatpickr" placeholder="Start datum">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Eind datum</label>
                        <input type="text" v-model="form.eind_datum" class="form-control flatpickr" placeholder="Eind datum">
                      </div>

                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="exampleFormControlInput1">Omschrijving</label>
                    <textarea type="text" v-model="form.omschrijving" class="form-control" placeholder="Opdracht omschrijving" rows="4" />
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="bi-check ms-1"></i> Opdracht toevoegen</button>
                </div>
              </form>
            </div>

          </div>
        </div>
    </AuthenticatedLayout>
</template>