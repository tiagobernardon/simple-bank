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
            <v-progress-linear
                :active="loadingBalance"
                height="4"
                indeterminate
            ></v-progress-linear>

            <div class="text-h4">
              {{ loadingBalance ? '' : formatCurrency(balance) }}
            </div>
          </v-card-text>            
        </v-card>
      </v-col>

      <v-col md="4">
        <v-card>
          <v-card-title>Incomes</v-card-title>

          <v-card-text class="d-flex justify-space-between align-center">
            <div class="text-h4">
              Deposit a Check
            </div>


            <v-tooltip text="Deposit a Check">
              <template v-slot:activator="{ props }">
                <v-btn @click="transactionStore.setDepositDialog(true)" density="compact" icon="mdi-plus" color="primary" v-bind="props"></v-btn>
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
              Purchase
            </div>

            <v-tooltip text="Purchase">
              <template v-slot:activator="{ props }">
                <v-btn @click="transactionStore.setPurchaseDialog(true)" density="compact" icon="mdi-plus" color="primary" v-bind="props"></v-btn>
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
          :loading="loadingTransactions"
          :loading-text="'Loading Transactions'">

          <template v-slot:item="{ item }">
            <tr>

              <td>
                {{ item.description }}
              </td>

              <td>
                <v-chip :color="formatTypeColor(item.type)">
                  {{ formatCurrency(item.amount) }}
                </v-chip>
              </td>

              <td>
                  {{ formatTypeText(item.type) }}
              </td>

              <td>
                <v-chip :color="formatStatusColor(item.status)">
                  {{ formatStatusText(item.status) }}
                </v-chip>
              </td>

              <td>
                {{ formatDate(item.created_at) }}
              </td>
            </tr>
          </template>

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
import { onMounted, ref, watch } from 'vue';
import { storeToRefs } from 'pinia';
import { useTransactionStore } from '@/store/transaction';
import { useWalletStore } from '@/store/wallet';
import PurchaseDialog from '@/components/PurchaseDialog.vue';
import DepositDialog from '@/components/DepositDialog.vue';
import transactionService from '@/services/transactionService';
import walletService from '@/services/walletService';

import { 
  formatTypeText, 
  formatTypeColor, 
  formatStatusText, 
  formatStatusColor, 
  formatCurrency,
  formatDate
} from '@/utils/formatters.js';

const transactionStore = useTransactionStore();
const walletStore = useWalletStore();

const { 
  purchaseDialog,
  depositDialog,
  currentPage,
  refreshDashboard
} = storeToRefs(transactionStore);

const { balance } = storeToRefs(walletStore);

const items = ref([]);
const loadingTransactions = ref(false);
const loadingBalance = ref(false);

const hasNextPage = ref(false);
const hasPreviousPage = ref(false);

const headers = [
  { title: 'Description', key: 'description', sortable: false },
  { title: 'Amount', key: 'amount', sortable: false },
  { title: 'Type', key: 'type', sortable: false },
  { title: 'Status', key: 'status', sortable: false },
  { title: 'Date', key: 'created_at', sortable: false },
];

const fetchTransactions = async (page) => {
  loadingTransactions.value = true;

  await transactionService.get(page).then(res => {
    items.value = res.data;

    transactionStore.setCurrentPage(res.currentPage);
    res.nextPage ? (hasNextPage.value = true) : (hasNextPage.value = false);
    res.prevPage ? (hasPreviousPage.value = true) : (hasPreviousPage.value = false);
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loadingTransactions.value = false;
  });
};

const fetchBalance = async () => {
  loadingBalance.value = true;

  await walletService.getBalance().then(res => {
    balance.value = res;
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loadingBalance.value = false;
  });
};

onMounted(async () => {
  fetchTransactions(currentPage.value)
  fetchBalance()
});

watch(refreshDashboard, (newValue) => {
  if (newValue) {
    fetchTransactions(currentPage.value);
    fetchBalance();
    transactionStore.setRefreshDashboard(false);
  }
});
</script>