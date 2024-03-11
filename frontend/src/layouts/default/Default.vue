<template>
  <v-app>
    <app-bar v-if="isAuthenticated" />
    <nav-drawer v-if="isAuthenticated" />
    <default-view />
  </v-app>
</template>

<script setup>
import AppBar from './AppBar.vue';
import NavDrawer from './NavDrawer.vue';
import DefaultView from './View.vue';

import { onBeforeMount } from 'vue'
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

const store = useAppStore();
const { isAuthenticated } = storeToRefs(store);

store.$subscribe((mutation) => {
  let { key, newValue } = mutation.events

  if (key === 'isAuthenticated') {
    localStorage.setItem('auth', newValue)
  }
})

onBeforeMount(() => {
  if (localStorage.getItem('auth')) {
    if (localStorage.getItem('auth') === 'true') {
      store.setIsAuthenticated(true)
    }
  }
});
</script>
