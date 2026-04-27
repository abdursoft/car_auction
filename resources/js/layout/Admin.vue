<script setup lang="ts">
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import { 
  LayoutDashboard, Gavel, Car, Users, 
  Settings, Bell, Search, LogOut,
  ChevronRight, TrendingUp, ShieldCheck, 
  PlusCircle, Database
} from 'lucide-vue-next';
import { route } from 'ziggy-js';

const isSidebarOpen = ref(true);
</script>

<template>
  <div class="min-h-screen bg-[#F8FAFC] flex">
    <Head title="Admin Dashboard" />

    <aside class="w-72 bg-slate-900 m-4 rounded-[2.5rem] flex flex-col shadow-2xl shadow-slate-900/20 sticky h-[calc(100vh-2rem)] top-4">
      <div class="p-8">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/40">
            <ShieldCheck class="text-white" :size="22" />
          </div>
          <span class="text-xl font-black text-white italic uppercase tracking-tighter">
            Auto<span class="text-blue-500">Admin</span>
          </span>
        </div>
      </div>

      <nav class="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 ml-4">Management</div>
        
        <Link href="route('admin.dashboard')" 
              :class="$page.component === 'Admin/Dashboard' ? 'nav-link-active' : 'nav-link-inactive'">
          <LayoutDashboard :size="20" /> <span>Dashboard</span>
        </Link>

        <Link href="route('admin.auctions.index')" 
              class="nav-link-inactive group">
          <Gavel :size="20" /> <span>Live Auctions</span>
          <span class="ml-auto bg-blue-500/20 text-blue-400 text-[10px] px-2 py-0.5 rounded-full group-hover:bg-blue-500 group-hover:text-white transition">12</span>
        </Link>

        <Link href="route('admin.brands.index')" class="nav-link-inactive">
          <Car :size="20" /> <span>Inventory & Brands</span>
        </Link>

        <Link href="route('admin.users.index')" class="nav-link-inactive">
          <Users :size="20" /> <span>Manage Users</span>
        </Link>

        <div class="pt-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 ml-4">System</div>

        <Link href="#" class="nav-link-inactive">
          <Database :size="20" /> <span>Site Logs</span>
        </Link>

        <Link href="#" class="nav-link-inactive">
          <Settings :size="20" /> <span>Settings</span>
        </Link>
      </nav>

      <div class="p-4 mt-auto border-t border-slate-800">
        <div class="bg-slate-800/50 p-4 rounded-3xl flex items-center gap-3 border border-slate-700/50">
          <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff" class="w-10 h-10 rounded-xl" />
          <div class="flex-1">
            <p class="text-xs font-black text-white truncate">Super Admin</p>
            <p class="text-[10px] text-slate-500 font-bold">Main Office</p>
          </div>
          <Link href="route('logout')" method="post" as="button" class="text-slate-500 hover:text-rose-500 transition">
            <LogOut :size="18" />
          </Link>
        </div>
      </div>
    </aside>

    <main class="flex-1 p-4 md:p-8 overflow-y-auto">
      <header class="flex items-center justify-between mb-10">
        <div class="relative w-96">
          <Search class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" :size="18" />
          <input type="text" placeholder="Search for VIN, User, or Auction..." 
                 class="w-full bg-white border-none rounded-2xl py-3 pl-12 pr-4 text-sm font-medium shadow-sm focus:ring-2 focus:ring-blue-600 transition" />
        </div>

        <div class="flex items-center gap-4">
          <button class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 hover:text-blue-600 shadow-sm transition relative">
            <Bell :size="20" />
            <span class="absolute top-3 right-3 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
          </button>
          
          <Link href="route('auctions.create')" 
                class="bg-blue-600 hover:bg-slate-900 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest flex items-center gap-2 shadow-xl shadow-blue-200 transition-all">
            <PlusCircle :size="16" /> New Auction
          </Link>
        </div>
      </header>

      <slot />
    </main>
  </div>
</template>

<style scoped>
@reference "tailwindcss";

.nav-link-inactive {
  @apply flex items-center gap-3 px-4 py-3.5 rounded-2xl text-slate-400 font-bold text-sm transition-all hover:bg-slate-800 hover:text-white;
}

.nav-link-active {
  @apply flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-blue-600 text-white font-black text-sm shadow-xl shadow-blue-500/20 transition-all;
}

.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  @apply bg-slate-800 rounded-full;
}
</style>