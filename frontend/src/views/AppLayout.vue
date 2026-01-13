<script setup lang="ts">
import Navbar from '../components/navbar.vue';

</script>

<template> 
    <div class="app-layout">
    <Navbar />
    <main class ="p-8 md:ml-80 mt-16">
      <router-view />
    </main>
  </div>
</template>