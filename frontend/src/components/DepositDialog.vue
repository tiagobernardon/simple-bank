<template>
  <v-dialog
  v-model="depositDialog"
  max-width="650"
  >
    <v-card title="Deposit Check">
      <v-card-text>
        <deposit-form></deposit-form>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
        text="Cancel"
        @click="store.setDepositDialog(false)"
        ></v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

import DepositForm from '@/components/DepositForm.vue';

const store = useAppStore();

const { depositDialog } = storeToRefs(store);
</script>