<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

// Define reactive references for your form inputs
const email = ref('');
const password = ref('');
const errorMessage = ref('');

const handleLogin = async () => {
  errorMessage.value = '';
  
  try {
    // 1. Initialize CSRF protection
    // This tells Laravel to send the XSRF-TOKEN cookie to your browser
    await axios.get('/sanctum/csrf-cookie', {
    });

    // 2. Send login request
    // Because axios.defaults.withCredentials = true is set in main.js,
    // the browser will automatically include the CSRF token and 
    // save the session cookie Laravel sends back.
    await axios.post('/api/login', {
      email: email.value,
      password: password.value
    }, {
    });

    // 3. Fetch user to confirm auth state
    // This request will now succeed because the session cookie is present
    const response = await axios.get('/api/user');
    console.log('User data:', response.data);

    // Redirect to a protected page (e.g., Dashboard)
    router.push('/');
    
  } catch (error: any) {
    console.error('Auth failed', error);
    errorMessage.value = error.response?.data?.message || 'Login failed. Please check your credentials.';
  }
};
</script>

<template>
  <div class="login-view flex flex-col items-center justify-center min-h-screen bg-[#1E1E1E] text-white font-mono">
    <h1 class="text-3xl mb-8">Login</h1>
    
    <form @submit.prevent="handleLogin" class="w-full max-w-sm space-y-4">
      <div v-if="errorMessage" class="p-3 bg-red-900/50 border border-red-500 text-red-200 text-sm rounded">
        {{ errorMessage }}
      </div>

      <div class="flex flex-col gap-2">
        <label for="username" class="text-gray-400">Email:</label>
        <input 
          type="email" 
          id="username" 
          v-model="email" 
          class="bg-[#121212] border border-[#3C3C3C] p-2 rounded focus:outline-none focus:border-blue-500"
          required 
        />
      </div>

      <div class="flex flex-col gap-2">
        <label for="password" class="text-gray-400">Password:</label>
        <input 
          type="password" 
          id="password" 
          v-model="password" 
          class="bg-[#121212] border border-[#3C3C3C] p-2 rounded focus:outline-none focus:border-blue-500"
          required 
        />
      </div>

      <button 
        type="submit" 
        class="w-full bg-[#2D2D30] border border-[#3C3C3C] py-2 mt-4 hover:bg-[#3E3E42] transition-colors rounded"
      >
        Login
      </button>
    </form>
  </div>
</template>