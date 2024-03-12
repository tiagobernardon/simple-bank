<template>
  <v-app-bar flat color="primary">
    <v-app-bar-nav-icon @click="toggleNavDrawer()"></v-app-bar-nav-icon>
    <v-app-bar-title>
      BNB BANK
    </v-app-bar-title>

    <template v-slot:append>
      <v-tooltip text="Logout">
        <template v-slot:activator="{ props }">
          <v-btn icon="mdi-logout" :loading="loadingLogout" @click="onLogout" v-bind="props"></v-btn>
        </template>
      </v-tooltip>
    </template>

  </v-app-bar>
</template>

<script setup>
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';
import { useRouter } from 'vue-router';

import appService from '@/services/appService';

const store = useAppStore();
const router = useRouter();

const { drawer } = storeToRefs(store);

const loadingLogout = ref(false);

const toggleNavDrawer = () => store.setDrawer(!drawer.value);

async function onLogout() {
  loadingLogout.value = true;

  await appService.logout().then(() => {
    router.push({ name: 'Login' });
  })
  .catch(() => {
    console.error('error');
  })
  .finally(() => {
    loadingLogout.value = false;
  });
}
</script>