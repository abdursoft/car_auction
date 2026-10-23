<script setup>
import HomeLayout from '@/layouts/App.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Icon } from '@iconify/vue';
import Car from '@/components/cards/Car.vue';

defineOptions({
    layout: HomeLayout
})

const cars = ref([
            {
                id: 1,
                title: '2023 Porsche 911 GT3',
                description: '4.0L H6 • 1,200 miles • Miami, FL',
                currentBid: '$185,000',
                image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600',
                timeLeft: '04h 22m Left',
            },
            {
                id: 2,
                title: '1967 Ford Mustang',
                description: '5.0L V8 • 45,000 miles • Los Angeles, CA',
                currentBid: '$75,000',
                image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600',
                timeLeft: 'Live Auction',
            },
        ]);
const open = ref(true)
</script>

<template>
    <div>
        <Head title="Auctions" />
        <div class="bg-gray-100 min-h-screen">
            <div class="bg-white border-b border-gray-200 shadow-sm py-4">
                <div class="max-w-[1400px] mx-auto px-4 flex justify-between items-center">
                    <h1 class="text-2xl font-extrabold text-slate-800">Insurance Auctions</h1>
                    <div class="flex items-center gap-4 text-sm">
                        <span class="text-gray-500 font-bold">527,970 VEHICLES FOUND</span>
                        <select class="bg-gray-50 border border-gray-300 rounded px-3 py-1 text-xs font-bold focus:ring-1 focus:ring-blue-500">
                            <option>Time: Ending Soonest</option>
                            <option>Year: Newest First</option>
                            <option>Price: Lowest First</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="max-w-[1400px] mx-auto px-4 py-6 flex gap-6">
                
                <aside class="w-72 flex-shrink-0 hidden lg:block">
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm sticky top-24">
                        <div class="p-4 border-b border-gray-100 text-slate-800 flex justify-between items-center bg-slate-100 rounded-t-lg">
                            <span class="text-slate-800 font-bold text-sm">SEARCH FILTERS</span>
                            <button class="text-xs text-blue-700 hover:underline">Clear All</button>
                        </div>
                        
                        <div class="p-4 space-y-4 max-h-[70vh] overflow-y-auto custom-scrollbar">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Keyword Search</label>
                                <input type="text" placeholder="Lot #, Model, or VIN" class="w-full text-sm border border-gray-300 rounded p-2 outline-none focus:border-blue-500">
                            </div>

                            <div x-data="{ open: true }" class="border-b border-gray-100 pb-2">
                                <button @click="open = !open" class="flex justify-between w-full text-sm font-bold text-gray-700 py-2">
                                    MAKE <Icon :icon="open == true ? 'simple-line-icons:arrow-up' : 'simple-line-icons:arrow-down'" width="14" height="14" />
                                </button>
                                <div v-show="open" class="space-y-1 mt-1">
                                    <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                        <input type="checkbox" class="mr-2"> FORD (74,508)
                                    </label>
                                    <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                        <input type="checkbox" class="mr-2"> TOYOTA (74,379)
                                    </label>
                                    <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                        <input type="checkbox" class="mr-2"> HONDA (57,234)
                                    </label>
                                </div>
                            </div>

                            <div x-data="{ open: false }" class="border-b border-gray-100 pb-2">
                                <button @click="open = !open" class="flex justify-between w-full text-sm font-bold text-gray-700 py-2">
                                    DAMAGE TYPE <Icon :icon="open == true ? 'simple-line-icons:arrow-up' : 'simple-line-icons:arrow-down'" width="14" height="14" />
                                </button>
                                <div v-show="open" class="space-y-1 mt-1">
                                    <label class="flex items-center text-xs text-gray-600">
                                        <input type="checkbox" class="mr-2"> FRONT END
                                    </label>
                                    <label class="flex items-center text-xs text-gray-600">
                                        <input type="checkbox" class="mr-2"> WATER/FLOOD
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <button class="w-full bg-blue-600 text-white font-bold py-2 rounded shadow-md hover:bg-blue-700 transition uppercase text-sm tracking-tighter">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </aside>

                <section class="flex-1">
                    <Car/>
                    <div class="mt-10 flex justify-center items-center gap-1">
                        <button class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded font-bold text-sm">1</button>
                        <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">2</button>
                        <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">3</button>
                        <span class="px-2 text-gray-400">...</span>
                        <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">21,999</button>
                    </div>
                </section>

            </div>
        </div>
    </div>
</template>