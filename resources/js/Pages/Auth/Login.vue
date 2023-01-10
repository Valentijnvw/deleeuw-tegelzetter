<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import WachtwoordInput from '@/Components/WachtwoordInput.vue';
import LoginLayout from '@/Layouts/LoginLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
    errors: Object,
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

            <WachtwoordInput
              name="password"
              v-model="form.password"
              placeholder="Uw wachtwoord"
              :error="props.errors.email"
            />


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
