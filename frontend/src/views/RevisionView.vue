<template> 
    <div class="relative min-h-screen">
    <Transition
      enter-active-class="transition opacity-0 duration-300"
      enter-to-class="opacity-100"
      leave-active-class="transition opacity-100 duration-300"
      leave-to-class="opacity-0"
    >
      <div v-if="isLoading || isSaving" class="absolute inset-0 z-50 flex flex-col items-center justify-center bg-[#121212]/80 backdrop-blur-sm">
        <svg class="w-12 h-12 text-white animate-spin mb-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-20"/>
          <path d="M12 2L21 7V17L12 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="font-mono text-xs tracking-widest text-gray-400 uppercase">
          {{ isSaving ? 'Persisting_to_Memory...' : 'Synchronizing...' }}
        </p>
      </div>
    </Transition>

    <div v-if="!isLoading" class="font-jetbrains p-8 animate-in fade-in slide-in-from-bottom-2 duration-500">
      <header class="mb-10">
        <h1 class="text-4xl text-white mb-4">Iteration View</h1>
        <div class="h-px w-full bg-[#3C3C3C] mb-8"></div>
        
        <p class="text-gray-400 text-sm mb-6 leading-relaxed">
          
        </p>

        <div class="flex gap-2">
        </div>
      </header>

      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl text-white font-mono">Revision</h2>
          <span class="text-sm text-gray-400 font-mono">Updated on {{ new Date(revisionData.updated_at).toLocaleDateString() }}</span>
          
        </div>
        <p class=" text-sm">{{ revisionData.title }}</p>

      </section>

      
      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <h2 class="text-2xl text-white mb-6 font-mono">Code</h2>
        <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-8 overflow-x-auto relative">
          <button class="absolute top-4 right-4 text-xs text-gray-500 hover:text-white uppercase font-mono">Copy</button>
          <pre class="text-sm leading-7 text-[#9CDCFE]">
            <code>{{ revisionData.code }}</code></pre>
        </div>
      </section>
    </div>
    </div>

</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';


const revisionData = ref(null);
const isLoading = ref(true);
const route = useRoute();


async function fetchRevisionData() {
  try {
    const response = await axios.get(`/api/codeblocks/revision/${route.params.revisionId}`);
    revisionData.value = response.data;
    // Populate the template with revision data
  } catch (error) {
    console.error('Error fetching revision data:', error);
  } finally {
    isLoading.value = false;
  }
}


onMounted(() => {
  fetchRevisionData();
});

</script>