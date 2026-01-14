<template>
  <nav class="fixed top-0 z-40 w-full border-b border-[#3C3C3C] bg-[#0F0F0F]/80 backdrop-blur-md">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-end">
        <div class="flex items-center">
          <div class="flex items-center ms-3">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-[#3C3C3C]" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <img class="w-8 h-8 rounded-full border border-[#3C3C3C]" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
            <div class="z-50 hidden bg-[#1E1E1E] border border-[#3C3C3C] rounded-md shadow-lg w-44" id="dropdown-user">
              <div class="px-4 py-3 border-b border-[#3C3C3C]">
                <p class="text-sm font-medium text-white">{{ user.name }}</p>
                <p class="text-xs text-gray-500 truncate">user.email</p>
              </div>
              <ul class="p-2 text-sm text-gray-400 font-mono">
                <li><a href="#" class="block p-2 hover:bg-[#2D2D30] hover:text-white rounded">DASHBOARD</a></li>
                <li><a href="#" class="block p-2 hover:bg-[#2D2D30] hover:text-white rounded">SIGN_OUT</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <aside id="sidebar" class="fixed top-0 left-0 z-50 w-80 h-full transition-transform -translate-x-full sm:translate-x-0 bg-[#0F0F0F] border-r border-[#3C3C3C]" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto scrollbar-hide">
      
      <router-link to="/" class="flex items-center gap-3 px-2 mb-8 group cursor-pointer no-underline pt-2">
         <div class="relative flex items-center justify-center">
            <svg 
               class="w-9 h-9 text-white transition-all duration-500 group-hover:rotate-[30deg] group-hover:scale-110" 
               viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            >
               <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="opacity-30 group-hover:opacity-100 transition-opacity" />
            </svg>
         </div>
         <div class="flex flex-col">
            <span class="text-xl font-mono font-bold tracking-tighter text-white uppercase">
               CODEBRANCH<span class="animate-pulse text-gray-500">_</span>
            </span>
            <span class="text-[10px] font-mono text-gray-500 tracking-[0.2em] -mt-1 uppercase">v0.1.0_stable</span>
         </div>
      </router-link>

      <div class="px-2 py-4 border-b border-[#3C3C3C] mb-4">
        <div class="relative mb-3">
          <input 
            v-model="searchQuery"
            type="text" 
            class="w-full placeholder:text-xs px-3 py-2 bg-transparent border border-[#3C3C3C] rounded-md text-sm text-white focus:border-white focus:ring-1 focus:ring-white/10 transition-all outline-none placeholder:text-gray-600 font-mono" 
            placeholder="find_snippet..." 
          />
        </div>
        
        <router-link :to="{ name: 'codeblocks', params: { id: 'new' } }" class="no-underline"> 
          <button class="flex items-center justify-center gap-2 w-full py-2.5 text-[10px] font-mono text-gray-400 bg-transparent border border-[#3C3C3C] rounded-md hover:border-white hover:text-white hover:bg-white/5 transition-all duration-300 group uppercase tracking-widest">
            <svg 
              class="w-4 h-4 text-gray-400 group-hover:text-white group-hover:rotate-[90deg] group-hover:scale-110 transition-all duration-500 ease-in-out" 
              viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            INITIALIZE_BLOCK
          </button>
        </router-link>
      </div>

      <ul class="space-y-1 font-medium">
         <li v-for="item in filteredBlocks" :key="item.id"> 
          <router-link :to="{ name: 'codeblocks', params: { id: item.id } }" class="no-underline block">
            <BranchComponent :branch="item" />
          </router-link>
         </li>
      </ul>
      
      <div v-if="filteredBlocks.length === 0" class="text-center py-10">
        <p class="text-xs font-mono text-gray-600 uppercase tracking-widest">NO_MATCHES_FOUND</p>
      </div>
    </div>
  </aside>
</template>

<script setup> 
import { onMounted, ref, computed } from 'vue';
import { initFlowbite } from 'flowbite';
import 'flowbite/dist/flowbite.css';
import BranchComponent from './branchComponent.vue';
import axios from 'axios';

const user = ref({})
const codeblocks = ref([]);
const searchQuery = ref('');

const filteredBlocks = computed(() => {
  return codeblocks.value.filter(block => 
    block.title.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

onMounted(async() => {
  initFlowbite();
  try {
    const response = await axios.get('/api/codeblocks');
    codeblocks.value = response.data.data || response.data;
  } catch (error) {
    console.error("Failed to fetch codeblocks:", error);
  }

  try {
    const userResponse = await axios.get('/api/user');
    user.value = userResponse.data;
  } catch (error) {
    console.error("Failed to fetch user data:", error);
  }

});
</script>

<style scoped>
.font-mono {
  font-family: 'JetBrains Mono', monospace;
}
/* Hide scrollbar but allow scrolling */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>