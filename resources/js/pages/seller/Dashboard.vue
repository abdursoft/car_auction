<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  BarChart3, Car, Users, Eye, Plus, 
  ArrowUpRight, MoreHorizontal, Clock, 
  CheckCircle2, AlertCircle, DollarSign 
} from 'lucide-vue-next';
import App from '@/layouts/App.vue';
import { route } from 'ziggy-js';

defineOptions({ layout: App });

const sellerStats = [
    { label: 'Total Revenue', value: '$242,500', icon: DollarSign, color: 'text-emerald-600', bg: 'bg-emerald-50' },
    { label: 'Active Listings', value: '3', icon: Car, color: 'text-blue-600', bg: 'bg-blue-50' },
    { label: 'Total Watchers', value: '1,240', icon: Eye, color: 'text-indigo-600', bg: 'bg-indigo-50' },
    { label: 'Successful Sales', value: '8', icon: CheckCircle2, color: 'text-purple-600', bg: 'bg-purple-50' },
];

const activeListings = [
    {
        id: 1,
        car: "1994 Toyota Supra Turbo",
        status: "Active",
        bids: 24,
        currentBid: 85200,
        watchers: 452,
        endsIn: "1d 4h",
        image: "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=400&q=80"
    },
    {
        id: 2,
        car: "2018 BMW M2 Competition",
        status: "Pending Approval",
        bids: 0,
        currentBid: 0,
        watchers: 0,
        endsIn: "--",
        image: "https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=400&q=80"
    }
];
</script>

<template>
    <Head title="Seller Dashboard" />

    <div class="min-h-screen bg-slate-50 p-4 md:p-8 lg:p-12">
        <div class="max-w-7xl mx-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Seller Hub</h1>
                    <p class="text-slate-500 font-medium">Manage your listings and track your auction performance.</p>
                </div>
                <Link :href="route('addListing')" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all hover:-translate-y-1">
                    <Plus :size="20" /> Create New Listing
                </Link>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div v-for="stat in sellerStats" :key="stat.label" class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <div :class="[stat.bg, stat.color]" class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                        <component :is="stat.icon" :size="24" />
                    </div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest mb-1">{{ stat.label }}</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ stat.value }}</h3>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden hover:shadow-xl">
                    <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                        <h2 class="text-xl font-black text-slate-900">Your Listings</h2>
                        <Link href="#" class="text-sm font-bold text-blue-600 hover:underline">View All History</Link>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/50 text-slate-400 text-[10px] uppercase font-black tracking-widest">
                                <tr>
                                    <th class="px-8 py-4">Vehicle</th>
                                    <th class="px-8 py-4">Performance</th>
                                    <th class="px-8 py-4">Status</th>
                                    <th class="px-8 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <tr v-for="item in activeListings" :key="item.id" class="group hover:bg-slate-50/50 transition">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <img :src="item.image" class="w-16 h-12 rounded-lg object-cover" />
                                            <div>
                                                <p class="font-black text-slate-900 text-sm leading-none mb-1">{{ item.car }}</p>
                                                <p class="text-xs text-slate-400 font-bold">Ends in {{ item.endsIn }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex gap-4">
                                            <div>
                                                <p class="text-[10px] text-slate-400 font-black uppercase">Bids</p>
                                                <p class="text-sm font-black text-slate-900">{{ item.bids }}</p>
                                            </div>
                                            <div>
                                                <p class="text-[10px] text-slate-400 font-black uppercase">Current</p>
                                                <p class="text-sm font-black text-blue-600">${{ item.currentBid.toLocaleString() }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span :class="item.status === 'Active' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600'" 
                                              class="px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                            {{ item.status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="p-2 text-slate-400 hover:text-slate-900 transition">
                                            <MoreHorizontal :size="20" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden hover:shadow-md transition-all">
                        <div class="relative z-10">
                            <BarChart3 class="text-blue-400 mb-4" :size="32" />
                            <h3 class="text-xl font-black mb-2">Boost your reach</h3>
                            <p class="text-slate-400 text-sm leading-relaxed mb-6">Listings with more than 30 photos receive 45% higher bids on average.</p>
                            <button class="w-full bg-white text-slate-900 py-3 rounded-xl font-bold text-sm hover:bg-blue-50 transition">
                                Add Photos to Listing
                            </button>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/20 rounded-full blur-3xl"></div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm  hover:shadow-md transition-all">
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Payout Method</h4>
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="bg-white p-2 rounded-lg shadow-sm">
                                <DollarSign class="text-emerald-600" :size="20" />
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-900">Bank Transfer •••• 8829</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase">Verified Account</p>
                            </div>
                            <button class="ml-auto text-blue-600"><ArrowUpRight :size="16" /></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>