<script setup>
import { useForm } from '@inertiajs/vue3';
import { Plus, Trash2, Edit3 } from 'lucide-vue-next';
import Admin from '@/layouts/Admin.vue';

defineOptions({ layout: Admin})
const props = defineProps({
    categories: Array,
    parentCategories: Array
});

const form = useForm({
    name: '',
    parent_id: '',
    icon: 'Car',
    order: 0
});

const submit = () => {
    form.post('/home', {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
  <AdminLayout>
    <div class="max-w-6xl mx-auto">
      <header class="flex justify-between items-center mb-10">
        <div>
          <h2 class="text-3xl font-black text-slate-900 tracking-tight">Categories</h2>
          <p class="text-slate-500">Organize your vehicle listings by type.</p>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-1">
          <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold mb-6">Create Category</h3>
            <form @submit.prevent="submit" class="space-y-4">
              <div>
                <label class="text-xs font-black uppercase text-slate-400 mb-1 block">Name</label>
                <input v-model="form.name" type="text" placeholder="e.g. Electric Supercars"
                       class="w-full rounded-xl border-slate-200 focus:ring-indigo-500" />
                <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
              </div>

              <div>
                <label class="text-xs font-black uppercase text-slate-400 mb-1 block">Parent Category</label>
                <select v-model="form.parent_id" class="w-full rounded-xl border-slate-200">
                  <option value="">None (Top Level)</option>
                  <option v-for="cat in parentCategories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                </select>
              </div>

              <button :disabled="form.processing" class="w-full py-4 bg-indigo-600 text-white rounded-xl font-bold flex items-center justify-center gap-2">
                <Plus :size="18" /> Save Category
              </button>
            </form>
          </div>
        </div>

        <div class="lg:col-span-2">
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left">
              <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                  <th class="px-6 py-4 text-xs font-black uppercase text-slate-400">Name</th>
                  <th class="px-6 py-4 text-xs font-black uppercase text-slate-400">Parent</th>
                  <th class="px-6 py-4 text-xs font-black uppercase text-slate-400 text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="cat in categories" :key="cat.id" class="hover:bg-slate-50 transition">
                  <td class="px-6 py-4 font-bold text-slate-700">{{ cat.name }}</td>
                  <td class="px-6 py-4">
                    <span v-if="cat.parent" class="px-3 py-1 bg-slate-100 rounded-full text-xs font-medium text-slate-500">
                      {{ cat.parent.name }}
                    </span>
                    <span v-else class="text-slate-300 text-xs">—</span>
                  </td>
                  <td class="px-6 py-4 text-right space-x-2">
                    <button class="p-2 text-slate-400 hover:text-indigo-600 transition"><Edit3 :size="18" /></button>
                    <button class="p-2 text-slate-400 hover:text-red-600 transition"><Trash2 :size="18" /></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>