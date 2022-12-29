<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    title: {
        type: Text
    },
    id: {
        type: Text
    },
})
</script>

<template>
    <div class="modal fade" :id="props.id" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-text="props.title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Body -->
        <div class="modal-body">
            <slot />
        </div>
        <!-- End Body -->
      </div>
    </div>
  </div>
</template>
