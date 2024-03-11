<template>
    <v-navigation-drawer v-model="drawer" color="secondary">
        <v-list>
            <router-link class="plain-link" :to="{ name: 'Dashboard' }">
                <v-list-item prepend-icon="mdi-view-dashboard" link title="Dashboard"></v-list-item>
            </router-link>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>

import { storeToRefs } from 'pinia'
import { useAppStore } from '@/store/app'

const store = useAppStore()

const { drawer } = storeToRefs(store)

</script>

<style scoped>

.plain-link{
    text-decoration: none;
    color: inherit;
}

</style>