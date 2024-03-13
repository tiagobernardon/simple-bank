<template>
  <v-app>
    <app-bar v-if="user.username" />
    <nav-drawer v-if="user.username" />

    <v-snackbar v-model="snackbar.show">
      {{ snackbar.message }}

      <template v-slot:actions>
        <v-btn
          :color="snackbar.error ? 'red' : 'green'"
          variant="text"
          @click="snackbar.show = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <default-view />
  </v-app>
</template>

<script setup>
import AppBar from './AppBar.vue';
import NavDrawer from './NavDrawer.vue';
import DefaultView from './View.vue';

import axios from 'axios';
import { onBeforeMount, watch } from 'vue'
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';
import { useRouter } from 'vue-router';

const store = useAppStore();
const router = useRouter();

const { user, snackbar } = storeToRefs(store);

// API interceptor
axios.interceptors.response.use(function (response) {
    return response;
  }, function (error) {
    let status = error?.response?.status

    if (status && status === 401 || status === 419) {
      store.setUser({});
      router.push({ name: 'Login' });
    }

    store.setSnackbar({
      show: true,
      error: true,
      message: error?.response?.data?.message || "Error"
    });
  
    return Promise.reject(error);
});

onBeforeMount(async () => {
  if (localStorage.getItem('user')) {
    store.setUser(JSON.parse(localStorage.getItem('user')));
  }
});

watch(user, (newValue) => {
  if (newValue) {
    localStorage.setItem('user', JSON.stringify(newValue));
  }
});
</script>
