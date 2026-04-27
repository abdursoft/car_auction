<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  Heart, 
  Clock, 
  Gavel, 
  Trash2, 
  ChevronRight, 
  ArrowUpRight,
  BellRing,
  Car
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

// Static Data for the Watchlist
const watchedCars = [
    {
        id: 1,
        title: "2019 Ferrari 488 Pista",
        image: "https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=600&q=80",
        currentBid: 342000,
        endTime: "42m 12s",
        bidsCount: 12,
        isEndingSoon: true,
        location: "Los Angeles, CA"
    },
    {
        id: 2,
        title: "1998 Toyota Supra MK4",
        image: "https://images.unsplash.com/photo-1616788494707-ec28f08d05a1?auto=format&fit=crop&w=600&q=80",
        currentBid: 125000,
        endTime: "2d 14h",
        bidsCount: 54,
        isEndingSoon: false,
        location: "Tokyo, JP"
    },
    {
        id: 3,
        title: "2024 Land Rover Defender",
        image: "https://images.unsplash.com/photo-1623912630504-441619476378?auto=format&fit=crop&w=600&q=80",
        currentBid: 89000,
        endTime: "5h 22m",
        bidsCount: 8,
        isEndingSoon: false,
        location: "London, UK"
    }
];

const formatCurrency = (value: number) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(value);
};
</script>

<template>
    <Head title="My Watchlist" />

    <div class="min-h-screen bg-slate-50 p-4 md:p-8 lg:p-12">
        <div class="max-w-6xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <nav class="flex items-center gap-2 text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">
                        <Link href="/dashboard" class="hover:text-blue-600 transition">Dashboard</Link>
                        <ChevronRight :size="12" />
                        <span class="text-slate-900">Watchlist</span>
                    </nav>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Your Favorites</h1>
                    <p class="text-slate-500 font-medium">Tracking {{ watchedCars.length }} vehicles ending soon.</p>
                </div>

                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 rounded-2xl font-bold text-slate-700 hover:border-blue-600 transition shadow-sm group">
                    <BellRing :size="18" class="text-slate-400 group-hover:text-blue-600" /> Notification Settings
                </button>
            </div>

            <div v-if="watchedCars.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="car in watchedCars" :key="car.id" 
                     class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-500 overflow-hidden flex flex-col">
                    
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img :src="car.image" :alt="car.title" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                        
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span v-if="car.isEndingSoon" class="bg-rose-500 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg animate-pulse">
                                Ending Soon
                            </span>
                        </div>

                        <button class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-md rounded-xl text-rose-500 shadow-sm hover:bg-rose-500 hover:text-white transition-colors">
                            <Trash2 :size="18" />
                        </button>

                        <div class="absolute bottom-4 left-4 right-4 p-4 bg-white/80 backdrop-blur-xl rounded-2xl border border-white/50 shadow-lg flex justify-between items-center">
                            <div>
                                <p class="text-[8px] font-black uppercase text-slate-400 tracking-widest">Current Bid</p>
                                <p class="text-lg font-black text-slate-900">{{ formatCurrency(car.currentBid) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[8px] font-black uppercase text-slate-400 tracking-widest">Time Left</p>
                                <p :class="car.isEndingSoon ? 'text-rose-500' : 'text-blue-600'" class="text-lg font-black">{{ car.endTime }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-blue-600 transition-colors">{{ car.title }}</h3>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-6">{{ car.location }} • {{ car.bidsCount }} Bids</p>
                        
                        <div class="mt-auto flex gap-3">
                            <Link :href="`/auctions/live`" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black text-sm text-center hover:bg-blue-600 transition shadow-lg shadow-slate-200">
                                Place a Bid
                            </Link>
                            <Link :href="`/auctions/show`" class="p-4 bg-slate-100 text-slate-400 rounded-2xl hover:bg-slate-200 hover:text-slate-900 transition">
                                <ArrowUpRight :size="20" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="py-32 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-100">
                <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <Heart :size="48" />
                </div>
                <h2 class="text-3xl font-black text-slate-900">Your Watchlist is Empty</h2>
                <p class="text-slate-500 font-medium mt-2 max-w-xs mx-auto">Save vehicles you're interested in to get real-time price and time alerts.</p>
                <Link href="/auctions" class="mt-8 inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-200">
                    <Car :size="20" /> Explore Auctions
                </Link>
            </div>

        </div>
    </div>
</template>