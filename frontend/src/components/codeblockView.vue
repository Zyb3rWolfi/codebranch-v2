<template>

  
  <!-- Edit Mode -->
  <div class="font-jetbrains" v-if="isCreating">
    <header class="mb-10">
      <input v-model="newBlock.title" placeholder="Title (e.g. Auth Logic)" class="w-full bg-transparent border border-[#3C3C3C] p-3 rounded-md focus:border-white outline-none font-mono" />
      <div class="h-px w-full bg-[#3C3C3C] mb-8"></div>
      
      <p class="text-gray-400 text-sm mb-6 leading-relaxed">
        <input v-model="newBlock.description" placeholder="Description" class="w-full bg-transparent border border-[#3C3C3C] p-2 rounded-md focus:border-white outline-none font-mono text-sm" />
      </p>

      <div class="flex gap-2">
        <select v-model="newBlock.language" class="bg-[#2D2D30] border border-[#3C3C3C] p-2 rounded-md outline-none text-sm">
          <option value="javascript">JavaScript</option>
          <option value="python">Python</option>
          <option value="php">PHP</option>
        </select>
      </div>
    </header>


    <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
      <h2 class="text-2xl text-white mb-6">Intent</h2>
      <p class="text-gray-400 text-sm leading-relaxed">
        <input v-model="newBlock.intent" placeholder="What problem does this solve?" class="w-full bg-transparent border border-[#3C3C3C] p-2 rounded-md focus:border-white outline-none font-mono text-sm" />
      </p>
    </section>
    
    <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
      <h2 class="text-2xl text-white mb-6">Code</h2>
      <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-8 overflow-x-auto">
        <pre class="text-sm leading-7 text-[#9CDCFE]">
    <code><textarea v-model="newBlock.code" rows="10" placeholder="// Paste your code here..." class="w-full bg-black border border-[#3C3C3C] p-4 rounded-md font-mono text-green-400 outline-none focus:border-white"></textarea></code>
        </pre>
      </div>
    </section>
  </div>

  <!-- View mode -->
  <div class="font-jetbrains" v-if="codeblockData && !isCreating">
    <header class="mb-10">
      <h1 class="text-4xl text-white mb-4">{{ codeblockData.title }}</h1>
      <div class="h-px w-full bg-[#3C3C3C] mb-8"></div>
      
      <p class="text-gray-400 text-sm mb-6 leading-relaxed">
        {{ codeblockData.description }}
      </p>

      <div class="flex gap-2">
        <span class="font-share px-3 py-1 bg-[#2D2D30] border border-[#3C3C3C] text-xs text-gray-400 rounded">{{ codeblockData.language }}</span>
      </div>
    </header>

    <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
      <h2 class="text-2xl text-white mb-6">Revisions</h2>
      <div class="border border-[#3C3C3C] rounded-md overflow-hidden bg-[#1E1E1E]">
        <div class="p-4 text-gray-500 border-b border-[#3C3C3C] text-sm">
          v1 Initial Version
        </div>
        <div v-for="(revision, index) in codeblockData.revisions" :key="revision.id" class="p-5 bg-[#2D2D30]">
          <div class="text-white text-md">v{{ index + 2 }} {{ revision.title }}</div>
        </div>
      </div>
    </section>

    <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
      <h2 class="text-2xl text-white mb-6">Intent</h2>
      <p class="text-gray-400 text-sm leading-relaxed">
        {{ codeblockData.intent }} </p>
    </section>
    
    <section class="mb-12 border p-5 rounded-md bg-[#2D2D30] border-[#3C3C3C]">
      <h2 class="text-2xl text-white mb-6">Code</h2>
      <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-8 overflow-x-auto">
        <pre class="text-sm leading-7 text-[#9CDCFE]">
    <code>{{ codeblockData.code }}</code>
        </pre>
      </div>
    </section>
  </div>
</template>

<script setup>

import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

const route = useRoute();
const codeblockData = ref(null);
const isCreating = ref(false)

const newBlock = ref({
  title: '',
  description: '',
  intent: '',
  language: '',
  code: ''
})

const fetchCodeblockData = async () => {
  // Always get the ID directly from the route to ensure it's current
  const id = route.params.id;
  if (route.params.id == "new") {
    isCreating.value = true;
    codeblockData.value = null;
    return;
  } else {
    isCreating.value = false;
  }
  if (!id) return;

  try {
    const response = await axios.get(`/api/codeblocks/${id}`);
    codeblockData.value = response.data;
  } catch (error) {
    console.error('Error fetching codeblock data:', error);
  }
};

// 1. Initial load
onMounted(() => {
    fetchCodeblockData();
});

// 2. Watch for route changes (when user clicks sidebar)
watch(() => route.params.id, () => {
    fetchCodeblockData();
});
</script>