<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  Gavel, 
  Clock, 
  ArrowUpRight, 
  AlertCircle, 
  CheckCircle2, 
  ChevronRight,
  Filter
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

// Static Data for the Bid List
const activeBids = [
    {
        id: 1,
        title: "2022 Porsche 911 GT3",
        image: "https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=400&q=80",
        yourBid: 162500,
        currentHigh: 162500,
        endTime: "2h 45m",
        status: "winning",
        bidsCount: 42
    },
    {
        id: 2,
        title: "1967 Ford Mustang Fastback",
        image: "https://images.unsplash.com/photo-1584345604440-835f45c9155a?auto=format&fit=crop&w=400&q=80",
        yourBid: 45000,
        currentHigh: 48200,
        endTime: "52m 10s",
        status: "outbid",
        bidsCount: 18
    },
    {
        id: 3,
        title: "2024 Tesla Model S Plaid",
        image: "https://images.unsplash.com/photo-1617788138017-80ad42243c5d?auto=format&fit=crop&w=400&q=80",
        yourBid: 92000,
        currentHigh: 92000,
        endTime: "14h 22m",
        status: "winning",
        bidsCount: 12
    }
];

const formatCurrency = (value: number) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(value);
};
</script>

<template>
    <Head title="My Bids" />

    <div class="min-h-screen bg-slate-50 p-4 md:p-8 lg:p-12">
        <div class="max-w-6xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <nav class="flex items-center gap-2 text-slate-400 text-xs font-black uppercase tracking-widest mb-4">
                        <Link href="/dashboard" class="hover:text-blue-600 transition">Dashboard</Link>
                        <ChevronRight :size="12" />
                        <span class="text-slate-900">My Bids</span>
                    </nav>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Active Bidding</h1>
                    <p class="text-slate-500 font-medium mt-1">You are currently bidding on {{ activeBids.length }} vehicles.</p>
                </div>

                <div class="flex gap-3">
                    <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-slate-700 hover:bg-slate-50 transition shadow-sm">
                        <Filter :size="18" /> Filter
                    </button>
                </div>
            </div>

            <div class="space-y-4">
                <div v-for="bid in activeBids" :key="bid.id" 
                     class="bg-white rounded-[2.5rem] p-4 md:p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                    
                    <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                        
                        <div class="w-full lg:w-56 h-40 rounded-[1.8rem] overflow-hidden shrink-0 relative">
                            <img :src="bid.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent lg:hidden"></div>
                            <div class="absolute bottom-4 left-4 lg:hidden">
                                <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    {{ bid.endTime }} left
                                </span>
                            </div>
                        </div>

                        <div class="flex-1 grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:items-center">
                            
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 leading-tight">{{ bid.title }}</h3>
                                <div class="flex items-center gap-2">
                                    <span v-if="bid.status === 'winning'" class="flex items-center gap-1.5 text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                        <CheckCircle2 :size="12" /> Winning
                                    </span>
                                    <span v-else class="flex items-center gap-1.5 text-rose-600 bg-rose-50 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-rose-100 animate-pulse">
                                        <AlertCircle :size="12" /> Outbid
                                    </span>
                                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">{{ bid.bidsCount }} Bids</span>
                                </div>
                            </div>

                            <div class="flex gap-8">
                                <div>
                                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Your Bid</p>
                                    <p class="text-xl font-black text-slate-900">{{ formatCurrency(bid.yourBid) }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Current High</p>
                                    <p :class="bid.status === 'outbid' ? 'text-rose-600' : 'text-blue-600'" class="text-xl font-black">
                                        {{ formatCurrency(bid.currentHigh) }}
                                    </p>
                                </div>
                            </div>

                            <div class="hidden lg:flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3 text-slate-500">
                                    <Clock :size="20" class="text-blue-600" />
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest leading-none mb-1">Ends In</p>
                                        <p class="font-bold text-slate-900">{{ bid.endTime }}</p>
                                    </div>
                                </div>
                                <Link :href="`/auctions/${bid.id}`" 
                                      class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-blue-600 transition shadow-lg shadow-slate-200 group-hover:-translate-y-1">
                                    <ArrowUpRight :size="24" />
                                </Link>
                            </div>

                        </div>

                        <div class="lg:hidden flex items-center justify-between pt-4 border-t border-slate-50">
                             <div class="flex items-center gap-2 text-slate-500 text-sm font-bold">
                                <Clock :size="16" /> {{ bid.endTime }}
                            </div>
                            <Link :href="`/auctions/${bid.id}`" class="text-blue-600 font-black text-sm uppercase tracking-widest flex items-center gap-1">
                                Update Bid <ChevronRight :size="16" />
                            </Link>
                        </div>

                    </div>
                </div>
            </div>

            <div v-if="activeBids.length === 0" class="mt-12 text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <Gavel :size="40" />
                </div>
                <h2 class="text-2xl font-black text-slate-900">No active bids</h2>
                <p class="text-slate-500 mt-2 mb-8">You haven't placed any bids yet. Start exploring the latest auctions!</p>
                <Link href="/auctions" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-700 transition">
                    Browse Auctions
                </Link>
            </div>

        </div>
    </div>
</template>