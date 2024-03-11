<template>
  <v-app>
    <app-bar />
    <nav-drawer />
    <default-view />
  </v-app>
</template>

<script setup>
import AppBar from './AppBar.vue';
import NavDrawer from './NavDrawer.vue';
import DefaultView from './View.vue';
</script>
