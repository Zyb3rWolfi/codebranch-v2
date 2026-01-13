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
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-96 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto border-[#3C3C3C]  border">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <span id="web-logo" class="self-center text-3xl   text-white font-semibold whitespace-nowrap">Codebranch</span>
      </a>

      <ul class="space-y-2 font-medium mt-10">
          <!-- Item 1 Search -->
         <li class="bg-transparent">
            <li class="bg-transparent">
            <form class="flex items-center w-full bg-transparent border-b pb-2">   
                <label for="simple-search" class="sr-only bg-transparent">Search</label>
                
                <div class="relative flex-1 bg-transparent">
                    <input type="text" id="simple-search" class="w-full px-3 placeholder:text-left py-2.5 border-transparent bg-transparent border rounded-base ps-2" placeholder="Search Codeblocks..." required />
                </div>

                <button type="submit" class="ms-4 inline-flex items-center justify-center shrink-0 border border-[#3C3C3C] text-white bg-[#2D2D30] focus:ring-4 px-4 rounded-md h-10 focus:outline-none whitespace-nowrap">
                  <span class="text-sm">Create Codeblock</span>  
                </button>
            </form>
          </li>

         </li>

         <!-- Item 2 Kanban -->
         <li>
            <BranchComponent />
         </li>

      </ul>
   </div>
</aside>
</template>

<script setup> 
import { defineComponent, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import 'flowbite/dist/flowbite.css';
import BranchComponent from './branchComponent.vue';

onMounted(() => {
  initFlowbite();
});
</script>