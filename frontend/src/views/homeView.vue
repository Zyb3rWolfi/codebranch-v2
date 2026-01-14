<template>
  <div class="relative min-h-screen bg-[#0F0F0F] text-white flex flex-col items-center justify-center overflow-hidden font-jetbrains">
    
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <div class="hex-grid"></div>
    </div>

    <main class="relative z-10 text-center px-6 max-w-4xl">
      <div class="mb-8 flex justify-center">
        <div class="relative animate-pulse">
           <svg class="w-24 h-24 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
              <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" />
              <path d="M12 8V16M8 12H16" class="opacity-50" />
           </svg>
           <div class="absolute inset-0 blur-2xl bg-white/10 rounded-full"></div>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-4">
        CODEBRANCH<span class="text-gray-600">_</span>
      </h1>
      
      <p class="text-gray-400 text-lg md:text-xl font-mono mb-10 max-w-2xl mx-auto leading-relaxed">
        Your personal persistence layer for code memory. Save snippets, 
        <span class="text-white">iterate versions</span>, and build your specialized knowledge base.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <router-link to="/login" class="px-8 py-4 bg-white text-black font-bold font-mono rounded hover:bg-gray-200 transition-all flex items-center gap-2">
          INITIALIZE_DATABASE
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </router-link>
        
        <router-link to="/login" class="px-8 py-4 border border-[#3C3C3C] text-gray-400 font-mono rounded hover:border-white hover:text-white transition-all">
          RESTORE_SESSION
        </router-link>
      </div>
    </main>

    <footer class="absolute bottom-10 w-full flex justify-center gap-12 text-[10px] font-mono text-gray-600 uppercase tracking-[0.3em]">
      <div class="flex flex-col items-center">
        <span class="text-white text-sm mb-1">0.1.0</span>
        Version
      </div>
      <div class="flex flex-col items-center">
        <span class="text-white text-sm mb-1">∞</span>
        Iterations
      </div>
      <div class="flex flex-col items-center">
        <span class="text-white text-sm mb-1">AES-256</span>
        Security
      </div>
    </footer>
  </div>
</template>

<style scoped>
.font-jetbrains {
  font-family: 'JetBrains Mono', monospace;
}

/* CSS Hexagon Grid Art */
.hex-grid {
  background-image: 
    linear-gradient(30deg, #3C3C3C 12%, transparent 12.5%, transparent 87%, #3C3C3C 87.5%, #3C3C3C),
    linear-gradient(150deg, #3C3C3C 12%, transparent 12.5%, transparent 87%, #3C3C3C 87.5%, #3C3C3C),
    linear-gradient(30deg, #3C3C3C 12%, transparent 12.5%, transparent 87%, #3C3C3C 87.5%, #3C3C3C),
    linear-gradient(150deg, #3C3C3C 12%, transparent 12.5%, transparent 87%, #3C3C3C 87.5%, #3C3C3C),
    linear-gradient(60deg, #3C3C3C 25%, transparent 25.5%, transparent 75%, #3C3C3C 75%, #3C3C3C),
    linear-gradient(60deg, #3C3C3C 25%, transparent 25.5%, transparent 75%, #3C3C3C 75%, #3C3C3C);
  background-size: 80px 140px;
  background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;
  width: 100%;
  height: 100%;
}

@keyframes pulse-blur {
  0%, 100% { opacity: 0.1; transform: scale(1); }
  50% { opacity: 0.2; transform: scale(1.1); }
}
</style>