<template>
  <v-app>
    <app-bar v-if="user.username" />
    <nav-drawer v-if="user.username" />
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
const { user } = storeToRefs(store);

store.$subscribe((mutation) => {
  let { key, newValue } = mutation.events

  if (key === 'user') {
    localStorage.setItem('user', JSON.stringify(newValue))
  }
})

onBeforeMount(() => {
  if (localStorage.getItem('user')) {
    store.setUser(JSON.parse(localStorage.getItem('user')))
  }
});
</script>
