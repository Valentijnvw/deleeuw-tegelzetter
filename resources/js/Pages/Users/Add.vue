<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MoneybirdContactSelector from '@/Components/MoneybirdContactSelector.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { useIMask  } from 'vue-imask';
import { onMounted, computed } from 'vue';
import { capitalizeFirstLetter } from '@/util/stringUtils';

const props = defineProps({
  roleList: Array,
});

const klantRoleIndex = props.roleList.map(obj => obj.name).indexOf("klant");
const klantRoleId = props.roleList[klantRoleIndex].id;
const klantToevoegen = computed(() => {
  return form.account_type === klantRoleId;
})

const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    // account_type: props.roleList[0].id,
});

onMounted(() => {
  new HSStepForm('.js-step-form', {
    finish: () => {
      document.getElementById("addUserStepFormProgress").style.display = 'none'
      document.getElementById("addUserStepProfile").style.display = 'none'
      document.getElementById("addUserStepBillingAddress").style.display = 'none'
      document.getElementById("addUserStepConfirmation").style.display = 'none'
      document.getElementById("successMessageContent").style.display = 'block'
      scrollToTop('#header');
      const formContainer = document.getElementById('formContainer')
    },
    onNextStep: function () {
      scrollToTop()
    },
    onPrevStep: function () {
      scrollToTop()
    }
  })
  
})


</script>

<style>
.step .active .step-icon, .step .active.is-valid .step-icon, .step .visited .step-icon {
  background-color: #A1313B !important;
}
.step .active .step-title, .step .active.is-valid .step-title, .step .visited .step-title {
  color: #A1313B !important;
}
</style>

