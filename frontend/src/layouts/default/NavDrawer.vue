<template>
    <v-navigation-drawer v-model="drawer" color="secondary">
        <v-list>
            <router-link v-if="adminMenu" class="plain-link" :to="{ name: 'Admin' }">
                <v-list-item prepend-icon="mdi-view-dashboard" link title="Admin"></v-list-item>
            </router-link>

            <router-link v-if="!adminMenu" class="plain-link" :to="{ name: 'Dashboard' }">
                <v-list-item prepend-icon="mdi-view-dashboard" link title="Dashboard"></v-list-item>
            </router-link>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useAppStore } from '@/store/app';

const store = useAppStore();
const adminMenu = ref(false);

const { user, drawer } = storeToRefs(store);

onMounted(async () => {
  if (user.value.type === 'ADMIN') {
    adminMenu.value = true;
  }
});

</script>

<style scoped>

.plain-link{
    text-decoration: none;
    color: inherit;
}

</style>