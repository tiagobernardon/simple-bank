<template>
  <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onPurchase">

  <v-text-field    
    class="pb-2"
    variant="outlined"
    v-model="form.decription"
    :rules="[required]"
    :disabled="loading"
    label="Description">
  </v-text-field>

  <v-text-field
    class="pb-2"
    variant="outlined" 
    v-model="form.amount"
    :rules="[required]"
    :disabled="loading"
    label="Amount"
    type="number">
  </v-text-field>

    <div class="text-center">
      <v-btn :loading="loading" color="primary" type="submit">Purchase</v-btn>
    </div>
  </v-form>
</template>

<script setup>
import { ref } from 'vue';
import { required } from '@/utils/formValidation.js';

import transactionService from '@/services/transactionService';

const form = ref({
  decription: null,
  amount: null
});

const isFormValid = ref(false);

const loading = ref(false);

async function onPurchase() {
  if (isFormValid.value) {
    loading.value = true;

    await transactionService.create(form.value).then(res => {
      console.log('created');
    })
    .catch(() => {
      console.error('error');
    })
    .finally(() => {
      loading.value = false;
    });
  }
}
</script>