<template>
    <AuthenticatedLayout>
    <!-- Step Form -->
    <form class="js-step-form py-md-5" data-hs-step-form-options='{
              "progressSelector": "#addUserStepFormProgress",
              "stepsSelector": "#addUserStepFormContent",
              "endSelector": "#addUserFinishBtn",
              "isValidate": false
            }'>
        <div class="row justify-content-lg-center">
          <div class="col-lg-8">
            <!-- Step -->
            <ul id="addUserStepFormProgress" class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">
              <li class="step-item">
                <a class="step-content-wrapper" href="javascript:;" data-hs-step-form-next-options='{
                    "targetSelector": "#addUserStepProfile"
                  }'>
                  <span class="step-icon step-icon-soft-dark">1</span>
                  <div class="step-content">
                    <span class="step-title t-orange">Gegevens</span>
                  </div>
                </a>
              </li>

              <li class="step-item">
                <a class="step-content-wrapper" href="javascript:;" data-hs-step-form-next-options='{
                    "targetSelector": "#addUserStepConfirmation"
                  }'>
                  <span class="step-icon step-icon-soft-dark">2</span>
                  <div class="step-content">
                    <span class="step-title">Bevestiging</span>
                  </div>
                </a>
              </li>
            </ul>
            <!-- End Step -->

            <!-- Content Step Form -->
            <div id="addUserStepFormContent">
              <!-- Card -->
              <div id="addUserStepProfile" class="card card-lg active">
                <!-- Body -->
                <div class="card-body">
                  <!-- OVERIG: -->

                  <!-- Form -->
                  <div class="row mb-4">
                    <label class="col-sm-3 col-form-label form-label">Account type</label>

                    <div class="col-sm-9">
                      <div class="input-group input-group-sm-vertical">
                        <!-- Radio Check -->
                        <label class="form-control" v-for="role in roleList" :key="role.id">
                          <span class="form-check">
                            <input type="radio" :value="role.id" class="form-check-input" v-model="form.account_type" name="userAccountTypeRadio">
                            <span class="form-check-label" v-text="capitalizeFirstLetter(role.name)"></span>
                          </span>
                        </label>
                        <!-- End Radio Check -->

                      </div>
                    </div>
                  </div>
                  <!-- End Form -->

                  <template v-if="klantToevoegen">
                    <!-- KLANT: -->
                    <div class="row mb-4" v-if="klantToevoegen">
                      <label class="col-sm-3 col-form-label form-label">Selecteer een klant</label>
  
                      <div class="col-sm-9">
                          <MoneybirdContactSelector v-model="form.klant_moneybird_id" id="test123" placeholder="Selecteer een klant..." name="moneybird_id" />
                      </div>
                    </div>
                    <!-- End Form -->

                  </template>

                  <template v-else>
                    <!-- Form: overig -->
                    <div class="row mb-4">
                      <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Volledige naam</label>
  
                      <div class="col-sm-9">
                        <div class="input-group input-group-sm-vertical">
                          <input type="text" v-model="form.firstName" class="form-control" name="firstName" id="firstNameLabel" placeholder="Voornaam">
                          <input type="text" v-model="form.lastName" class="form-control" name="lastName" id="lastNameLabel" placeholder="Achternaam">
                        </div>
                      </div>
                    </div>
                    <!-- End Form -->
  
                    <!-- Form -->
                    <div class="row mb-4">
                      <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>
  
                      <div class="col-sm-9">
                        <input type="email" v-model="form.email" class="form-control" name="email" id="emailLabel" placeholder="E-mailadres">
                      </div>
                    </div>
                    <!-- End Form -->
  
                    <!-- Form -->
                    <div class="js-add-field row mb-4" data-hs-add-field-options='{
                            "template": "#addPhoneFieldTemplate",
                            "container": "#addPhoneFieldContainer",
                            "defaultCreated": 0
                          }'>
                      <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Telefoonnummer</label>
  
                      <div class="col-sm-9">
                        <div class="input-group input-group-sm-vertical">
                          <input type="text" v-model="form.phone" class="js-input-mask form-control" name="phone" id="phoneLabel" placeholder="Telefoonnummer (bijv. 0612345678)">
  
                        </div>
                      </div>
                    </div>
                    <!-- End Form -->
                  </template>
                  
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                  <button type="button" class="btn btn-primary" data-hs-step-form-next-options='{
                            "targetSelector": "#addUserStepConfirmation"
                          }'>
                    Volgende <i class="bi-chevron-right"></i>
                  </button>
                </div>
                <!-- End Footer -->
              </div>
              <!-- End Card -->

              <div id="addUserStepConfirmation" class="card card-lg" style="display: none;">
                <!-- Profile Cover -->
                <div class="profile-cover">
                  <div class="profile-cover-img-wrapper">
                    <img class="profile-cover-img" src="./../../../img/1920x400/img1.jpg" alt="Image Description">
                  </div>
                </div>
                <!-- End Profile Cover -->

                <!-- Avatar -->
                <div class="avatar avatar-xxl avatar-circle avatar-border-lg profile-cover-avatar">
                  <img class="avatar-img" src="./../../../img/160x160/img9.jpg" alt="Image Description">
                </div>
                <!-- End Avatar -->

                <!-- Body -->
                <div class="card-body">
                  <dl class="row">
                    <dt class="col-sm-6 text-sm-end">Full name:</dt>
                    <dd class="col-sm-6" v-text="form.firstName + ' ' + form.lastName"></dd>

                    <dt class="col-sm-6 text-sm-end">Email:</dt>
                    <dd class="col-sm-6" v-text="form.email"></dd>

                    <dt class="col-sm-6 text-sm-end">Telefoonnummer:</dt>
                    <dd class="col-sm-6" v-text="form.phone"></dd>

                    <dt class="col-sm-6 text-sm-end">Department:</dt>
                    <dd class="col-sm-6">-</dd>

                    <dt class="col-sm-6 text-sm-end">Account type:</dt>
                    <dd class="col-sm-6">Individual</dd>
                  </dl>
                  <!-- End Row -->
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="card-footer d-sm-flex align-items-sm-center">
                  <button type="button" class="btn btn-ghost-secondary mb-2 mb-sm-0" data-hs-step-form-prev-options='{
                       "targetSelector": "#addUserStepProfile"
                     }'>
                    <i class="bi-chevron-left"></i> Vorige stap
                  </button>

                  <div class="ms-auto">
                    <button id="addUserFinishBtn" type="button" class="btn btn-primary">Gebruiker toevoegen</button>
                  </div>
                </div>
                <!-- End Footer -->
              </div>
            </div>
            <!-- End Content Step Form -->

            <!-- Message Body -->
            <div id="successMessageContent" style="display:none;">
              <div class="text-center">
                <img class="img-fluid mb-3" src="../../../svg/illustrations/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">
                <img class="img-fluid mb-3" src="../../../svg/illustrations-light/oc-hi-five.svg" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">

                <div class="mb-4">
                  <h2>Successful!</h2>
                  <p>New <span class="fw-semibold text-dark">Ella Lauda</span> user has been successfully created.</p>
                </div>

                <div class="d-flex justify-content-center">
                  <a class="btn btn-white me-3" href="./users.html">
                    <i class="bi-chevron-left ms-1"></i> Back to users
                  </a>
                  <a class="btn btn-primary" href="./users-add-user.html">
                    <i class="bi-person-plus-fill me-1"></i> Add new user
                  </a>
                </div>
              </div>
            </div>
            <!-- End Message Body -->
          </div>
        </div>
        <!-- End Row -->
      </form>
      <!-- End Step Form -->
    </AuthenticatedLayout>
</template>