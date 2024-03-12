<template>
  <v-container fluid class="login-container">
    <v-row justify="center">
      <v-col md="3">
        <v-card>
          <v-card-title class="text-center pb-5">BNB Bank Login</v-card-title>

          <v-card-text>
            <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onLogin">

              <v-text-field
                class="pb-2"
                variant="outlined"
                v-model="form.username"
                :rules="[required]"
                :disabled="loading"
                label="Username"
                prepend-inner-icon="mdi-account-outline">
              </v-text-field>

              <v-text-field
                class="pb-2"
                variant="outlined"
                v-model="form.password"
                :rules="[required]"
                :disabled="loading"
                label="Password"
                type="password"
                prepend-inner-icon="mdi-lock-outline">
              </v-text-field>

              <div class="text-center">
                <v-btn :loading="loading" color="primary" type="submit">Login</v-btn>
              </div>
            </v-form>
          </v-card-text>

          <div class="text-center pb-4">
            OR
          </div>

          <div class="text-center pb-4">
            <router-link :to="{ name: 'Register' }">
              <v-btn :loading="loading" color="secondary">Create an account</v-btn>
            </router-link>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
    
<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { required } from '@/utils/formValidation.js';

import appService from '@/services/appService';
import userService from '@/services/userService';

const router = useRouter();

const form = ref({
  username: null,
  password: null
});

const isFormValid = ref(false);

const loading = ref(false);

async function onLogin() {
  if (isFormValid.value) {
    loading.value = true;

    await appService.login(form.value).then(async() => {

      // Get user data after login
      await userService.get().then(() => {
        router.push({ name: 'Dashboard' });
      })
      .catch(error => {
        throw error;
      })
    })
    .catch(() => {
      console.error('error');
    })
    .finally(() => {
      loading.value = false;
    });
  }
}
  
</script>
  
<style scoped>

.login-container {
    display: flex;    
    align-items: center;
    height: 100vh;
}

</style>