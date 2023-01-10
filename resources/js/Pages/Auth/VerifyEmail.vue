<script setup>
import { computed } from 'vue';
import LoginLayout from '@/Layouts/LoginLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <LoginLayout>

        <form @submit.prevent="submit">

            <div class="text-center">
                <div class="mb-5">
                  <h1 class="display-5">E-mailadres bevestigen</h1>
                    <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                    we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>

                    <p v-if="verificationLinkSent">A new verification link has been sent to the email address you provided during registration.</p>
                </div>
              </div>


            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Email opnieuw versturen</button>

                <div class="text-center">
                    <Link class="btn btn-link" method="post" :href="route('logout')">
                     Uitloggen
                    </Link>
                </div>
            </div>
        </form>
    </LoginLayout>
</template>
