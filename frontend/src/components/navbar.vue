<template>

<nav class="fixed top-0 z-50 w-full  border border-[#3C3C3C] ">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar" aria-controls="top-bar-sidebar" type="button" class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
            </svg>
         </button>
        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
          <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white"></span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44" id="dropdown-user">
              <div class="px-4 py-3 border-b border-default-medium" role="none">
                <p class="text-sm font-medium text-heading" role="none">
                  Neil Sims
                </p>
                <p class="text-sm text-body truncate" role="none">
                  neil.sims@flowbite.com
                </p>
              </div>
              <ul class="p-2 text-sm text-body font-medium" role="none">
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Earnings</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-80 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto border-[#3C3C3C]  border">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <span id="web-logo" class="self-center text-3xl   text-white font-semibold whitespace-nowrap">Codebranch</span>
      </a>

      <ul class="space-y-2 font-medium mt-10">
          <!-- Item 1 Search -->
         <li class="bg-transparent">
            <li class="bg-transparent">
            <div class="px-3 py-4 border-b border-[#3C3C3C]">
    <div class="relative mb-3">
        <input 
            type="text" 
            class="w-full px-3 py-2 bg-transparent border border-[#3C3C3C] rounded-md text-sm text-white focus:border-blue-500 focus:ring-0" 
            placeholder="Search Codeblocks..." 
        />
    </div>
        <router-link :to="{ name: 'codeblocks', params: { id: 'new' } }" class="no-underline"> 
        <button class="flex items-center justify-center gap-2 w-full py-2.5 text-sm font-mono text-gray-400 bg-transparent border border-[#3C3C3C] rounded-md hover:border-white hover:text-white hover:bg-white/5 transition-all duration-300 group">
    
          <svg 
              class="w-5 h-5 text-gray-400 group-hover:text-white group-hover:rotate-[90deg] group-hover:scale-110 transition-all duration-500 ease-in-out" 
              viewBox="0 0 24 24" 
              fill="none" 
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>

        </button>
        </router-link>

    </div>
          </li>

         </li>
        <div class="mt-5"></div>
         <!-- Item 2 Kanban -->
         <li v-for="item in codeblocks" :key="item.id" > 
          <router-link :to="{ name: 'codeblocks', params: { id: item.id } }" class="no-underline">
            <BranchComponent :branch="item" />
          </router-link>
         </li>

      </ul>
   </div>
</aside>
</template>

<script setup> 
import { defineComponent, onMounted, ref } from 'vue';
import { initFlowbite } from 'flowbite';
import 'flowbite/dist/flowbite.css';
import BranchComponent from './branchComponent.vue';
import axios from 'axios';
import router from '../router';

const codeblocks = ref([]);

onMounted(async() => {
  initFlowbite();
  const response = await axios.get('/api/codeblocks'); 
  codeblocks.value = response.data;
});
</script>