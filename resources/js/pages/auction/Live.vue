<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  Gavel, Clock, Users, ArrowUp, Volume2, 
  ShieldCheck, Zap, TrendingUp, Maximize2,
  ChevronLeft, Eye
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

// Static Data for UI Design
const currentAuction = {
    title: "2023 Lamborghini Huracán Sterrato",
    lotNumber: "LOT #442",
    currentBid: 285000,
    bidsCount: 54,
    watchers: 1240,
    timeRemaining: "02:14",
    seller: "Exotic Motors Miami",
    condition: "Mint / 140 miles"
};

const recentBids = [
    { id: 1, user: 'CryptoKing', amount: 285000, time: '12s ago', type: 'bid', isHigh: true },
    { id: 2, user: 'J. Henderson', amount: 282500, time: '45s ago', type: 'bid', isHigh: false },
    { id: 3, user: 'User992', amount: 280000, time: '1m ago', type: 'bid', isHigh: false },
];
</script>

<template>
    <Head title="LIVE AUCTION | Sterrato" />

    <div class="min-h-screen bg-slate-50 p-4 md:p-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                <div class="flex items-center gap-6">
                    <Link href="/auctions" class="p-3 bg-white rounded-2xl border border-slate-200 text-slate-400 hover:text-blue-600 transition shadow-sm">
                        <ChevronLeft :size="20" />
                    </Link>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="flex items-center gap-1.5 bg-rose-500 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-200 animate-pulse">
                                <div class="w-1.5 h-1.5 bg-white rounded-full"></div> Live Auction
                            </span>
                            <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest ml-2">{{ currentAuction.lotNumber }}</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">{{ currentAuction.title }}</h1>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-white border border-slate-200 px-5 py-2.5 rounded-2xl flex items-center gap-3 shadow-sm">
                        <Users :size="18" class="text-blue-600" />
                        <span class="text-sm font-black text-slate-900">{{ currentAuction.watchers.toLocaleString() }}</span>
                        <span class="text-[10px] font-black uppercase text-slate-400">Watching</span>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-8 space-y-6">
                    <div class="relative bg-white rounded-[3rem] overflow-hidden border border-slate-200 shadow-xl shadow-slate-200/50 group">
                        <img src="https://images.unsplash.com/photo-1621135802920-133df287f89c?auto=format&fit=crop&w=1200&q=80" 
                             class="w-full aspect-video object-cover transition-transform duration-1000 group-hover:scale-105" />
                        
                        <div class="absolute top-6 right-6">
                            <button class="p-4 bg-white/90 backdrop-blur-md hover:bg-white rounded-2xl transition shadow-xl border border-white">
                                <Maximize2 :size="20" class="text-slate-900" />
                            </button>
                        </div>

                        <div class="absolute bottom-8 left-8 right-8 p-8 bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white/50 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-1">Current Highest Bid</p>
                                <h2 class="text-5xl font-black text-slate-900 tracking-tighter">${{ currentAuction.currentBid.toLocaleString() }}</h2>
                            </div>
                            <div class="bg-slate-900 px-8 py-5 rounded-[2rem] text-center min-w-[160px] shadow-xl shadow-slate-900/20">
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Ends In</p>
                                <p class="text-3xl font-mono font-black text-white">{{ currentAuction.timeRemaining }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar">
                        <div v-for="i in 5" :key="i" class="w-32 aspect-video bg-white rounded-2xl border border-slate-200 overflow-hidden flex-shrink-0 cursor-pointer hover:border-blue-600 transition-all p-1">
                            <img src="https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&w=300&q=80" class="w-full h-full object-cover rounded-xl" />
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-4 flex flex-col gap-6">
                    
                    <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40">
                        <div class="mb-8 flex items-center justify-between">
                            <h3 class="font-black text-xl text-slate-900 tracking-tight">Place a Bid</h3>
                            <button class="p-2 text-slate-300 hover:text-blue-600 transition"><Volume2 :size="20" /></button>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <button v-for="inc in [500, 1000]" :key="inc" class="flex flex-col items-center justify-center p-4 border-2 border-slate-50 bg-slate-50/50 rounded-[1.5rem] hover:border-blue-600 hover:bg-white hover:shadow-lg transition-all group">
                                <span class="text-[10px] font-black text-slate-400 group-hover:text-blue-600 uppercase mb-1">+$ {{ inc }}</span>
                                <span class="text-lg font-black text-slate-900">${{ (currentAuction.currentBid + inc).toLocaleString() }}</span>
                            </button>
                        </div>

                        <div class="relative mb-6">
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-black text-xl">$</div>
                            <input type="number" placeholder="Custom Bid" class="w-full pl-12 pr-6 py-5 bg-slate-50 border-none rounded-2xl font-black text-xl focus:ring-2 focus:ring-blue-600 focus:bg-white transition shadow-inner" />
                        </div>

                        <button class="w-full bg-blue-600 hover:bg-blue-700 py-6 rounded-[2rem] font-black text-white text-lg transition-all shadow-xl shadow-blue-200 flex items-center justify-center gap-3 active:scale-95">
                            Place Bid Now <Zap :size="22" />
                        </button>

                        <div class="flex items-center gap-2 justify-center mt-6 text-[10px] text-slate-400 font-black uppercase tracking-[0.1em]">
                            <ShieldCheck :size="14" class="text-emerald-500" /> Identity Verified • Secure Auction
                        </div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-[3rem] shadow-xl shadow-slate-200/40 flex-1 flex flex-col overflow-hidden">
                        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                            <h3 class="font-black text-[10px] uppercase tracking-widest text-slate-400">Activity Log</h3>
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></div>
                                <span class="text-[10px] font-black text-emerald-500 uppercase">Live</span>
                            </div>
                        </div>
                        
                        <div class="p-2 overflow-y-auto max-h-[350px] space-y-1 custom-scrollbar">
                            <div v-for="bid in recentBids" :key="bid.id" 
                                 :class="[bid.isHigh ? 'bg-blue-50 border-blue-100' : 'bg-transparent border-transparent hover:bg-slate-50']"
                                 class="flex items-center justify-between p-4 rounded-[1.5rem] border transition">
                                <div class="flex items-center gap-4">
                                    <div :class="[bid.isHigh ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400']" class="w-10 h-10 rounded-xl flex items-center justify-center">
                                        <Gavel :size="18" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900">{{ bid.user }}</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ bid.time }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p :class="[bid.isHigh ? 'text-blue-600' : 'text-slate-900']" class="text-sm font-black">${{ bid.amount.toLocaleString() }}</p>
                                    <p v-if="bid.isHigh" class="text-[8px] font-black uppercase text-blue-400 tracking-widest">Highest</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  height: 4px;
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e2e8f0;
  border-radius: 10px;
}
</style>