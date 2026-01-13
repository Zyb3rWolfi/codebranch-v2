<template> 

    <div class="flex items-center p-4  rounded-lg  transition-colors cursor-pointer group">
    
    <div class="flex items-center justify-center w-12 h-12  rounded-md shrink-0">
      <svg class="w-8 h-8 text-white opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
         <path d="M10 9.5C9.5 9.8 9 10.5 9 11.5V12.5C9 13.5 9.5 14.2 10 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
         <path d="M14 10H16M14 14H16M15 9V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
    </div>

    <div class="ms-4 flex flex-col">
      <h3 class="text-lg font-mono text-white leading-tight tracking-wide">
        {{ title }}
      </h3>
      <p class="text-sm text-body-muted font-mono opacity-60">
        Updated {{ updatedAt }}
      </p>
    </div>
    
  </div>

</template>

<script setup>
defineProps({
  title: {
    type: String,
    default: 'Unity WASD Movement'
  },
  updatedAt: {
    type: String,
    default: '12 days ago'
  }
});
</script>