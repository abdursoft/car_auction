<script setup lang="ts">
import { 
  X, 
  Copy, 
  Check, 
  Facebook, 
  Instagram, 
  Linkedin, 
  MessageCircle, 
  Send
} from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps({
  show: Boolean,
  url: String,
  title: String
});

const emit = defineEmits(['close']);
const copied = ref(false);

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(props.url);
    copied.ref = true;
    setTimeout(() => (copied.value = false), 2000);
  } catch (err) {
    console.error('Failed to copy', err);
  }
};

const platforms = [
  { name: 'WhatsApp', icon: MessageCircle, color: 'text-emerald-500', bg: 'bg-emerald-50', link: `https://wa.me/?text=${props.title} ${props.url}` },
  { name: 'Facebook', icon: Facebook, color: 'text-blue-600', bg: 'bg-blue-50', link: `https://www.facebook.com/sharer/sharer.php?u=${props.url}` },
  { name: 'X (Twitter)', icon: X, color: 'text-slate-900', bg: 'bg-slate-100', link: `https://twitter.com/intent/tweet?text=${props.title}&url=${props.url}` },
  { name: 'LinkedIn', icon: Linkedin, color: 'text-blue-700', bg: 'bg-blue-50', link: `https://www.linkedin.com/sharing/share-offsite/?url=${props.url}` }
];
</script>

<template>
  <div v-if="show" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div @click="$emit('close')" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

    <div class="relative bg-white w-full max-w-md rounded-[3rem] shadow-2xl border border-white overflow-hidden animate-in fade-in zoom-in duration-300">
      
      <button @click="$emit('close')" class="absolute top-6 right-6 p-2 text-slate-400 hover:text-slate-900 transition">
        <X :size="20" />
      </button>

      <div class="p-8">
        <h3 class="text-2xl font-black text-slate-900 tracking-tighter mb-2">Share Auction</h3>
        <p class="text-slate-500 text-sm font-medium mb-8">Share this {{ title }} with your circle.</p>

        <div class="grid grid-cols-3 gap-4 mb-8">
          <a v-for="social in platforms" 
             :key="social.name" 
             :href="social.link" 
             target="_blank"
             class="flex flex-col items-center justify-center p-4 rounded-3xl transition-all duration-300 hover:scale-105 active:scale-95 group">
            <div :class="[social.bg, social.color]" class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3 shadow-inner group-hover:shadow-lg transition-all">
              <component :is="social.icon" :size="24" />
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">{{ social.name }}</span>
          </a>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Direct Link</label>
          <div class="relative flex items-center">
            <input 
              type="text" 
              readonly 
              :value="url" 
              class="w-full bg-slate-50 border-none rounded-2xl py-4 pl-6 pr-16 font-bold text-sm text-slate-600"
            />
            <button 
              @click="copyLink" 
              class="absolute right-2 p-3 bg-white rounded-xl shadow-sm border border-slate-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-all active:scale-90"
            >
              <Check v-if="copied" :size="18" />
              <Copy v-else :size="18" />
            </button>
          </div>
        </div>
      </div>

      <div class="bg-slate-50 px-8 py-4 flex items-center justify-center gap-2">
        <span class="text-[10px] font-black uppercase tracking-tighter text-slate-400">Powered by</span>
        <span class="text-xs font-black text-blue-600 tracking-tighter">AutoBid Concierge</span>
      </div>
    </div>
  </div>
</template>