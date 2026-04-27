<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
  Zap, 
  Target, 
  ShieldCheck, 
  TrendingUp, 
  MousePointer2,
  Clock,
  CheckCircle2,
  AlertTriangle
} from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({ layout: App });

const bidTypes = [
    {
        title: 'Instant Bidding',
        description: 'Increase the current price by a set increment (e.g., $500) with a single click. Best for keeping momentum in live auctions.',
        icon: Zap,
        color: 'text-amber-500',
        bg: 'bg-amber-50'
    },
    {
        title: 'Proxy Bidding',
        description: 'Set your maximum price. Our system will automatically bid on your behalf, in the smallest increments possible, to keep you in the lead.',
        icon: Target,
        color: 'text-blue-600',
        bg: 'bg-blue-50'
    }
];
</script>

<template>
    <Head title="How to Bid | Auction Strategies" />

    <div class="bg-slate-50 min-h-screen">
        <section class="pt-24 pb-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-8">
                    Master the <span class="text-blue-600">Auction.</span>
                </h1>
                <p class="text-xl text-slate-500 leading-relaxed font-medium">
                    Whether you're a seasoned collector or a first-time bidder, understanding our bidding mechanics is the key to securing your next vehicle.
                </p>
            </div>
        </section>

        <section class="py-12 px-4">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8">
                <div v-for="type in bidTypes" :key="type.title" 
                     class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm transition-all hover:shadow-xl group">
                    <div :class="[type.bg, type.color]" class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                        <component :is="type.icon" :size="32" />
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4">{{ type.title }}</h3>
                    <p class="text-slate-500 leading-relaxed mb-6">{{ type.description }}</p>
                    <div class="h-1 w-20 bg-slate-100 rounded-full group-hover:bg-blue-600 transition-colors"></div>
                </div>
            </div>
        </section>

        <section class="py-20 px-4">
            <div class="max-w-5xl mx-auto bg-white rounded-[4rem] border border-slate-100 p-8 md:p-16 shadow-2xl shadow-slate-200/50 flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                        <Clock :size="14" /> Fair Play Rule
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight leading-none">The 2-Minute <br/><span class="text-blue-600">Extension.</span></h2>
                    <p class="text-slate-500 font-medium leading-relaxed">
                        To prevent "sniping" in the final seconds, any bid placed within the last 2 minutes of an auction will automatically reset the countdown clock back to 2 minutes. This ensures every bidder has a fair chance to react.
                    </p>
                    <ul class="space-y-3">
                        <li v-for="text in ['No last-second software bots', 'Real-time competitive fairness', 'Ample time for counter-bids']" :key="text" class="flex items-center gap-3 text-sm font-bold text-slate-700">
                            <CheckCircle2 :size="18" class="text-emerald-500" /> {{ text }}
                        </li>
                    </ul>
                </div>
                <div class="lg:w-1/2 bg-slate-50 rounded-[3rem] p-8 border border-slate-100">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-[10px] font-black uppercase text-slate-400">
                            <span>Auction Timeline</span>
                            <span class="text-rose-500">Bid Placed!</span>
                        </div>
                        <div class="h-4 w-full bg-slate-200 rounded-full overflow-hidden relative">
                            <div class="absolute inset-y-0 left-0 w-[85%] bg-blue-600"></div>
                            <div class="absolute inset-y-0 right-0 w-[15%] bg-rose-500 animate-pulse"></div>
                        </div>
                        <p class="text-center text-xs font-bold text-slate-400 mt-4 italic">
                            "Clock resets to 02:00 whenever a new high bid is confirmed."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-4 max-w-6xl mx-auto">
            <h2 class="text-3xl font-black text-slate-900 text-center mb-12 italic">Bidding Strategies</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white">
                    <TrendingUp class="text-blue-400 mb-4" :size="32" />
                    <h4 class="font-black text-xl mb-2">Bid Early</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Establishing your presence early shows other bidders you are serious about the vehicle.</p>
                </div>
                <div class="p-8 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm">
                    <AlertTriangle class="text-amber-500 mb-4" :size="32" />
                    <h4 class="font-black text-xl mb-2 text-slate-900">Set a Limit</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Determine your maximum "out-the-door" price before the final minutes to avoid emotional overbidding.</p>
                </div>
                <div class="p-8 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm">
                    <MousePointer2 class="text-indigo-600 mb-4" :size="32" />
                    <h4 class="font-black text-xl mb-2 text-slate-900">Use Max Bid</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Our proxy system will never bid more than necessary to keep you in the lead.</p>
                </div>
            </div>
        </section>

        <section class="py-20 text-center px-4">
            <div class="bg-blue-600 rounded-[4rem] max-w-4xl mx-auto p-12 md:p-20 text-white shadow-2xl shadow-blue-200">
                <h2 class="text-4xl font-black mb-6">Ready to join the hunt?</h2>
                <p class="text-blue-100 text-lg mb-10 max-w-md mx-auto">Browse live auctions and place your first bid with complete transparency.</p>
                <Link href="/auctions" class="bg-white text-blue-600 px-12 py-5 rounded-2xl font-black text-xl hover:bg-blue-50 transition shadow-xl">
                    Explore Auctions
                </Link>
            </div>
        </section>
    </div>
</template>