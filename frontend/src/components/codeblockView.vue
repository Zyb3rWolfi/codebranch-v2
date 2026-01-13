<template>
  <div class="font-jetbrains">
    <header class="mb-10">
      <h1 class="text-4xl text-white mb-4">Unity WASD Movement</h1>
      <div class="h-px w-full bg-[#3C3C3C] mb-8"></div>
      
      <p class="text-gray-400 text-lg mb-6 leading-relaxed">
        Implement a simple movement system where the player can move using WASD keys.
      </p>

      <div class="flex gap-2">
        <span class="font-share px-3 py-1 bg-[#2D2D30] border border-[#3C3C3C] text-xs text-gray-400 rounded">C#</span>
        <span class="font-share px-3 py-1 bg-[#2D2D30] border border-[#3C3C3C] text-xs text-gray-400 rounded">Unity</span>
      </div>
    </header>

    <section class="mb-12">
      <h2 class="text-2xl text-white mb-6">Revisions</h2>
      <div class="border border-[#3C3C3C] rounded-md overflow-hidden bg-[#1E1E1E]">
        <div class="p-4 text-gray-500 border-b border-[#3C3C3C] text-sm">
          v1 Initial Version
        </div>
        <div class="p-5 bg-[#2D2D30]">
          <div class="text-white text-lg">v2 Added Controller Support</div>
          <p class="text-gray-500 text-sm mt-1 font-share">Added support for controller movement as well</p>
        </div>
      </div>
    </section>

    <section>
      <h2 class="text-2xl text-white mb-6">Code</h2>
      <div class="bg-[#121212] border border-[#3C3C3C] rounded-md p-8 overflow-x-auto">
        <pre class="text-sm leading-7 text-[#9CDCFE]">
<code>const pluckDeep = key => obj => key.split('.').reduce((accum, key) => accum[key], obj)
const compose = (...fns) => res => fns.reduce((accum, next) => next(accum), res)

const unfold = (f, seed) => {
  const go = (f, seed, acc) => {
    const res = f(seed)
    return res ? go(f, res[1], acc.concat([res[0]])) : acc
  }
  return go(f, seed, [])
}</code>
        </pre>
      </div>
    </section>
  </div>
</template>