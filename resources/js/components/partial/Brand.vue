<template>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Browse by Brand</h2>
                <p class="text-slate-500 mt-2">Find your next obsession from the world's top manufacturers.</p>
            </div>
            <a href="#" class="group flex items-center gap-2 text-sm font-bold text-indigo-600">
                View all 40+ brands
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            
            <a href="#" class="group relative flex flex-col items-center justify-center p-8 bg-slate-50 border border-slate-100 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-indigo-100 hover:border-indigo-100 transition-all duration-300">
                <div class="h-16 w-16 mb-4 flex items-center justify-center grayscale group-hover:grayscale-0 transition-all duration-500">
                <img src="https://www.svgrepo.com/show/306596/porsche.svg" alt="Porsche" class="h-12 w-12 object-contain" />
                </div>
                <span class="font-bold text-slate-800 tracking-tight">Porsche</span>
                <span class="mt-1 text-[10px] font-black text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity uppercase">124 Live</span>
            </a>

            <a href="#" class="group relative flex flex-col items-center justify-center p-8 bg-slate-50 border border-slate-100 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-indigo-100 hover:border-indigo-100 transition-all duration-300">
                <div class="h-16 w-16 mb-4 flex items-center justify-center grayscale group-hover:grayscale-0 transition-all duration-500">
                <img src="https://www.svgrepo.com/show/305781/bmw.svg" alt="BMW" class="h-12 w-12 object-contain" />
                </div>
                <span class="font-bold text-slate-800 tracking-tight">BMW</span>
                <span class="mt-1 text-[10px] font-black text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity uppercase">85 Live</span>
            </a>

            <a href="#" class="group relative flex flex-col items-center justify-center p-8 bg-slate-50 border border-slate-100 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-indigo-100 hover:border-indigo-100 transition-all duration-300">
                <div class="h-16 w-16 mb-4 flex items-center justify-center grayscale group-hover:grayscale-0 transition-all duration-500">
                <img src="https://www.svgrepo.com/show/306399/mercedes-benz.svg" alt="Mercedes" class="h-12 w-12 object-contain" />
                </div>
                <span class="font-bold text-slate-800 tracking-tight">Mercedes</span>
                <span class="mt-1 text-[10px] font-black text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity uppercase">62 Live</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-slate-200 rounded-3xl hover:border-indigo-300 hover:bg-indigo-50/30 transition-all group">
                <div class="h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center mb-2 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                </div>
                <span class="text-xs font-bold text-slate-500">See All</span>
            </a>
            </div>
        </div>
    </section>
</template>