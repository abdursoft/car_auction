<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Camera, Tag, Hammer, Wallet, CheckCircle2, ArrowRight } from 'lucide-vue-next';
import App from '@/layout/App.vue';

defineOptions({
    layout: App,
});
</script>

<template>
  <Head title="How to Sell Your Car" />

  <div class="bg-slate-50 min-h-screen pb-20 overflow-hidden">
    <header class="relative bg-slate-900 py-32 px-6 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-24 w-80 h-80 bg-indigo-600/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-5xl mx-auto text-center animate-fade-in">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold tracking-wide text-blue-400 uppercase bg-blue-400/10 border border-blue-400/20 rounded-full">
                The Future of Car Auctions
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight">
                Turn your keys into <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Cash.</span>
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto leading-relaxed">
                A premium, transparent, and high-speed way to sell your vehicle to thousands of verified collectors and enthusiasts.
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6">
      <div class="relative -mt-20">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          
          <div class="group relative bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-white hover:border-blue-100 transition-all duration-500">
            <div class="mb-6 inline-flex p-4 rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
              <Camera :size="32" stroke-width="1.5" />
            </div>
            <div class="absolute top-8 right-8 text-5xl font-black text-slate-50 group-hover:text-blue-500 transition-colors">01</div>
            <h3 class="text-xl font-bold text-slate-900 mb-3">Snap & Detail</h3>
            <p class="text-slate-500 leading-relaxed">High-res photos tell the story. Show off the engine, interior, and those pristine wheels.</p>
          </div>

          <div class="group relative bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-white hover:border-green-100 transition-all duration-500 md:mt-8">
            <div class="mb-6 inline-flex p-4 rounded-2xl bg-green-50 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-500">
              <Tag :size="32" stroke-width="1.5" />
            </div>
            <div class="absolute top-8 right-8 text-5xl font-black text-slate-50 group-hover:text-green-500 transition-colors">02</div>
            <h3 class="text-xl font-bold text-slate-900 mb-3">Set Pricing</h3>
            <p class="text-slate-500 leading-relaxed">Set a reserve price or start at $1. You're in total control of the valuation process.</p>
          </div>

          <div class="group relative bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-white hover:border-purple-100 transition-all duration-500 lg:mt-16">
            <div class="mb-6 inline-flex p-4 rounded-2xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-500">
              <Hammer :size="32" stroke-width="1.5" />
            </div>
            <div class="absolute top-8 right-8 text-5xl font-black text-slate-50 group-hover:text-purple-500 transition-colors">03</div>
            <h3 class="text-xl font-bold text-slate-900 mb-3">Live Bidding</h3>
            <p class="text-slate-500 leading-relaxed">Watch the excitement build as verified bidders worldwide compete for your car.</p>
          </div>

          <div class="group relative bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-white hover:border-yellow-100 transition-all duration-500 md:mt-8 lg:mt-24">
            <div class="mb-6 inline-flex p-4 rounded-2xl bg-yellow-50 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-colors duration-500">
              <Wallet :size="32" stroke-width="1.5" />
            </div>
            <div class="absolute top-8 right-8 text-5xl font-black text-slate-50 group-hover:text-yellow-500 transition-colors">04</div>
            <h3 class="text-xl font-bold text-slate-900 mb-3">Secure Payout</h3>
            <p class="text-slate-500 leading-relaxed">Transaction closed. We ensure secure payment and help coordinate the pickup.</p>
          </div>

        </div>
      </div>

      <section class="mt-40 grid lg:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="absolute -z-10 top-0 left-0 w-full h-full bg-blue-600/5 rounded-full blur-3xl scale-150"></div>
            <div class="space-y-8">
                <h2 class="text-4xl font-black text-slate-900 leading-tight">We beat the <span class="text-blue-600">traditional</span> dealers.</h2>
                <p class="text-lg text-slate-600">Why sell to a dealer for "trade-in" value when you can sell to enthusiasts for "market" value?</p>
                
                <div class="space-y-4">
                    <div v-for="benefit in ['Industry leading 5% seller fee', '0% Listing fees for premium members', 'Full concierge support for paperwork', 'Global reach to 100k+ monthly users']" :key="benefit" 
                         class="flex items-center gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm transition-transform hover:scale-[1.02]">
                        <CheckCircle2 class="text-blue-600" :size="20" />
                        <span class="font-bold text-slate-700">{{ benefit }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative">
            <div class="absolute top-10 left-10 z-10 bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-2xl border border-white/50 animate-bounce-slow">
                <p class="text-slate-500 text-sm font-bold uppercase">Avg. Sale Price</p>
                <p class="text-3xl font-black text-slate-900">$42,850</p>
                <div class="mt-2 text-green-600 font-bold text-sm">↑ 12% vs last month</div>
            </div>
            <img src="https://images.unsplash.com/photo-1614200187524-dc4b892acf16?auto=format&fit=crop&w=1000&q=80" 
                 alt="Car Detail" 
                 class="rounded-[2.5rem] shadow-2xl object-cover h-[500px] w-full hover:scale-[1.04] transition-all" />
        </div>
      </section>

      <div class="mt-40 relative bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/30 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-600/30 rounded-full blur-[100px]"></div>
        
        <div class="relative z-10">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-8 leading-tight">Ready to start your <br> first auction?</h2>
            <Link href="/auctions/create" 
                  class="group inline-flex items-center gap-3 bg-blue-600 text-white px-10 py-5 rounded-full font-black text-xl hover:bg-white hover:text-blue-600 transition-all duration-300 shadow-2xl shadow-blue-500/20">
                List My Car Now
                <ArrowRight class="group-hover:translate-x-2 transition-transform" />
            </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>