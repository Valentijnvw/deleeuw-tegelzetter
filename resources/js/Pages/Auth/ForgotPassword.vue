<script setup>
import LoginLayout from '@/Layouts/LoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <LoginLayout>
        <form class="js-validate needs-validation" novalidate>
              <div class="text-center">
                <div class="mb-5">
                  <h1 class="display-5">Wachtwoord vergeten?</h1>
                  <p>Voer het e-mailadres van uw account in en we mailen u de instructies om uw wachtwoord opnieuw in te stellen.</p>
                </div>
              </div>

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="resetPasswordSrEmail" tabindex="0">Uw e-mailadres</label>

                <input v-model="form.email" type="email" class="form-control form-control-lg" name="email" id="resetPasswordSrEmail" tabindex="1" placeholder="Voer uw e-mailadres in" aria-label="Voer uw e-mailadres in" required>
                <span class="invalid-feedback">Please enter a valid email address.</span>
              </div>
              <!-- End Form -->

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Submit</button>

                <div class="text-center">
                  <a class="btn btn-link" :href="route('login')">
                    <i class="bi-chevron-left"></i> Back to Sign in
                  </a>
                </div>
              </div>
            </form>
    </LoginLayout>
</template>
