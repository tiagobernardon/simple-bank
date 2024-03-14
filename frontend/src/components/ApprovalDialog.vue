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
          @click="store.setApprovalDialog(false)"
        ></v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useAdminStore } from '@/store/admin';

import ApprovalForm from '@/components/ApprovalForm.vue';

const store = useAdminStore();

const { approvalDialog } = storeToRefs(store);
</script>