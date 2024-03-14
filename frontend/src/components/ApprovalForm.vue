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
          :loading="loadingUpdate" 
          :disabled="!currentCheck" 
          @click="updateTransaction(APPROVED)" 
          class="mx-2"
          color="primary">
            Approve
        </v-btn>

        <v-btn 
          :loading="loadingUpdate" 
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
import { useAdminStore } from '@/store/admin';
import { useAppStore } from '@/store/app';
import { storeToRefs } from 'pinia';
import { APPROVED, REJECTED } from '@/utils/transactions/transactionStatuses.js';
import transactionService from '@/services/transactionService';

const adminStore = useAdminStore();
const appStore = useAppStore();

const { currentCheck, selectedTransaction, loadingUpdate } = storeToRefs(adminStore);

async function updateTransaction(status) {
  adminStore.setLoadingUpdate(true);

  await transactionService.update(selectedTransaction.value, status).then(res => {
    adminStore.setRefreshAdmin(true);

    appStore.setSnackbar({
      show: true,
      error: false,
      message: "Operation completed successfully."
    });

    adminStore.prepareApprovalDialog(false, null)
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    adminStore.setLoadingUpdate(false);
  });
}

</script>