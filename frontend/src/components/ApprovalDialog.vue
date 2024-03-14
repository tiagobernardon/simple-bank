<template>
    <v-dialog
      v-model="approvalDialog"
      max-width="650"
    >
    <v-card title="Approve Check">
      <v-card-text>
        <approval-form></approval-form>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>

        <v-spacer></v-spacer>

        <v-btn
          text="Cancel"
          :disabled=loadingUpdate
          @click="store.prepareApprovalDialog(false, null)"
        ></v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import { storeToRefs } from 'pinia';
import { useAdminStore } from '@/store/admin';
import transactionService from '@/services/transactionService';

import ApprovalForm from '@/components/ApprovalForm.vue';

const store = useAdminStore();

const loadingCheck = ref(false);

const { approvalDialog, selectedTransaction, loadingUpdate } = storeToRefs(store);

const fetchCheck = async () => {
  loadingCheck.value = true;

  await transactionService.getCheck(selectedTransaction.value).then(res => {
    const file = URL.createObjectURL(res.data);
    store.setCurrentCheck(file)
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loadingCheck.value = false;
  });
};

watch(selectedTransaction, (newValue) => {
  if (newValue) {
    fetchCheck();
  }
});

watch(approvalDialog, (newValue) => {
  if (!newValue) {
    store.unsetSelectedTransaction();
    store.setCurrentCheck(null);
  }
});
</script>