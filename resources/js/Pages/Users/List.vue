<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import WachtwoordInput from '@/Components/WachtwoordInput.vue';
import Table from '@/Components/Table.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { capitalizeFirstLetter } from '@/util/stringUtils';
const props = defineProps({
  userList: Array,
  roleList: Array,
  errors: Object,
});

const editingUser = ref(null);

// Details modal form
const detailsForm = useForm({
  id: '',
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  accountType: '',
});
const submitDetailsForm = () => {
    detailsForm.patch(route('user.update.details'), {
      onSuccess: () => $("#editUserModal").modal("hide"),
    })
};

// Edit password modal form
const showPassword = ref(false);
const passwordForm = useForm({
  id: '',
  newPassword: '',
  confirmPassword: '',
});
const submitPasswordForm = () => {
  passwordForm.patch(route('user.update.password'));
};

// Delete user modal form
const deleteUserForm = useForm({
  id: '',
  confirmed: false,
});
const submitDeleteUserForm = () => {
  deleteUserForm.post(route('user.delete'));
};

// Edit user button


function editUserModal(user) {
  editingUser.value = user;

  detailsForm.id = user.id;
  detailsForm.first_name = user.first_name;
  detailsForm.last_name = user.last_name;
  detailsForm.email = user.email;
  detailsForm.accountType = user.roles[0].id;

  passwordForm.id = user.id;

  deleteUserForm.id = user.id;
};

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
            <a class="btn btn-primary" :href="route('user.add')">
              <i class="bi-person-plus-fill me-1"></i> Gebruiker toevoegen
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <!-- Stats -->
      <div class="row">
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <div class="card-body">
              <h6 class="card-subtitle mb-2">Total users</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark">24</span>
                  <span class="text-body fs-5 ms-1">from 22</span>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> 5.0%
                  </span>
                </div>
                <!-- End Col -->
              </div>
              <!-- End Row -->
            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <div class="card-body">
              <h6 class="card-subtitle mb-2">Active members</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark">12</span>
                  <span class="text-body fs-5 ms-1">from 11</span>
                </div>

                <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> 1.2%
                  </span>
                </div>
              </div>
              <!-- End Row -->
            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <div class="card-body">
              <h6 class="card-subtitle mb-2">New/returning</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark">56</span>
                  <span class="display-4 text-dark">%</span>
                  <span class="text-body fs-5 ms-1">from 48.7</span>
                </div>

                <div class="col-auto">
                  <span class="badge bg-soft-danger text-danger p-1">
                    <i class="bi-graph-down"></i> 2.8%
                  </span>
                </div>
              </div>
              <!-- End Row -->
            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <div class="card-body">
              <h6 class="card-subtitle mb-2">Active members</h6>

              <div class="row align-items-center gx-2">
                <div class="col">
                  <span class="js-counter display-4 text-dark">28.6</span>
                  <span class="display-4 text-dark">%</span>
                  <span class="text-body fs-5 ms-1">from 28.6%</span>
                </div>

                <div class="col-auto">
                  <span class="badge bg-soft-secondary text-secondary p-1">0.0%</span>
                </div>
              </div>
              <!-- End Row -->
            </div>
          </div>
          <!-- End Card -->
        </div>
      </div>
      <!-- End Stats -->

      <!-- Card -->
      <div class="card">
        <Table>
          <template #head>
            <tr>
                <th class="table-column-pe-0">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                    <label class="form-check-label" for="datatableCheckAll"></label>
                  </div>
                </th>
                <th class="table-column-ps-0">Naam</th>
                <th>Account type</th>
                <th></th>
              </tr>
          </template>
          <template #body>
            <tr v-for="user in userList" :key="user.id">
              <td class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">
                  <label class="form-check-label" for="datatableCheckAll1"></label>
                </div>
              </td>
              <td class="table-column-ps-0">
                <span class="d-flex align-items-center">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="../../../img/160x160/img10.jpg" alt="Image Description">
                  </div>
                  <div class="ms-3">
                    <span class="d-block h5 text-inherit mb-0">{{ user.first_name + " " + user.last_name }}</span>
                    <span class="d-block fs-5 text-body">{{ user.email }}</span>
                  </div>
                </span>
              </td>
              <td>
                <span class="d-block h5 mb-0">{{ capitalizeFirstLetter(user.roles.map(role => role.name).join(", ")) }}</span>
              </td>
              <td>
                <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" @click="editUserModal(user);">
                  <i class="bi-pencil-fill me-1"></i> Bewerken
                </button>
              </td>
            </tr>
          </template>

        </Table>
      </div>
      <!-- End Card -->
    </AuthenticatedLayout>

    <!-- Modals -->
    <Modal title="Gebruiker bewerken" id="editUserModal">
      <!-- Nav Scroller -->
      <div class="js-nav-scroller hs-nav-scroller-horizontal">
        <span class="hs-nav-scroller-arrow-prev" style="display: none;">
          <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="bi-chevron-left"></i>
          </a>
        </span>

        <span class="hs-nav-scroller-arrow-next" style="display: none;">
          <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="bi-chevron-right"></i>
          </a>
        </span>

        <!-- Nav -->
        <ul class="js-tabs-to-dropdown nav nav-segment nav-fill mb-5" id="editUserModalTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#profile" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-selected="true">
              <i class="bi-person me-1"></i> Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#billing-address" id="billing-address-tab" data-bs-toggle="tab" data-bs-target="#billing-address" role="tab" aria-selected="false">
              <i class="bi-building me-1"></i> Billing address
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#change-password" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" role="tab" aria-selected="false">
              <i class="bi-shield-lock me-1"></i> Wachtwoord veranderen
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#delete-account" id="delete-account-tab" data-bs-toggle="tab" data-bs-target="#delete-account" role="tab" aria-selected="false">
              <i class="bi-trash me-1"></i> Account verwijderen
            </a>
          </li>
        </ul>
        <!-- End Nav -->
      </div>
      <!-- End Nav Scroller -->

      <!-- Tab Content -->
      <div class="tab-content" id="editUserModalTabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <form @submit.prevent="submitDetailsForm">
            <!-- Profile Cover -->
            <div class="profile-cover">
              <div class="profile-cover-img-wrapper">
                <img id="editProfileCoverImgModal" class="profile-cover-img" src="../../../img/1920x400/img1.jpg" alt="Image Description">

                <!-- Custom File Cover -->
                <div class="profile-cover-content profile-cover-uploader p-3">

                </div>
                <!-- End Custom File Cover -->
              </div>
            </div>
            <!-- End Profile Cover -->

            <!-- Avatar -->
            <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar mb-5" for="editAvatarUploaderModal">
              <img id="editAvatarImgModal" class="avatar-img" src="../../../img/160x160/img9.jpg" alt="Image Description">

              <input type="file" class="js-file-attach avatar-uploader-input" id="editAvatarUploaderModal" data-hs-file-attach-options='{
                          "textTarget": "#editAvatarImgModal",
                          "mode": "image",
                          "targetAttr": "src",
                          "allowTypes": [".png", ".jpeg", ".jpg"]
                        }'>

              <span class="avatar-uploader-trigger">
                <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
              </span>
            </label>
            <!-- End Avatar -->

            <!-- Form -->
            <div class="row mb-4">
              <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Volledige naam</label>

              <div class="col-sm-9">
                <div class="input-group input-group-sm-vertical">
                  <input type="text" v-model="detailsForm.first_name" class="form-control" name="firstName" id="firstNameLabel" placeholder="Voornaam">
                  <input type="text" v-model="detailsForm.last_name" class="form-control" name="lastName" id="lastNameLabel" placeholder="Achternaam">
                </div>
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
              <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>

              <div class="col-sm-9">
                <input type="email" v-model="detailsForm.email" class="form-control" name="email" id="emailLabel" placeholder="E-mailadres">
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
                  <input type="text" v-model="detailsForm.phone" class="js-input-mask form-control" name="phone" id="phoneLabel" placeholder="Telefoonnummer (bijv. 0612345678)">

                </div>
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Account type</label>

              <div class="col-sm-9">
                <div class="input-group input-group-sm-vertical">

                  <!-- Radio Check -->
                  <label class="form-control" v-for="role in roleList" :key="role.id">
                    <span class="form-check">
                      <input type="radio" :value="role.id" class="form-check-input" v-model="detailsForm.accountType" name="userAccountTypeRadio">
                      <span class="form-check-label" v-text="capitalizeFirstLetter(role.name)"></span>
                    </span>
                  </label>
                  <!-- End Radio Check -->
                </div>
              </div>
            </div>
            <!-- End Form -->

            <div class="d-flex justify-content-end">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Annuleren</button>
                <button type="submit" class="btn btn-primary" :class="{ 'opacity-25': detailsForm.processing }" :disabled="detailsForm.processing">Opslaan</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="billing-address" role="tabpanel" aria-labelledby="billing-address-tab">
          <form>
            <!-- Form -->
            <div class="row mb-4">
              <label for="editLocationModalLabel" class="col-sm-3 col-form-label form-label">Location</label>

              <div class="col-sm-9">
                <!-- Select -->
                <div class="tom-select-custom mb-4">
                  <select class="js-select form-select" id="editLocationModalLabel" autocomplete="off" data-hs-tom-select-options='{
                            "placeholder": "Select country"
                          }'>
                  </select>
                </div>
                <!-- End Select -->

                <div class="mb-4">
                  <input type="text" class="form-control" name="editCityModal" id="editCityModalLabel" placeholder="City" aria-label="City" value="London">
                </div>

                <input type="text" class="form-control" name="editStateModal" id="editStateModalLabel" placeholder="State" aria-label="State">
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
              <label for="editAddressLine1Label" class="col-sm-3 col-form-label form-label">Address line 1</label>

              <div class="col-sm-9">
                <input type="text" class="form-control" name="addressLine1" id="editAddressLine1Label" placeholder="Your address" aria-label="Your address" value="45 Roker Terrace, Latheronwheel">
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
              <label for="editAddressLine2ModalLabel" class="col-sm-3 col-form-label form-label">Address line 2 <span class="form-label-secondary">(Optional)</span></label>

              <div class="col-sm-9">
                <input type="text" class="form-control" name="editAddressLine2Modal" id="editAddressLine2ModalLabel" placeholder="Your address" aria-label="Your address">
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row">
              <label for="editZipCodeLabel" class="col-sm-3 col-form-label form-label">Zip code <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="You can find your code in a postal address."></i></label>

              <div class="col-sm-9">
                <input type="text" class="js-input-mask form-control" name="zipCode" id="editZipCodeLabel" placeholder="Your zip code" aria-label="Your zip code" value="KW5 8NW" data-hs-mask-options='{
                          "mask": "AA0 0AA"
                        }'>
              </div>
            </div>
            <!-- End Form -->

            <hr>

            <div class="d-grid gap-3">
              <!-- Form Switch -->
              <label class="row form-check form-switch" for="editUserModalBillingPreferencesSwitch1">
                <span class="col-8 col-sm-9 ms-0">
                  <span class="d-block text-dark mb-1">Default billing address</span>
                  <span class="d-block fs-5 text-muted">Set as default billing address</span>
                </span>
                <span class="col-4 col-sm-3 text-end">
                  <input type="checkbox" class="form-check-input" id="editUserModalBillingPreferencesSwitch1" checked>
                </span>
              </label>
              <!-- End Form Switch -->

              <!-- Form Switch -->
              <label class="row form-check form-switch" for="editUserModalBillingPreferencesSwitch2">
                <span class="col-8 col-sm-9 ms-0">
                  <span class="d-block text-dark mb-1">See info about people who view my profile</span>
                  <span class="d-block fs-5 text-muted"><a class="link" href="#">More about viewer info</a>.</span>
                </span>
                <span class="col-4 col-sm-3 text-end">
                  <input type="checkbox" class="form-check-input" id="editUserModalBillingPreferencesSwitch2">
                </span>
              </label>
              <!-- End Form Switch -->
            </div>

            <div class="d-flex justify-content-end mt-4">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Annuleren</button>
                <button type="submit" class="btn btn-primary">Opslaan</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
          <form @submit.prevent="submitPasswordForm">

            <!-- Form -->
            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Nieuw wachtwoord</label>
              <div class="col-sm-9">
                <WachtwoordInput
                  name="newPassword"
                  v-model="passwordForm.newPassword"
                  placeholder="Uw wachtwoord"
                  :error="props.errors.newPassword"
                />
              </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Herhaal nieuw wachtwoord</label>

              
              <div class="col-sm-9">
                <WachtwoordInput
                  name="confirmNewPassword"
                  v-model="passwordForm.confirmPassword"
                  placeholder="Bevestig wachtwoord"
                  :error="props.errors.confirmPassword"
                />
              </div>
            </div>
            <!-- End Form -->

            <div class="d-flex justify-content-end">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Annuleren</button>
                <button type="submit" class="btn btn-primary" :class="{ 'opacity-25': detailsForm.processing }" :disabled="detailsForm.processing">Opslaan</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="delete-account" role="tabpanel" aria-labelledby="delete-account-tab">
          <form @submit.prevent="submitDeleteUserForm">
            <!-- Form -->
            <div class="row mb-4">
              <div class="col-sm-9 offset-sm-3">
                <!-- Form Check -->
                <div class="form-check">
                  <input class="form-check-input" :class="{'is-invalid': props.errors.confirmed ? true : false}" type="checkbox" name="confirmed" v-model="deleteUserForm.confirmed">
                  <label class="form-check-label">
                    Keuze bevestigen
                  </label>
                  <span class="invalid-feedback" v-show="props.errors.confirmed ? true : false">Dit veld is verplicht</span>
                </div>
                <!-- End Form Check -->
              </div>
            </div>
            <!-- End Form -->

            <div class="d-flex justify-content-end">
              <div class="d-flex gap-3">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Annuleren</button>
                <button type="submit" class="btn btn-danger" :class="{ 'opacity-25': deleteUserForm.processing }" :disabled="deleteUserForm.processing">Bevestigen</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- End Tab Content -->
    </Modal>
</template>