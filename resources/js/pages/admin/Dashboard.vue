<script setup lang="ts">
import AdminLayout from '@/layouts/Admin.vue';
import { TrendingUp, Gavel, Users, DollarSign, Clock } from 'lucide-vue-next';

defineOptions({ layout: AdminLayout });

const stats = [
    { name: 'Active Auctions', value: '42', change: '+12%', icon: Gavel, color: 'bg-blue-500' },
    { name: 'New Bidders', value: '1,280', change: '+5%', icon: Users, color: 'bg-indigo-500' },
    { name: 'Total Revenue', value: '$452.8k', change: '+18%', icon: DollarSign, color: 'bg-emerald-500' },
    { name: 'Pending Approvals', value: '8', change: '-2', icon: Clock, color: 'bg-amber-500' },
];
</script>

<template>
  <div class="space-y-10 animate-in fade-in duration-700">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div v-for="stat in stats" :key="stat.name" 
           class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 group hover:shadow-xl transition-all">
        <div class="flex items-center justify-between mb-6">
          <div :class="[stat.color]" class="w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-current/20">
            <component :is="stat.icon" :size="24" />
          </div>
          <span class="text-xs font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">{{ stat.change }}</span>
        </div>
        <h4 class="text-slate-400 font-black uppercase text-[10px] tracking-widest">{{ stat.name }}</h4>
        <p class="text-3xl font-black text-slate-900 tracking-tighter">{{ stat.value }}</p>
      </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm min-h-[400px]">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-black text-slate-900 tracking-tight italic uppercase italic">Recent <span class="text-blue-600">Bids</span></h3>
                <button class="text-xs font-black text-blue-600 uppercase">View Report</button>
            </div>
            <div class="space-y-6">
                <div v-for="i in 5" :key="i" class="flex items-center gap-4 pb-6 border-b border-slate-50 last:border-0">
                    <div class="w-12 h-12 bg-slate-50 rounded-xl overflow-hidden shrink-0">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-black text-slate-900 truncate">Porsche 911 GT3 RS</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">User: Alex_Racer</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black text-blue-600">$185,200</p>
                        <p class="text-[10px] text-slate-400 font-bold">2 mins ago</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl">
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-2 italic">Global Auction <span class="text-blue-400">Heatmap</span></h3>
                <p class="text-slate-400 text-xs mb-10">Real-time bidding density by location.</p>
                <div class="h-48 bg-white/5 rounded-3xl border border-white/10 flex items-center justify-center text-slate-600 italic font-black">
                    Live Map Placeholder
                </div>
                <div class="mt-8 space-y-4">
                    <div class="flex justify-between text-xs font-bold"><span>California, USA</span> <span class="text-blue-400">45%</span></div>
                    <div class="w-full h-1 bg-white/5 rounded-full"><div class="w-[45%] h-full bg-blue-500 rounded-full"></div></div>
                </div>
            </div>
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-blue-600/20 blur-3xl rounded-full"></div>
        </div>
    </div>
  </div>
</template>