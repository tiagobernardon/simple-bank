<template>
  <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onDeposit">
    <v-text-field    
      class="pb-2"
      variant="outlined"
      v-model="form.description"
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
      type="text"
      prepend-icon="mdi-currency-usd"
      v-maska:[currency]>
    </v-text-field>

    <v-file-input
      v-model="form.check"
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
import { vMaska } from "maska";
import { currency } from '@/utils/masks.js';
import { required } from '@/utils/formValidation.js';
import { DEPOSIT } from '@/utils/transactionTypes.js';
import { useAppStore } from '@/store/app';
import { useTransactionStore } from '@/store/transaction';

import transactionService from '@/services/transactionService';

const appStore = useAppStore();
const transactionStore = useTransactionStore();

const form = ref({
  description: null,
  amount: 0.00,
  type: DEPOSIT,
  check: null,
});

const isFormValid = ref(false);

const loading = ref(false);

async function onDeposit() {
  if (isFormValid.value) {
    loading.value = true;

    await transactionService.create(form.value).then(res => {
      if (res.id) {
        transactionStore.setRefreshDashboard(true);
        transactionStore.setDepositDialog(false);

        appStore.setSnackbar({
          show: true,
          error: false,
          message: "Deposit completed, wait for check approval!"
        });
      }
    })
    .catch((error) => {
      console.error(error);
    })
    .finally(() => {
      loading.value = false;
    });
  }
}
</script>