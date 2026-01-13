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

    <div class="font-jetbrains p-8" :class="{ 'opacity-20 pointer-events-none': isSaving }" v-if="isCreating">
      <header class="mb-10">
        <div class="flex justify-between items-center mb-4">
          <input v-model="newBlock.title" placeholder="Title (e.g. Auth Logic)" class="text-4xl w-full bg-transparent border-b border-[#3C3C3C] pb-2 focus:border-white outline-none font-mono text-white" />
          <button @click="saveBlock" class="ms-4 px-6 py-2 bg-white text-black font-mono font-bold rounded-md hover:bg-gray-200 transition-colors">
            SAVE_BLOCK
          </button>
        </div>
        
        <p class="text-gray-400 text-sm mb-6 leading-relaxed">
          <input v-model="newBlock.description" placeholder="Description of this block..." class="w-full bg-transparent border border-[#3C3C3C] p-2 rounded-md focus:border-white outline-none font-mono text-sm" />
        </p>

        <div class="flex gap-2">
          <select v-model="newBlock.language" class="bg-[#2D2D30] border border-[#3C3C3C] p-2 rounded-md outline-none text-sm text-gray-400 font-mono">
            <option value="javascript">JavaScript</option>
            <option value="python">Python</option>
            <option value="php">PHP</option>
            <option value="html">HTML/CSS</option>
          </select>
        </div>
      </header>

      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <h2 class="text-2xl text-white mb-6 font-mono">Intent</h2>
        <input v-model="newBlock.intent" placeholder="What problem does this solve?" class="w-full bg-transparent border border-[#3C3C3C] p-3 rounded-md focus:border-white outline-none font-mono text-sm text-gray-300" />
      </section>
      
      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <h2 class="text-2xl text-white mb-6 font-mono">Code</h2>
        <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-4">
          <textarea v-model="newBlock.code" rows="12" placeholder="// Paste your code here..." class="w-full bg-black border border-[#3C3C3C] p-4 rounded-md font-mono text-green-400 outline-none focus:border-white"></textarea>
        </div>
      </section>
    </div>

    <div class="font-jetbrains p-8 animate-in fade-in slide-in-from-bottom-2 duration-500" :class="{ 'opacity-20 blur-[1px]': isLoading }" v-else-if="codeblockData && !isCreating">
      <header class="mb-10">
        <h1 class="text-4xl text-white mb-4">{{ codeblockData.title }}</h1>
        <div class="h-px w-full bg-[#3C3C3C] mb-8"></div>
        
        <p class="text-gray-400 text-sm mb-6 leading-relaxed">
          {{ codeblockData.description }}
        </p>

        <div class="flex gap-2">
          <span class="font-share px-3 py-1 bg-[#2D2D30] border border-[#3C3C3C] text-xs text-gray-400 rounded uppercase tracking-wider">{{ codeblockData.language }}</span>
        </div>
      </header>

      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl text-white font-mono">Revisions</h2>
          
          <button 
            @click="startNewIteration"
            class="flex items-center gap-2 px-3 py-1 text-xs font-mono text-gray-400 border border-[#3C3C3C] rounded hover:border-white hover:text-white transition-all group"
          >
            <svg class="w-3 h-3 group-hover:rotate-90 transition-transform" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            ADD_ITERATION
          </button>
        </div>

        <div class="border border-[#3C3C3C] rounded-md overflow-hidden bg-[#1E1E1E]">
          <div class="p-4 text-gray-500 border-b border-[#3C3C3C] text-sm font-mono">
            v1 Initial Version
          </div>
          <div v-for="(revision, index) in codeblockData.revisions" :key="revision.id" class="p-4 bg-[#2D2D30] border-b border-[#3C3C3C] last:border-0">
            <div class="text-white text-sm font-mono">v{{ index + 2 }} {{ revision.title }}</div>
          </div>
        </div>
      </section>

      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <h2 class="text-2xl text-white mb-6 font-mono">Intent</h2>
        <p class="text-gray-300 text-sm leading-relaxed font-mono bg-black/20 p-4 rounded border border-[#3C3C3C]">
          {{ codeblockData.intent }} 
        </p>
      </section>
      
      <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
        <h2 class="text-2xl text-white mb-6 font-mono">Code</h2>
        <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-8 overflow-x-auto relative">
          <button class="absolute top-4 right-4 text-xs text-gray-500 hover:text-white uppercase font-mono">Copy</button>
          <pre class="text-sm leading-7 text-[#9CDCFE]"><code>{{ codeblockData.code }}</code></pre>
        </div>
      </section>
    </div>

    <div v-else-if="!isLoading" class="flex items-center justify-center min-h-[80vh] text-gray-600 font-mono tracking-tighter">
      > SELECT_OR_CREATE_A_CODEBLOCK_TO_BEGIN
    </div>

  </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const codeblockData = ref(null);
const isCreating = ref(false);
const isLoading = ref(false);
const isSaving = ref(false);

const newBlock = ref({
  title: '',
  description: '',
  intent: '',
  language: 'javascript',
  code: ''
});

const fetchCodeblockData = async () => {
  const id = route.params.id;
  
  // Handle Creation State
  if (id === "new") {
    isCreating.value = true;
    codeblockData.value = null;
    return;
  } else {
    isCreating.value = false;
  }

  if (!id) return;
  isLoading.value = true;

  try {
    const response = await axios.get(`/api/codeblocks/${id}`);
    // Laravel wraps resource data in 'data'
    codeblockData.value = response.data.data || response.data; 
  } catch (error) {
    console.error('Error fetching codeblock data:', error);
  } finally {
    // Artificial delay for smooth animation
    setTimeout(() => { isLoading.value = false; }, 400); 
  }
};

const saveBlock = async () => {
  if (!newBlock.value.title || !newBlock.value.code) return;
  
  isSaving.value = true;
  try {
    const response = await axios.post('/api/codeblock/add', newBlock.value);
    // Reset form and redirect to the new item
    router.push({ name: 'codeblocks', params: { id: response.data.id } });
  } catch (error) {
    console.error('Error saving block:', error);
  } finally {
    isSaving.value = false;
  }
};

onMounted(fetchCodeblockData);
watch(() => route.params.id, fetchCodeblockData);
</script>

<style scoped>
/* JetBrains Mono font is imported in your main app.css usually */
.font-jetbrains {
  font-family: 'JetBrains Mono', monospace;
}
</style>