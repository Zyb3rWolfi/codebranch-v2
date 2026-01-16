// src/stores/codeblockStore.js
import { defineStore } from 'pinia';

export const useCodeblockStore = defineStore('codeBlockStore', {
  state: () => ({
    codeblocks: [] // This remains your reactive list
  }),
  actions: {
    addBlock(block) {
      this.codeblocks.unshift(block); // Adds new items to the top
    },
    setCodeblocks(blocks) {
      this.codeblocks = blocks; // Initial load from API
    },
    removeBranch(branchId) {
      this.codeblocks = this.codeblocks.filter(block => block.id !== branchId);
    }

    
  }
});