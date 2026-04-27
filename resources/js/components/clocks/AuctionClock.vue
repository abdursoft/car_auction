<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps({
  // Pass a future date string (e.g., "2026-12-31T23:59:59")
  endTime: {
    type: String,
    required: true
  }
});

const timeLeft = ref({
  days: 0,
  hours: 0,
  minutes: 0,
  seconds: 0,
  totalSeconds: 0
});

let timer = null;

const calculateTime = () => {
  const end = new Date(props.endTime).getTime();
  const now = new Date().getTime();
  const diff = end - now;

  if (diff <= 0) {
    timeLeft.value = { days: 0, hours: 0, minutes: 0, seconds: 0, totalSeconds: 0 };
    clearInterval(timer);
    
    return;
  }

  timeLeft.value = {
    days: Math.floor(diff / (1000 * 60 * 60 * 24)),
    hours: Math.floor((diff / (1000 * 60 * 60)) % 24),
    minutes: Math.floor((diff / 1000 / 60) % 60),
    seconds: Math.floor((diff / 1000) % 60),
    totalSeconds: Math.floor(diff / 1000)
  };
};

// Modern Strategy: Change UI color based on urgency
const urgencyClass = computed(() => {
  if (timeLeft.value.totalSeconds === 0) return 'text-slate-400'; // Ended
  if (timeLeft.value.totalSeconds < 3600) return 'text-red-600 animate-pulse'; // < 1 hour
  if (timeLeft.value.totalSeconds < 86400) return 'text-amber-500'; // < 1 day
  return 'text-slate-900'; // Plenty of time
});

onMounted(() => {
  calculateTime();
  timer = setInterval(calculateTime, 1000);
});

onUnmounted(() => {
  clearInterval(timer);
});

// Helper to format numbers to 2 digits
const format = (num) => num.toString().padStart(2, '0');
</script>

<template>
  <div class="flex flex-col items-center">
    <div :class="['flex gap-3 font-mono text-3xl font-black tracking-tighter transition-colors duration-500', urgencyClass]">
      
      <div v-if="timeLeft.days > 0" class="flex flex-col items-center bg-slate-50 rounded-xl">
        <span>{{ format(timeLeft.days) }}</span>
        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Days</span>
      </div>

      <span v-if="timeLeft.days > 0" class="pt-1 opacity-30">:</span>

      <div class="flex flex-col items-center bg-slate-50 rounded-xl">
        <span>{{ format(timeLeft.hours) }}</span>
        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Hrs</span>
      </div>

      <span class="pt-1 opacity-30">:</span>

      <div class="flex flex-col items-center">
        <span>{{ format(timeLeft.minutes) }}</span>
        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Min</span>
      </div>

      <span class="pt-1 opacity-30">:</span>

      <div class="flex flex-col items-center w-12">
        <span>{{ format(timeLeft.seconds) }}</span>
        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Sec</span>
      </div>
    </div>

    <div class="my-4">
      <span v-if="timeLeft.totalSeconds > 0" 
            :class="[
              'px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border',
              timeLeft.totalSeconds < 3600 ? 'bg-red-50 border-red-200 text-red-600' : 'bg-slate-50 border-slate-200 text-slate-500'
            ]">
        {{ timeLeft.totalSeconds < 3600 ? 'Ending Soon' : 'Active Auction' }}
      </span>
      <span v-else class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200">
        Auction Ended
      </span>
    </div>
  </div>
</template>