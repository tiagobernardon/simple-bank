<template>
    Banking dashboard

    {{ fetchTest }}
</template>

<script setup>

import { onMounted, ref } from 'vue'
import transactionService from '@/services/transactionService';

const fetchTest = ref([])

const fetchTransactions = async () => {
//   loading.value = true

  await transactionService.get().then(res => {
    fetchTest.value = res
  })
  .catch(error => {
    //ajustar com modal
    // console.error('Erro ao buscar planos')
  })
  .finally(() => {
    // loading.value = false
  });
};


onMounted(async () => {
  fetchTransactions()
});


</script>