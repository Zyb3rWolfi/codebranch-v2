<template> 
  <div 
    class="flex items-center p-2 rounded-lg transition-colors cursor-pointer group hover:bg-[#252528] hover:border-white border border-transparent relative overflow-hidden"
    @mouseleave="isConfirming = false"
  >
    
    <div class="flex items-center justify-center w-12 h-8 rounded-md shrink-0 group-hover:text-dark">
      <svg class="w-8 h-8  text-white opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
         <path d="M10 9.5C9.5 9.8 9 10.5 9 11.5V12.5C9 13.5 9.5 14.2 10 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
         <path d="M14 10H16M14 14H16M15 9V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
    </div>

    <div class="ms-2 flex flex-col">
      <h3 class="text-md font-mono text-white leading-tight tracking-wide">{{ branch.title }}</h3>
      <p class="text-xs text-body-muted font-mono opacity-60 group-hover:text-white ">
        Updated {{ new Date(branch.updated_at).toLocaleDateString() }}
      </p>
    </div>

    <button 
      type="button" 
      @click.stop.prevent="handleAction" 
      :class="[
        'absolute right-0 top-0 bottom-0 flex items-center justify-center transition-all duration-200 px-4 rounded-r-lg group-hover:opacity-100 opacity-0',
        isConfirming ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'
      ]"
    >
      <svg v-if="!isConfirming" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 6 5 6 21 6"></polyline>
        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
      </svg>


      <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useCodeblockStore } from '../stores/codeblockStore';
import axios from 'axios';
import { routerKey, useRoute, useRouter } from 'vue-router';

const route = useRouter();
const store = useCodeblockStore();
const props = defineProps({
  branch: { type: Object, required: true }
});

// State to track if the user has clicked once
const isConfirming = ref(false);

const handleAction = () => {
  if (!isConfirming.value) {
    // First click: switch to green check
    isConfirming.value = true;
  } else {
    // Second click: execute the actual deletion/logic
    console.log('Confirmed deletion for:', props.branch.id);
    deleteBranch(props.branch.id);
    isConfirming.value = false;
  }
};

const deleteBranch = async (branchId) => {
  try {
    const response = await axios.post(`/api/codeblock/${branchId}/delete`);

    console.log('Branch deleted successfully');
    store.removeBranch(branchId);
  } catch (error) {
    console.error('Error deleting branch:', error);
  } finally {
    // Push to main route after deletion using router

    route.push({ name: 'app' });

  }
};
</script>