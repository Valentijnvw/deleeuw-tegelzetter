<script setup>
import { onMounted, ref } from 'vue';
import { capitalizeFirstLetter } from '@/util/stringUtils';

const props = defineProps({
  steps: Array,
});

onMounted(() => {
  currentStep.value = props.steps[0];
  console.log(currentStep);
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

<template>
    <div class="row justify-content-lg-center">
      <div class="col-lg-8">
        <!-- Step -->
        <ul id="addUserStepFormProgress" class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">
          <template v-for="(stepName, index) in steps" :key="stepName">
            <li class="step-item" :class="{'active': index === 0}">
              <a class="step-content-wrapper" href="javascript:;" :data-hs-step-form-next-options='`{
                  targetSelector: "#step` + capitalizeFirstLetter(stepName) +
                `"}`'>
                <span class="step-icon step-icon-soft-dark">1</span>
                <div class="step-content">
                  <span class="step-title">{{ stepName }}</span>
                </div>
              </a>
            </li>
          </template>

        </ul>
        <!-- End Step -->
        
        <!-- Content Step Form -->
        <div id="addUserStepFormContent">
          <template v-for="(stepName, index) in steps" :key="stepName">
            <!-- Card -->
            <div :id="'step' + capitalizeFirstLetter(stepName)" class="card card-lg" :class="{'active': currentStep === stepName}">
              <!-- Body -->
              <div class="card-body">
                <slot :name="stepName" />
              </div>
              <!-- End Body -->
  
              <!-- Footer -->
              <div class="card-footer d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary" data-hs-step-form-next-options='{
                          "targetSelector": ""
                        }'>
                  Next <i class="bi-chevron-right"></i>
                </button>
              </div>
              <!-- End Footer -->
            </div>
            <!-- End Card -->
          </template>

        </div>
        <!-- End Content Step Form -->

      </div>
    </div>
    <!-- End Row -->
</template>