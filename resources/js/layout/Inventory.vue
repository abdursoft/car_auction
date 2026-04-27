<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { 
  Tags, 
  Layers, 
  Boxes, 
  Settings2, 
  Plus, 
  Search,
  Filter
} from 'lucide-vue-next';

const props = defineProps({
    activeTab: String // 'brands', 'models', 'categories'
});
</script>

<template>
    <div class="flex h-full gap-6 animate-in fade-in slide-in-from-left-4 duration-500">
        
        <aside class="w-80 shrink-0 flex flex-col gap-6">
            
            <div class="bg-blue-600 rounded-[2.5rem] p-8 text-white shadow-xl shadow-blue-200 relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-xl font-black italic uppercase tracking-tighter mb-1">Inventory</h3>
                    <p class="text-blue-100 text-[10px] font-bold uppercase tracking-widest mb-6">Database Management</p>
                    <Link href="route('admin.brands.create')" class="flex items-center justify-center gap-2 bg-white text-blue-600 w-full py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-lg">
                        <Plus :size="16" /> Add New Item
                    </Link>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-all duration-700"></div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-4 border border-slate-100 shadow-sm flex-1">
                <div class="p-4">
                    <div class="relative">
                        <Search class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" :size="14" />
                        <input type="text" placeholder="Quick filter..." class="w-full bg-slate-50 border-none rounded-xl py-2.5 pl-10 pr-4 text-[11px] font-bold outline-none focus:ring-2 focus:ring-blue-600/10 transition" />
                    </div>
                </div>

                <nav class="space-y-1">
                    <Link href="route('admin.brands.index')" 
                          :class="activeTab === 'brands' ? 'sub-nav-active' : 'sub-nav-inactive'">
                        <Tags :size="18" />
                        <div class="flex-1">
                            <p class="text-sm font-black">Brands</p>
                            <p class="text-[10px] opacity-60">Manufacturers & Logos</p>
                        </div>
                        <ChevronRight v-if="activeTab === 'brands'" :size="14" />
                    </Link>

                    <Link href="route('admin.models.index')" 
                          :class="activeTab === 'models' ? 'sub-nav-active' : 'sub-nav-inactive'">
                        <Layers :size="18" />
                        <div class="flex-1">
                            <p class="text-sm font-black">Vehicle Models</p>
                            <p class="text-[10px] opacity-60">Series & Generations</p>
                        </div>
                        <ChevronRight v-if="activeTab === 'models'" :size="14" />
                    </Link>

                    <Link href="route('admin.categories.index')" 
                          :class="activeTab === 'categories' ? 'sub-nav-active' : 'sub-nav-inactive'">
                        <Boxes :size="18" />
                        <div class="flex-1">
                            <p class="text-sm font-black">Body Styles</p>
                            <p class="text-[10px] opacity-60">Categories & Segments</p>
                        </div>
                        <ChevronRight v-if="activeTab === 'categories'" :size="14" />
                    </Link>
                </nav>

                <div class="mt-8 px-4">
                    <div class="h-[1px] bg-slate-50 w-full mb-6"></div>
                    <div class="flex items-center justify-between text-slate-400 mb-4">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Bulk Tools</span>
                        <Settings2 :size="14" />
                    </div>
                    <button class="w-full text-left flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-blue-600 font-bold text-xs transition">
                        <div class="w-2 h-2 rounded-full bg-slate-200"></div> Import CSV Data
                    </button>
                    <button class="w-full text-left flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-rose-600 font-bold text-xs transition">
                        <div class="w-2 h-2 rounded-full bg-slate-200"></div> Export Inventory
                    </button>
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <slot />
        </div>
    </div>
</template>

<style scoped>
@reference "tailwindcss";

.sub-nav-inactive {
    @apply flex items-center gap-4 p-4 rounded-3xl text-slate-400 transition-all hover:bg-slate-50 hover:text-slate-900;
}

.sub-nav-active {
    @apply flex items-center gap-4 p-4 rounded-3xl bg-blue-50 text-blue-600 shadow-sm shadow-blue-100;
}
</style>