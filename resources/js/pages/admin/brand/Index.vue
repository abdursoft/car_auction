<script setup lang="ts">
import AdminLayout from '@/layout/Admin.vue';
import InventoryLayout from '@/layout/Inventory.vue';
import { MoreHorizontal, Edit, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';

defineOptions({ layout: AdminLayout });

const brands = ref([]);

const props = defineProps({
    brands: Array
});
</script>

<template>
    <InventoryLayout activeTab="categories">
        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm h-full">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 italic uppercase">Manage <span class="text-blue-600">Brands</span></h2>
                    <p class="text-slate-400 text-sm font-medium">Total {{ brands.length }} active manufacturers.</p>
                </div>
                <div class="flex gap-2">
                    <button class="p-3 bg-slate-50 rounded-xl text-slate-400 hover:text-slate-900 transition"><Filter :size="20" /></button>
                </div>
            </div>

            <table class="w-full">
                <thead>
                    <tr class="text-left">
                        <th class="pb-6 text-[10px] font-black uppercase tracking-widest text-slate-400 px-4">Brand</th>
                        <th class="pb-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Slug</th>
                        <th class="pb-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Models</th>
                        <th class="pb-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr v-for="brand in brands" :key="brand.id" class="group hover:bg-slate-50/50 transition">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center overflow-hidden border border-slate-200">
                                    <img :src="brand.logo_url" class="w-8 h-8 object-contain" />
                                </div>
                                <span class="font-black text-slate-900">{{ brand.name }}</span>
                            </div>
                        </td>
                        <td class="py-4 font-mono text-xs text-slate-400">{{ brand.slug }}</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-black">{{ brand.models_count || 0 }}</span>
                        </td>
                        <td class="py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 text-slate-300 hover:text-blue-600 transition"><Edit :size="18" /></button>
                                <button class="p-2 text-slate-300 hover:text-rose-600 transition"><Trash2 :size="18" /></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </InventoryLayout>
</template>