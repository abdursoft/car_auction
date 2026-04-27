<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  UserPlus, Search, Gavel, Truck, 
  ShieldCheck, CheckCircle2, ChevronRight, 
  PlayCircle, HelpCircle
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

const steps = [
    {
        id: '01',
        title: 'Join the Community',
        description: 'Create your account and verify your identity. We maintain a high-trust environment by ensuring all bidders are real people.',
        icon: UserPlus,
        color: 'text-blue-600',
        bg: 'bg-blue-50'
    },
    {
        id: '02',
        title: 'Find Your Dream Car',
        description: 'Browse our curated collection of rare and enthusiast vehicles. Use our deep-dive filters to find exactly what you’re looking for.',
        icon: Search,
        color: 'text-indigo-600',
        bg: 'bg-indigo-50'
    },
    {
        id: '03',
        title: 'Bid with Confidence',
        description: 'Place your bid manually or set a maximum bid. Our transparent history shows you every move in real-time.',
        icon: Gavel,
        color: 'text-purple-600',
        bg: 'bg-purple-50'
    },
    {
        id: '04',
        title: 'Close the Deal',
        description: 'If you win, our concierge team assists with the secure payment process and coordinates with the seller for a smooth transfer.',
        icon: Truck,
        color: 'text-emerald-600',
        bg: 'bg-emerald-50'
    }
];
</script>

<template>
    <Head title="How to Buy | The Guide" />

    <div class="bg-slate-50 min-h-screen">
        <section class="pt-24 pb-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block px-4 py-1.5 text-[10px] font-black tracking-[0.2em] text-blue-600 uppercase bg-blue-50 rounded-full mb-6">
                    The Collector's Guide
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-8">
                    Buying on <span class="text-blue-600">AutoBid</span>
                </h1>
                <p class="text-xl text-slate-500 leading-relaxed font-medium">
                    From the first bid to the first drive. We’ve redesigned the auction experience to be transparent, secure, and purely exhilarating.
                </p>
                
                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Link href="/register" class="w-full sm:w-auto bg-slate-900 text-white px-10 py-5 rounded-[2rem] font-black text-lg shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all active:scale-95">
                        Get Started Now
                    </Link>
                    <button class="flex items-center gap-2 font-black text-slate-600 hover:text-slate-900 transition p-4">
                        <PlayCircle :size="24" /> Watch the video guide
                    </button>
                </div>
            </div>
        </section>

        <section class="py-20 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                    <div v-for="step in steps" :key="step.id" 
                         class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                        
                        <div class="flex items-start justify-between mb-8">
                            <div :class="[step.bg, step.color]" class="w-16 h-16 rounded-[1.5rem] flex items-center justify-center shadow-inner">
                                <component :is="step.icon" :size="32" />
                            </div>
                            <span class="text-6xl font-black text-slate-100 group-hover:text-slate-50 transition-colors">
                                {{ step.id }}
                            </span>
                        </div>
                        
                        <h3 class="text-2xl font-black text-slate-900 mb-4">{{ step.title }}</h3>
                        <p class="text-slate-500 leading-relaxed font-medium mb-6">
                            {{ step.description }}
                        </p>
                        
                        <div class="flex items-center gap-2 text-blue-600 font-bold text-sm">
                            Learn more <ChevronRight :size="16" class="group-hover:translate-x-1 transition-transform" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-4">
            <div class="max-w-5xl mx-auto bg-slate-900 rounded-[4rem] p-10 md:p-20 relative overflow-hidden shadow-2xl shadow-blue-900/20">
                <div class="relative z-10 grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-black text-white tracking-tight mb-6">Bid with absolute <br/><span class="text-blue-400">peace of mind.</span></h2>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="shrink-0 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                    <CheckCircle2 :size="14" class="text-white" />
                                </div>
                                <p class="text-slate-400 font-medium leading-relaxed">
                                    <strong class="text-white">Escrow Protection:</strong> Funds are only released when both parties are satisfied.
                                </p>
                            </div>
                            <div class="flex gap-4">
                                <div class="shrink-0 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                    <CheckCircle2 :size="14" class="text-white" />
                                </div>
                                <p class="text-slate-400 font-medium leading-relaxed">
                                    <strong class="text-white">Identity Verification:</strong> Every bidder is vetted to prevent shill bidding.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[3rem] p-8 text-center">
                        <ShieldCheck :size="64" class="text-blue-400 mx-auto mb-6" />
                        <h4 class="text-white font-black text-xl mb-2">Buyer Protection Program</h4>
                        <p class="text-slate-400 text-sm font-medium mb-8">All auctions are backed by our $100,000 guarantee against fraud.</p>
                        <button class="w-full bg-white text-slate-900 py-4 rounded-2xl font-black hover:bg-blue-50 transition">
                            Read the Policy
                        </button>
                    </div>
                </div>

                <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl"></div>
            </div>
        </section>

        <section class="py-20 text-center px-4">
            <h3 class="text-2xl font-black text-slate-900 mb-2">Still have questions?</h3>
            <p class="text-slate-500 font-medium mb-8">Our concierge team is available 24/7 to guide you through the process.</p>
            <Link href="/contact" class="inline-flex items-center gap-2 bg-white border border-slate-200 px-8 py-4 rounded-2xl font-black text-slate-900 hover:border-blue-600 transition shadow-sm">
                <HelpCircle :size="20" class="text-blue-600" /> Visit Help Center
            </Link>
        </section>
    </div>
</template>