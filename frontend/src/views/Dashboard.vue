<template>
  <v-container>
    <v-row>
      <v-col class="text-left">
        <h2 class="headline mb-2">Dashboard</h2>
      </v-col>
    </v-row>

    <v-row class="pb-5">
      <v-col md="4">
        <v-card>
          <v-card-title>Current balance</v-card-title>
                    
          <v-card-text>
            <div class="text-h4">
              $300,00
            </div>
          </v-card-text>            
        </v-card>
      </v-col>

      <v-col md="4">
        <v-card>
          <v-card-title>Incomes</v-card-title>

          <v-card-text class="d-flex justify-space-between align-center">
            <div class="text-h4">
              $500.000,00
            </div>


            <v-tooltip text="Deposit a Check">
              <template v-slot:activator="{ props }">
                <v-btn @click="store.setDepositDialog(true)" density="compact" icon="mdi-plus" color="primary" v-bind="props"></v-btn>
              </template>
            </v-tooltip>

          </v-card-text>
        </v-card>
      </v-col>

      <v-col md="4">
        <v-card>
          <v-card-title>Expenses</v-card-title>

          <v-card-text class="d-flex justify-space-between align-center">
            <div class="text-h4">
              $5,00
            </div>

            <v-tooltip text="Purchase">
              <template v-slot:activator="{ props }">
                <v-btn @click="store.setPurchaseDialog(true)" density="compact" icon="mdi-plus" color="primary" v-bind="props"></v-btn>
              </template>
            </v-tooltip>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="text-center">
        <h2 class="headline mb-2">Transactions</h2>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-data-table
          :headers="headers"
          :items="items"
          :loading="loading"
          :loading-text="'Loading Transactions'">

          <template v-slot:bottom>
          </template>
        </v-data-table>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <div class="text-center">
          <v-tooltip text="Previous Page">
            <template v-slot:activator="{ props }">
              <v-btn @click="fetchTransactions(currentPage - 1)" :disabled="!hasPreviousPage" variant="text" icon="mdi-arrow-left-bold"  v-bind="props"></v-btn>
            </template>
          </v-tooltip>

          <v-tooltip text="Next Page">
            <template v-slot:activator="{ props }">
              <v-btn @click="fetchTransactions(currentPage + 1)" :disabled="!hasNextPage" variant="text" icon="mdi-arrow-right-bold"  v-bind="props"></v-btn>
            </template>
          </v-tooltip>
        </div>

      </v-col>

    </v-row>

    <purchase-dialog></purchase-dialog>

    <deposit-dialog></deposit-dialog>

  </v-container>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useTransactionStore } from '@/store/transaction';
import { useAppStore } from '@/store/app';

import PurchaseDialog from '@/components/PurchaseDialog.vue';
import DepositDialog from '@/components/DepositDialog.vue';

import transactionService from '@/services/transactionService';

const store = useTransactionStore();

const { purchaseDialog, depositDialog, currentPage } = storeToRefs(store);

const items = ref([]);
const loading = ref(false);

const hasNextPage = ref(false);
const hasPreviousPage = ref(false);

const headers = [
  { title: 'Description', key: 'description' },
  { title: 'Amount', key: 'amount' },
  { title: 'Type', key: 'type' },
  { title: 'Status', key: 'status' },
];

const fetchTransactions = async (page) => {
  loading.value = true;

  await transactionService.get(page).then(res => {
    items.value = res.data;

    store.setCurrentPage(res.currentPage);
    res.nextPage ? (hasNextPage.value = true) : (hasNextPage.value = false);
    res.prevPage ? (hasPreviousPage.value = true) : (hasPreviousPage.value = false);
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loading.value = false;
  });
};

onMounted(async () => {
  fetchTransactions(currentPage.value)
});

store.$subscribe((mutation) => {
  let { key, newValue } = mutation.events;

  if (key === 'refreshDashboard' && newValue) {
    fetchTransactions(currentPage.value);
    store.setRefreshDashboard(false);
  }
})
</script>