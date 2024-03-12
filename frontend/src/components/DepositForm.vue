<template>
  <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onPurchase">
    <v-text-field    
      class="pb-2"
      variant="outlined"
      v-model="form.decription"
      :rules="[required]"
      :disabled="loading"
      label="Description"
      prepend-icon="mdi-card-text-outline">
    </v-text-field>

    <v-text-field
      class="pb-2"
      variant="outlined" 
      v-model="form.amount"
      :rules="[required]"
      :disabled="loading"
      label="Amount"
      type="number"
      prepend-icon="mdi-currency-usd">
    </v-text-field>

    <v-file-input
      required
      class="pb-2"
      variant="outlined"
      label="Check picture"
      accept="image/png, image/jpeg, image/bmp"
      prepend-icon="mdi-camera-outline">
    </v-file-input>

    <div class="text-center">
      <v-btn :loading="loading" color="primary" type="submit">Deposit</v-btn>
    </div>
  </v-form>
</template>
  
<script setup>
import { ref } from 'vue';
import { required } from '@/utils/formValidation.js';

// import transactionService from '@/services/transactionService';

const form = ref({
  decription: null,
  amount: null
});

const isFormValid = ref(false);

const loading = ref(false);

async function onPurchase() {
if (isFormValid.value) {
    loading.value = true;
    
}
}
</script>