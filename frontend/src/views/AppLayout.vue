<script setup lang="ts">
import Navbar from '../components/navbar.vue';

</script>

<template> 
    <div class="app-layout">
    <Navbar />
    <main>
      <router-view />
    </main>
  </div>
</template>