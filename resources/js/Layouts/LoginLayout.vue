<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">
    <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url(../../svg/components/card-6.svg);">
    <!-- Shape -->
    <div class="shape shape-bottom zi-1">
        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
        <polygon fill="#fff" points="0,273 1921,273 1921,0 " />
        </svg>
    </div>
    <!-- End Shape -->
    </div>

    <!-- Content -->
    <div class="container py-5 py-sm-7">
    <a class="d-flex justify-content-center mb-5" href="./index.html">
        <img class="zi-2" src="../../img/deleeuw/deleeuwtegelzetterbv_V3-300x195.png" alt="Image Description" style="width: 8rem;">
    </a>

    <div class="mx-auto" style="max-width: 30rem;">
        <!-- Card -->
        <div class="card card-lg mb-5">
        <div class="card-body">
            <slot />
        </div>
        </div>
        <!-- End Card -->

        <!-- Footer -->
        <div class="position-relative text-center zi-1">
        <small class="text-cap text-body mb-4">...</small>

        </div>
        <!-- End Footer -->
    </div>
    </div>
    <!-- End Content -->
</main>
</template>
