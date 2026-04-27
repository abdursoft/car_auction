<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { 
  Gavel, Clock, ChevronLeft, Share2, Heart, 
  Info, History, ShieldCheck, TrendingUp, ArrowUp 
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

// Static Data for the Bidding Room
const car = {
    title: "2021 Porsche 911 GT3",
    currentBid: 162500,
    endTimestamp: "2h 45m 12s",
    minIncrement: 500,
    bids: [
        { id: 1, user: "SpeedDemon99", amount: 162500, time: "2 mins ago", isHigh: true },
        { id: 2, user: "Collector_JP", amount: 162000, time: "5 mins ago", isHigh: false },
        { id: 3, user: "EuroLover", amount: 161500, time: "12 mins ago", isHigh: false },
        { id: 4, user: "Collector_JP", amount: 160000, time: "1 hour ago", isHigh: false },
    ],
    specs: [
        { label: "Mileage", value: "1,240 mi" },
        { label: "Engine", value: "4.0L H6" },
        { label: "Transmission", value: "7-Speed PDK" },
        { label: "Location", value: "Miami, FL" }
    ]
};

const bidAmount = ref(car.currentBid + car.minIncrement);
</script>

<template>
    <Head :title="car.title" />

    <div class="min-h-screen bg-slate-50">
        <nav class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <Link href="/auctions" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition">
                    <ChevronLeft :size="20" /> Back to Auctions
                </Link>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-slate-400 hover:text-rose-500 transition"><Heart :size="20" /></button>
                    <button class="p-2 text-slate-400 hover:text-blue-600 transition"><Share2 :size="20" /></button>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto p-4 md:p-8 grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200 group">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80" 
                         class="w-full aspect-video object-cover transition-transform duration-700 group-hover:scale-105" />
                    <div class="absolute bottom-6 left-6 flex gap-2">
                        <span class="bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-xl text-xs font-bold">1/24 Photos</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                        <div>
                            <h1 class="text-4xl font-black text-slate-900 tracking-tight">{{ car.title }}</h1>
                            <p class="text-slate-500 font-medium">Verified Listing • <span class="text-blue-600">ID #88291</span></p>
                        </div>
                        <div class="bg-blue-50 text-blue-600 px-6 py-3 rounded-2xl">
                            <p class="text-[10px] font-black uppercase tracking-widest leading-none mb-1">Current Bid</p>
                            <p class="text-2xl font-black">${{ car.currentBid.toLocaleString() }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-6 border-y border-slate-50">
                        <div v-for="spec in car.specs" :key="spec.label">
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">{{ spec.label }}</p>
                            <p class="font-bold text-slate-800">{{ spec.value }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-black text-slate-900 mb-3 flex items-center gap-2">
                            <Info :size="18" class="text-blue-600" /> Listing Description
                        </h3>
                        <p class="text-slate-600 leading-relaxed">
                            This pristine GT3 is finished in Shark Blue over a Black leather/Race-Tex interior. Features include the Front Axle Lift System, Carbon Fiber Roof, and Bose Surround Sound. Strictly maintained at Porsche of Miami.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl shadow-blue-900/20 sticky top-24">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center animate-pulse">
                                <Clock :size="20" />
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ending In</p>
                                <p class="text-xl font-bold">{{ car.endTimestamp }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3 block text-center">Your Next Bid</label>
                            <div class="flex items-center justify-between bg-white/10 rounded-2xl p-2 border border-white/10">
                                <button @click="bidAmount -= car.minIncrement" class="p-3 hover:bg-white/10 rounded-xl transition text-slate-400">-</button>
                                <input v-model="bidAmount" type="number" class="bg-transparent border-none text-center font-black text-2xl focus:ring-0 w-full" />
                                <button @click="bidAmount += car.minIncrement" class="p-3 hover:bg-white/10 rounded-xl transition text-slate-400">+</button>
                            </div>
                        </div>

                        <button class="w-full bg-blue-600 hover:bg-blue-500 py-5 rounded-2xl font-black text-lg transition-all shadow-xl shadow-blue-900/40 flex items-center justify-center gap-3">
                            Place Your Bid <Gavel :size="20" />
                        </button>

                        <div class="flex items-center gap-2 justify-center text-[10px] text-slate-500 font-bold uppercase">
                            <ShieldCheck :size="14" class="text-emerald-500" /> Secure • No Buyers Premium
                        </div>
                    </div>

                    <div class="mt-10 pt-10 border-t border-white/5">
                        <h4 class="text-sm font-black uppercase tracking-widest mb-6 flex items-center justify-between">
                            Bid History <TrendingUp :size="16" class="text-blue-400" />
                        </h4>
                        
                        <div class="space-y-4 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                            <div v-for="bid in car.bids" :key="bid.id" 
                                 :class="[bid.isHigh ? 'bg-blue-600/20 border-blue-500/30' : 'bg-white/5 border-transparent']"
                                 class="flex items-center justify-between p-4 rounded-2xl border transition hover:bg-white/10">
                                <div>
                                    <p class="font-bold text-sm" :class="bid.isHigh ? 'text-blue-400' : 'text-slate-200'">{{ bid.user }}</p>
                                    <p class="text-[10px] text-slate-500">{{ bid.time }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-black">${{ bid.amount.toLocaleString() }}</p>
                                    <span v-if="bid.isHigh" class="text-[8px] bg-blue-600 text-white px-2 py-0.5 rounded-full uppercase font-black">Winning</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </main>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}
</style>