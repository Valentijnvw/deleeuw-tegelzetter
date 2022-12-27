<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LoginLayout from '@/Layouts/LoginLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <LoginLayout>
        <!-- Form -->
        <form @submit.prevent="submit">
          <div class="text-center">
            <div class="mb-5">
              <h1 class="display-5">Inloggen</h1>
              <p>Nog geen account? <a class="link" :href="route('register')">Maak hier een account aan</a></p>
            </div>

          </div>

          <!-- Form -->
          <div class="mb-4">
            <label class="form-label" for="signinSrEmail">Email</label>
            <input type="email" v-model="form.email" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="Uw e-mailadres" aria-label="Uw e-mailadres" required>
            <span class="invalid-feedback">Please enter a valid email address.</span>
          </div>
          <!-- End Form -->

          <!-- Form -->
          <div class="mb-4">
            <label class="form-label w-100" for="signupSrPassword" tabindex="0">
              <span class="d-flex justify-content-between align-items-center">
                <span>Wachtwoord</span>
                <a class="form-label-link mb-0" v-if="canResetPassword" :href="route('password.request')">Wachtwoord vergeten?</a>
              </span>
            </label>

            <div class="input-group input-group-merge" data-hs-validation-validate-class>
              <input type="password" v-model="form.password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Uw wachtwoord">
              <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                <i id="changePassIcon" class="bi-eye"></i>
              </a>
            </div>

            <span class="invalid-feedback">Please enter a valid password.</span>
          </div>
          <!-- End Form -->

          <!-- Form Check -->
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" v-model="form.remember">
            <label class="form-check-label" for="termsCheckbox">
              Blijf ingelogd
            </label>
          </div>
          <!-- End Form Check -->

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Inloggen</button>
          </div>
        </form>
    </LoginLayout>
</template>
