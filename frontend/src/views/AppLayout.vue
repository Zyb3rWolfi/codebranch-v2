<script setup lang="ts">
import Navbar from '../components/navbar.vue';

</script>

<template> 
    <div class="app-layout">
    <Navbar />
    <main class ="p-8 md:ml-80 mt-16">
      <router-view />
      <div class="flex items-center justify-center min-h-[80vh] text-gray-600 font-mono tracking-tighter">
      > SELECT_OR_CREATE_A_CODEBLOCK_TO_BEGIN
    </div>
    </main>
  </div>
</template>