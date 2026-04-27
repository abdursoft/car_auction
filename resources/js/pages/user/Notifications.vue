<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Bell, Gavel, Mail, CreditCard, Clock, Circle } from 'lucide-vue-next';
import App from '@/layout/App.vue';
defineOptions({ layout: App });

const notifications = [
    { id: 1, type: 'bid', title: 'You’ve been outbid!', body: 'Someone just placed a higher bid on the 1994 Toyota Supra.', time: '2m ago', unread: true, icon: Gavel, color: 'text-rose-600', bg: 'bg-rose-50' },
    { id: 2, type: 'payment', title: 'Payment Successful', body: 'Your deposit for Auction #442 has been confirmed.', time: '1h ago', unread: false, icon: CreditCard, color: 'text-emerald-600', bg: 'bg-emerald-50' },
    { id: 3, type: 'auction', title: 'Auction Ending Soon', body: 'The 2021 Porsche 911 GT3 in your watchlist ends in 30 minutes.', time: '3h ago', unread: false, icon: Clock, color: 'text-blue-600', bg: 'bg-blue-50' },
];
</script>

<template>
    <div class="min-h-screen bg-slate-50 p-6 md:p-12">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Notifications</h1>
                <button class="text-xs font-black uppercase text-blue-600 tracking-widest hover:underline">Mark all as read</button>
            </div>

            <div class="space-y-3">
                <div v-for="note in notifications" :key="note.id" 
                     :class="note.unread ? 'bg-white border-blue-100' : 'bg-slate-50/50 border-transparent'"
                     class="group p-6 rounded-[2rem] border transition-all hover:shadow-md flex items-center gap-6">
                    
                    <div :class="[note.bg, note.color]" class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0">
                        <component :is="note.icon" :size="20" />
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h4 class="font-black text-slate-900">{{ note.title }}</h4>
                            <Circle v-if="note.unread" :size="8" class="fill-blue-600 text-blue-600" />
                        </div>
                        <p class="text-slate-500 text-sm font-medium">{{ note.body }}</p>
                        <p class="text-[10px] font-black text-slate-400 uppercase mt-2">{{ note.time }}</p>
                    </div>

                    <button class="opacity-0 group-hover:opacity-100 transition p-2 text-slate-300 hover:text-slate-900">
                        <ChevronRight :size="20" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>