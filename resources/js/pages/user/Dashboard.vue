<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { 
  LayoutDashboard, Car, Gavel, Heart, Settings, 
  LogOut, TrendingUp, Clock, ArrowUpRight, 
  Wallet, Bell, Menu, X 
} from 'lucide-vue-next';
import App from '@/layouts/App.vue';

defineOptions({ layout: App });

const isMobileMenuOpen = ref(false);

const stats = [
    { label: 'Active Bids', value: '12', trend: '+2', icon: Gavel, color: 'text-blue-600', bg: 'bg-blue-50' },
    { label: 'Total Spent', value: '$45.2k', trend: '3 cars', icon: Wallet, color: 'text-emerald-600', bg: 'bg-emerald-50' },
    { label: 'Watchlist', value: '28', trend: '5 end', icon: Heart, color: 'text-rose-600', bg: 'bg-rose-50' },
];

const navItems = [
    { icon: LayoutDashboard, label: 'Overview', active: true },
    { icon: Car, label: 'My Garage', active: false },
    { icon: Gavel, label: 'Live Bids', active: false },
    { icon: Heart, label: 'Favorites', active: false },
];
</script>

<template>
    <Head title="User Dashboard" />

    <div class="min-h-screen bg-slate-50 flex flex-col lg:flex-row">
        
        <header class="lg:hidden bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-50">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 p-1.5 rounded-lg text-white">
                    <Gavel :size="20" />
                </div>
                <span class="font-black tracking-tighter text-slate-900">AUTOBID</span>
            </div>
            <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="p-2 text-slate-600">
                <Menu v-if="!isMobileMenuOpen" />
                <X v-else />
            </button>
        </header>

        <aside :class="[isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0']" 
               class="fixed lg:sticky top-0 left-0 w-72 h-screen bg-white border-r border-slate-200 z-40 transition-transform duration-300 lg:duration-0 p-6 flex flex-col">
            
            <div class="hidden lg:flex items-center gap-3 mb-10 px-2">
                <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
                    <Gavel :size="24" />
                </div>
                <span class="font-black text-xl tracking-tighter text-slate-900">AUTOBID</span>
            </div>

            <nav class="flex-1 space-y-1">
                <Link v-for="item in navItems" :key="item.label" href="#" 
                      :class="[item.active ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900']"
                      class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold transition-all group">
                    <component :is="item.icon" :size="22" />
                    {{ item.label }}
                </Link>
            </nav>

            <div class="pt-6 border-t border-slate-100 space-y-1">
                <Link href="#" class="flex items-center gap-4 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-2xl font-bold transition">
                    <Settings :size="22" /> Settings
                </Link>
                <button class="w-full flex items-center gap-4 px-4 py-3.5 text-rose-500 hover:bg-rose-50 rounded-2xl font-bold transition">
                    <LogOut :size="22" /> Logout
                </button>
            </div>
        </aside>

        <main class="flex-1 p-4 md:p-8 lg:p-12 max-w-7xl mx-auto w-full">
            
            <div class="hidden lg:flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-black text-slate-900">Dashboard</h1>
                    <p class="text-slate-500 font-medium">Welcome back, Alex Rivera</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-3 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 transition">
                        <Bell :size="20" class="text-slate-600" />
                        <span class="absolute top-3 right-3 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="w-12 h-12 rounded-2xl bg-slate-200 overflow-hidden border-2 border-white shadow-sm">
                        <img src="https://i.pravatar.cc/150?u=alex" alt="Profile" />
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-6 mb-10">
                
                <div class="lg:col-span-2 bg-blue-600 rounded-[2.5rem] p-8 md:p-10 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
                    <div class="relative z-10">
                        <p class="text-blue-100 font-bold uppercase tracking-wider text-xs mb-2">Available Power</p>
                        <h2 class="text-4xl md:text-5xl font-black mb-8">$128,450.00</h2>
                        <div class="flex flex-wrap gap-3">
                            <button class="bg-white text-blue-600 px-6 py-3 rounded-xl font-black text-sm hover:bg-blue-50 transition shadow-lg">
                                Add Funds
                            </button>
                            <button class="bg-blue-500 text-white px-6 py-3 rounded-xl font-black text-sm hover:bg-blue-400 transition">
                                View History
                            </button>
                        </div>
                    </div>
                    <Wallet class="absolute -right-10 -bottom-10 text-white/10" :size="240" />
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div v-for="stat in stats" :key="stat.label" class="bg-white border border-slate-100 p-5 rounded-3xl flex items-center gap-5 shadow-sm hover:shadow-md transition">
                        <div :class="[stat.bg, stat.color]" class="p-4 rounded-2xl">
                            <component :is="stat.icon" :size="24" />
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs font-black uppercase tracking-widest">{{ stat.label }}</p>
                            <h4 class="text-xl font-black text-slate-900">{{ stat.value }}</h4>
                        </div>
                        <div class="ml-auto text-[10px] font-black bg-slate-50 px-2 py-1 rounded text-slate-500">
                            {{ stat.trend }}
                        </div>
                    </div>
                </div>
            </div>

            <section>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-slate-900">Current Bids</h3>
                    <Link href="#" class="text-sm font-bold text-blue-600 hover:underline">View All</Link>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div v-for="i in 2" :key="i" class="bg-white rounded-[2rem] p-4 border border-slate-100 flex flex-col sm:flex-row gap-6 hover:shadow-xl hover:shadow-slate-200/50 transition-all group">
                        <div class="w-full sm:w-48 h-40 rounded-[1.5rem] overflow-hidden shrink-0">
                            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                        </div>
                        <div class="flex-1 flex flex-col py-2">
                            <div class="flex justify-between items-start mb-auto">
                                <div>
                                    <h4 class="font-black text-lg text-slate-900">Porsche 911 Turbo S</h4>
                                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-tighter">Ends: 12h 45m 02s</p>
                                </div>
                                <div class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    Winning
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between border-t border-slate-50 pt-4">
                                <div>
                                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Current Bid</p>
                                    <p class="text-2xl font-black text-blue-600">$182,500</p>
                                </div>
                                <button class="p-3 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition shadow-lg shadow-slate-200 group-hover:-translate-y-1">
                                    <ArrowUpRight :size="20" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<style scoped>
/* Custom curve for a more "app-like" feel on mobile */
@media (max-width: 1024px) {
    aside {
        box-shadow: 20px 0 50px rgba(0,0,0,0.05);
    }
}
</style>