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
        <v-btn :disabled="!currentCheck" class="mx-2" color="primary">Approve</v-btn>
        <v-btn :disabled="!currentCheck" class="mx-2" color="error">Reject</v-btn>
      </v-col>
    </v-row>
  </div>
</template>

<script setup>
import { useAdminStore } from '@/store/admin';
import { storeToRefs } from 'pinia';

const store = useAdminStore();

const { currentCheck } = storeToRefs(store);

</script>