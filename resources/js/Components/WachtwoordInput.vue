<script setup>
import { ref } from 'vue';

const props = defineProps({
    name: String,
    modelValue: String,
    placeholder: String,
    showEye: {
        type: Boolean,
        default: true,
    },
    error: String,
});

// setInterval(() => {
//     console.log(props.error);
//     console.log(props.error !== undefined);
// }, 1000)

const showPassword = ref(false);

defineEmits(['update:modelValue']);

</script>

<template>
        <div class="input-group">
            <input
                :type="showPassword ? 'text' : 'password'"
                class="js-toggle-password form-control form-control-lg"
                :class="{'is-invalid': props.error !== undefined}"
                :name="props.name"
                @input="$emit('update:modelValue', $event.target.value)"
                :placeholder="props.placeholder">
            <a v-show="props.showEye" @click="showPassword = !showPassword" class="input-group-append input-group-text" href="#">
                <i id="changePassIcon" :class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
            </a>
        </div> 
        <div class="text-danger" v-show="props.error !== undefined">
            <small>{{ props.error }}</small>
        </div>
</template>
