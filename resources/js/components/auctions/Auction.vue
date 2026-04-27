<script setup>
import { ref } from 'vue';
import AuctionClock from '../clocks/AuctionClock.vue';
import Share from '../modals/Share.vue';
const isShareModalOpen = ref(false);
</script>

<template>
    <!-- partial auction details page with large image, description, and bidding sidebar  -->
    <main class="mx-auto max-w-7xl px-4 py-8">
        <div class="mb-6 flex flex-col items-end justify-between gap-4 md:flex-row">
            <div>
                <nav class="mb-2 text-xs font-bold tracking-widest text-indigo-600 uppercase">
                    Auctions / Porsche
                </nav>
                <h1 class="text-4xl font-black tracking-tight text-slate-900">
                    2023 Porsche 911 GT3 RS
                </h1>
                <p class="mt-1 text-lg text-slate-500">
                    4.0L H6, 7-Speed PDK, Weissach Package
                </p>
            </div>
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 rounded-xl border border-slate-200 px-6 py-3 font-bold transition-all hover:bg-slate-50">
                    <span>♡</span> Watch
                </button>
                <button
                    @click="isShareModalOpen = true"
                    class="rounded-xl bg-slate-900 px-6 py-3 font-bold text-white transition-all hover:bg-slate-800">
                    Share
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-8 lg:col-span-2">
                <div class="grid h-[500px] grid-cols-4 grid-rows-2 gap-2 overflow-hidden rounded-3xl">
                    <div class="group relative col-span-3 row-span-2 cursor-zoom-in">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-black/10 transition-all group-hover:bg-transparent"></div>
                    </div>
                    <div class="col-span-1 row-span-1">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600"
                            class="h-full w-full object-cover" />
                    </div>
                    <div class="relative col-span-1 row-span-1">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600"
                            class="h-full w-full object-cover" />
                        <div
                            class="absolute inset-0 flex cursor-pointer items-center justify-center bg-black/50 font-bold text-white transition-all hover:bg-black/40">
                            +42 Photos
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-6 md:grid-cols-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Mileage
                        </p>
                        <p class="font-bold text-slate-800">1,240 mi</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Engine
                        </p>
                        <p class="font-bold text-slate-800">4.0L Flat-6</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Drivetrain
                        </p>
                        <p class="font-bold text-slate-800">RWD</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Transmission
                        </p>
                        <p class="font-bold text-slate-800">7-Speed PDK</p>
                    </div>
                </div>

                <div class="prose prose-slate max-w-none">
                    <h3 class="text-xl font-bold">Seller's Description</h3>
                    <p class="leading-relaxed text-slate-600">
                        This 2023 Porsche 911 GT3 RS is finished in GT Silver
                        Metallic over Black leather and Race-Tex upholstery...
                    </p>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <div class="rounded-3xl border-2 border-indigo-600 bg-white p-6 shadow-2xl shadow-indigo-100">
                        <div class="mb-6 flex items-center justify-between">
                            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700">LIVE
                                AUCTION</span>
                            <span class="text-sm font-medium text-slate-500">128 Bids</span>
                        </div>

                        <div class="mb-6 space-y-1 text-center">
                            <p class="text-xs font-bold tracking-widest text-slate-500 uppercase">
                                Current Bid
                            </p>
                            <h2 class="text-5xl font-black text-slate-900">
                                $182,500
                            </h2>
                        </div>

                        <AuctionClock :endTime="'2026-04-19T05:35:00'" />

                        <button
                            class="mb-4 w-full rounded-2xl bg-indigo-600 py-4 font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700">
                            Place Bid
                        </button>

                        <p class="text-center text-[11px] font-bold tracking-tight text-slate-400 uppercase">
                            Bid increments: $500 • No reserve
                        </p>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6">
                        <h4 class="mb-4 font-bold text-slate-900">
                            Latest Bids
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-50 pb-2 text-sm">
                                <span class="font-bold text-slate-700">PorscheCollector99</span>
                                <span class="font-mono font-bold text-indigo-600">$182,500</span>
                            </div>
                            <div class="flex items-center justify-between text-sm opacity-60">
                                <span class="font-medium text-slate-700">Flat6Lover</span>
                                <span class="font-mono font-bold">$182,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Share 
            :show="isShareModalOpen" 
            url="https://abdursoft.com/auctions/123" 
            title="2023 Lamborghini Huracán"
            @close="isShareModalOpen = false"
        />
    </main>
</template>
