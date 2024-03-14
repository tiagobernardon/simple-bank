<template>
  <div class="text-center">
    <v-row>
      <v-col>
        <v-img v-if="currentCheck" :src="currentCheck" />
        <v-progress-circular
          v-else
          color="primary"
          indeterminate
        ></v-progress-circular>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-btn 
          :loading="loading" 
          :disabled="!currentCheck" 
          @click="updateTransaction(APPROVED)" 
          class="mx-2"
          color="primary">
            Approve
        </v-btn>

        <v-btn 
          :loading="loading" 
          :disabled="!currentCheck" 
          @click="updateTransaction(REJECTED)" 
          class="mx-2" 
          color="error">
            Reject
        </v-btn>
      </v-col>
    </v-row>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAdminStore } from '@/store/admin';
import { storeToRefs } from 'pinia';
import { APPROVED, REJECTED } from '@/utils/transactions/transactionStatuses.js';
import transactionService from '@/services/transactionService';

const store = useAdminStore();

const { currentCheck, selectedTransaction } = storeToRefs(store);

const loading = ref(false);

async function updateTransaction(status) {
  loading.value = true;

  await transactionService.update(selectedTransaction.value, status).then(res => {
    console.log('do something')
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loading.value = false;
  });
}

</script>