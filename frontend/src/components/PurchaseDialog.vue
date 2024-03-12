<template>
    <v-dialog
      v-model="purchaseDialog"
      max-width="650"
    >
    <v-card title="Add Purchase">
      <v-card-text>
        Add Purchase
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>

        <v-spacer></v-spacer>

        <v-btn
          text="Fechar"
          @click="store.setPurchaseDialog(false)"
        ></v-btn>

        <v-btn
          color="primary"
          text="Salvar"
          variant="tonal"
          @click="store.setPurchaseDialog(false)"
        ></v-btn>

      </v-card-actions>

    </v-card>
  </v-dialog>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

const store = useAppStore();

const { purchaseDialog } = storeToRefs(store);
</script>