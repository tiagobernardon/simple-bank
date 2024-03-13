<template>
  <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onPurchase">
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

    <div class="text-center">
      <v-btn :loading="loading" color="primary" type="submit">Purchase</v-btn>
    </div>
  </v-form>
</template>

<script setup>
import { ref } from 'vue';
import { vMaska } from "maska";
import { required } from '@/utils/formValidation.js';
import { currency } from '@/utils/masks.js';
import { useAppStore } from '@/store/app';
import { useTransactionStore } from '@/store/transaction';

import transactionService from '@/services/transactionService';

const appStore = useAppStore();
const transactionStore = useTransactionStore();

const form = ref({
  description: null,
  amount: 0.00,
  type: 'PURCHASE'
});

const isFormValid = ref(false);

const loading = ref(false);

async function onPurchase() {
  if (isFormValid.value) {
    loading.value = true;

    await transactionService.create(form.value).then(res => {
      if (res.id) {
        transactionStore.setRefreshDashboard(true);
        transactionStore.setPurchaseDialog(false);

        appStore.setSnackbar({
          show: true,
          error: false,
          message: "Purchase completed successfully."
        });
      }
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