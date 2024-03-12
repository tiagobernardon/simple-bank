<template>
    <v-dialog
      v-model="purchaseDialog"
      max-width="650"
    >
    <v-card title="Add Purchase">
      <v-card-text>
        <purchase-form></purchase-form>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>

        <v-spacer></v-spacer>

        <v-btn
          text="Cancel"
          @click="store.setPurchaseDialog(false)"
        ></v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

import PurchaseForm from '@/components/PurchaseForm.vue';

const store = useAppStore();

const { purchaseDialog } = storeToRefs(store);
</script>