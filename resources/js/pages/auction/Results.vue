<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { 
  Search, 
  Filter, 
  TrendingUp, 
  Calendar, 
  MapPin, 
  ChevronRight, 
  BarChart2,
  Trophy
} from 'lucide-vue-next';
import App from '@/layouts/App.vue';

defineOptions({ layout: App });

// Static Data for Sold History
const soldResults = [
    {
        id: 1,
        title: "2021 Porsche 911 GT3",
        image: "https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=400&q=80",
        soldPrice: 215000,
        soldDate: "Oct 12, 2025",
        location: "Miami, FL",
        bids: 48,
        mileage: "1,240 mi"
    },
    {
        id: 2,
        title: "1967 Ford Mustang Fastback",
        image: "https://images.unsplash.com/photo-1584345604440-835f45c9155a?auto=format&fit=crop&w=400&q=80",
        soldPrice: 82000,
        soldDate: "Oct 10, 2025",
        location: "Austin, TX",
        bids: 24,
        mileage: "45,000 mi"
    },
    {
        id: 3,
        title: "2023 Tesla Model S Plaid",
        image: "https://images.unsplash.com/photo-1617788138017-80ad42243c5d?auto=format&fit=crop&w=400&q=80",
        soldPrice: 94500,
        soldDate: "Oct 08, 2025",
        location: "Greenwich, CT",
        bids: 15,
        mileage: "3,100 mi"
    }
];

const formatCurrency = (value: number) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(value);
};
</script>

<template>
    <Head title="Market Results | Sold History" />

    <div class="min-h-screen bg-slate-50 p-4 md:p-8 lg:p-12">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-12">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="bg-slate-900 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                            Historical Data
                        </span>
                        <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Global Archive</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter mb-4">Market <span class="text-blue-600">Results.</span></h1>
                    <p class="text-lg text-slate-500 font-medium leading-relaxed">
                        Research transparent sale prices from our global auction archive to value your vehicle or plan your next bid.
                    </p>
                </div>

                <div class="flex gap-4">
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                            <BarChart2 :size="24" />
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Sales</p>
                            <p class="text-xl font-black text-slate-900">$12.4M</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-[2.5rem] border border-slate-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <Search class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400" :size="20" />
                    <input type="text" placeholder="Search by make, model, or year..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl font-bold focus:ring-2 focus:ring-blue-600 transition" />
                </div>
                <button class="flex items-center justify-center gap-2 px-8 py-4 bg-slate-900 text-white rounded-2xl font-black hover:bg-blue-600 transition shadow-lg shadow-slate-200">
                    <Filter :size="18" /> Refine Search
                </button>
            </div>

            <div class="space-y-4">
                <div v-for="result in soldResults" :key="result.id" 
                     class="bg-white rounded-[2.5rem] p-4 md:p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 group">
                    
                    <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                        
                        <div class="w-full lg:w-48 h-36 rounded-[1.8rem] overflow-hidden shrink-0 relative">
                            <img :src="result.image" class="w-full h-full object-cover grayscale-[0.3] group-hover:grayscale-0 transition-all duration-700" />
                            <div class="absolute inset-0 bg-slate-900/10"></div>
                            <div class="absolute top-3 left-3">
                                <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest text-slate-900 border border-white">
                                    Sold
                                </span>
                            </div>
                        </div>

                        <div class="flex-1 grid md:grid-cols-2 lg:grid-cols-4 gap-6 items-center">
                            
                            <div class="space-y-1">
                                <h3 class="text-xl font-black text-slate-900 leading-tight">{{ result.title }}</h3>
                                <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-tight">
                                    <MapPin :size="12" /> {{ result.location }}
                                </div>
                            </div>

                            <div class="flex gap-6">
                                <div>
                                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1">Mileage</p>
                                    <p class="text-sm font-bold text-slate-700">{{ result.mileage }}</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1">Bids</p>
                                    <p class="text-sm font-bold text-slate-700">{{ result.bids }}</p>
                                </div>
                            </div>

                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 group-hover:bg-blue-50 group-hover:border-blue-100 transition-colors">
                                <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1 group-hover:text-blue-600">Sold Price</p>
                                <p class="text-xl font-black text-slate-900 group-hover:text-blue-700">{{ formatCurrency(result.soldPrice) }}</p>
                            </div>

                            <div class="flex items-center justify-between lg:justify-end gap-6">
                                <div class="text-right">
                                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1">Sale Date</p>
                                    <p class="text-sm font-bold text-slate-700">{{ result.soldDate }}</p>
                                </div>
                                <Link :href="`/auctions/show`" class="w-12 h-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-600 transition shadow-sm">
                                    <ChevronRight :size="20" />
                                </Link>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 bg-blue-600 rounded-[3rem] p-10 md:p-16 text-white text-center relative overflow-hidden shadow-2xl shadow-blue-200">
                <div class="relative z-10">
                    <Trophy class="mx-auto mb-6 text-blue-200" :size="48" />
                    <h2 class="text-3xl md:text-5xl font-black mb-6 tracking-tight">Thinking of selling your collection?</h2>
                    <p class="text-blue-100 text-lg font-medium max-w-2xl mx-auto mb-10">
                        Our data shows luxury coupes are up 12% in value this month. List now to reach our 150k+ verified buyers.
                    </p>
                    <Link href="/sell" class="bg-white text-blue-600 px-10 py-5 rounded-2xl font-black text-lg hover:bg-blue-50 transition shadow-xl">
                        List My Vehicle
                    </Link>
                </div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</template>