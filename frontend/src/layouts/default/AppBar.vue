<template>
  <v-app-bar flat color="primary">
    <v-app-bar-nav-icon @click="toggleNavDrawer()"></v-app-bar-nav-icon>
    <v-app-bar-title>
      BNB BANK
    </v-app-bar-title>
  </v-app-bar>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

const store = useAppStore();
const { drawer } = storeToRefs(store);

const toggleNavDrawer = async () => {
    store.setDrawer(!drawer.value);
}; 
</script>