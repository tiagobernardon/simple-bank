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

          <v-card-text>
            <div class="text-h4">
              $200,00
            </div>
          </v-card-text>  
        </v-card>
      </v-col>

      <v-col md="4">
        <v-card>
          <v-card-title>Expenses</v-card-title>

          <v-card-text>
            <div class="text-h4">
              $5,00
            </div>
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

        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>

import { onMounted, ref } from 'vue';
import transactionService from '@/services/transactionService';

const items = ref([]);
const loading = ref(false)

const headers = [
  { title: 'Descrição', key: 'description' },
  { title: 'Valor', key: 'amount' }
];

const fetchTransactions = async () => {
  loading.value = true

  await transactionService.get().then(res => {
      items.value = res
  })
  .catch(error => {
    console.error('add alert')
  })
  .finally(() => {
    loading.value = false
  });
};

onMounted(async () => {
  fetchTransactions()
});

</script>