<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ShieldCheck, CreditCard, UserCheck, AlertCircle, CheckCircle2, ChevronRight } from 'lucide-vue-next';
import App from '@/layouts/App.vue';
defineOptions({ layout: App });
</script>

<template>
    <div class="min-h-screen bg-slate-50 p-6 md:p-12">
        <div class="max-w-3xl mx-auto">
            <header class="mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-2">Trust & Verification</h1>
                <p class="text-slate-500 font-medium">Complete these steps to unlock bidding and listing privileges.</p>
            </header>

            <div class="space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-start gap-6">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                        <UserCheck :size="28" />
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-black text-slate-900">Identity Verification</h3>
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase">Required</span>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">We use Stripe Identity to securely verify your government ID. This prevents shill bidding and fraud.</p>
                        <button class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-sm hover:bg-blue-600 transition shadow-lg shadow-slate-200">
                            Begin ID Verification
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-start gap-6">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shrink-0">
                        <CreditCard :size="28" />
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-black text-slate-900">Payment Method</h3>
                            <span class="flex items-center gap-1 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase">
                                <CheckCircle2 :size="12" /> Verified
                            </span>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-6 bg-slate-900 rounded flex items-center justify-center text-[8px] text-white font-bold">VISA</div>
                                <span class="text-sm font-bold text-slate-700">•••• 4242</span>
                            </div>
                            <button class="text-blue-600 text-xs font-black uppercase tracking-widest">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>