<template>
    <v-container fluid class="register-container">
      <v-row justify="center">
        <v-col md="3">
          <v-card>
            <v-card-title class="text-center pb-5">User Registration</v-card-title>
  
            <v-card-text>
              <v-form validate-on="blur" v-model="isFormValid" @submit.prevent="onRegister">
  
                <v-text-field
                  variant="outlined" 
                  v-model="form.username"
                  :rules="[required]"
                  :disabled="loading"
                  label="Username"
                  prepend-inner-icon="mdi-account">
                </v-text-field>

                <v-text-field
                  class="pb-2"
                  variant="outlined"
                  v-model="form.password"
                  :rules="[required, password]"
                  :disabled="loading"
                  label="Password"
                  type="password"
                  prepend-inner-icon="mdi-lock-outline">
                </v-text-field>

                <div class="text-center">
                  <v-btn :loading="loading" color="primary" type="submit">Create account</v-btn>
                </div>
              </v-form>
            </v-card-text>

            <div class="text-center pb-4">
              OR
            </div>

            <div class="text-center pb-4">
                <router-link :to="{ name: 'Login' }">
                <v-btn :loading="loading" color="secondary">Back to Login Screen</v-btn>
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
  import { required, password } from '@/utils/formValidation.js';
  
  const router = useRouter();
  
  const form = ref({
    username: null,
    password: null
  });
  
  const isFormValid = ref(false);
  
  const loading = ref(false);
    
  async function onRegister() {
    if (isFormValid.value) {
      console.log('Will Register');
    }
  }
    
  </script>
    
  <style scoped>
  
  .register-container {
      display: flex;    
      align-items: center;
      height: 100vh;
  }
  
  </style>