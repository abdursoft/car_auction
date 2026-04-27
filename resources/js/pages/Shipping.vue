<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Truck, MapPin, Info, ArrowRight, ShieldCheck } from 'lucide-vue-next';
import App from '@/layout/App.vue';
defineOptions({ layout: App });
</script>

<template>
    <div class="min-h-screen bg-slate-50 p-6 md:p-12">
        <div class="max-w-5xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
                    <Truck class="text-blue-600 mb-6" :size="40" />
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-4">Shipping Quote</h2>
                    <p class="text-slate-500 font-medium mb-10">Get an instant estimate for open or enclosed transport across the continental US.</p>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Origin Zip</label>
                                <input type="text" placeholder="90210" class="w-full p-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Destination Zip</label>
                                <input type="text" placeholder="10001" class="w-full p-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-2">Transport Type</label>
                            <div class="grid grid-cols-2 gap-4">
                                <button class="p-4 border-2 border-blue-600 bg-blue-50 rounded-2xl font-black text-blue-600">Open Carrier</button>
                                <button class="p-4 border-2 border-slate-100 bg-white rounded-2xl font-black text-slate-400">Enclosed</button>
                            </div>
                        </div>

                        <button class="w-full bg-slate-900 text-white py-5 rounded-[2rem] font-black text-lg hover:bg-blue-600 transition shadow-xl">
                            Calculate Estimate
                        </button>
                    </div>
                </div>

                <div class="lg:pt-12 space-y-8">
                    <div v-for="benefit in ['Fully Insured Carriers', 'Door-to-Door Delivery', 'Real-time GPS Tracking']" :key="benefit" class="flex gap-4">
                        <div class="shrink-0 w-8 h-8 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center">
                            <ShieldCheck :size="18" />
                        </div>
                        <p class="text-lg font-black text-slate-900">{{ benefit }}</p>
                    </div>
                    <div class="p-8 bg-blue-600 rounded-[2.5rem] text-white">
                        <h4 class="font-black text-xl mb-2">Concierge Support</h4>
                        <p class="text-blue-100 text-sm leading-relaxed">Winning an auction is exciting—getting it home shouldn't be stressful. We handle the paperwork with the carrier.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>