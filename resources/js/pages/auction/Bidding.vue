<script setup>
import HomeLayout from '@/layouts/App.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
    layout: HomeLayout
})
const activeImage = ref('img1');

</script>

<template>
    <div>
        <Head title="Bidding Description" />
        <div class="bg-white border-b border-slate-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex text-sm font-medium text-slate-500">
                    <a href="/" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/auctions" class="hover:text-blue-600">Auctions</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-900">2023 Porsche 911 GT3</span>
                </nav>
            </div>
        </div>

        <main class="py-10 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div x-data="{ activeImage: 'img1' }" class="bg-white p-4 rounded-3xl shadow-sm border border-slate-200">
                            <div class="aspect-video rounded-2xl overflow-hidden bg-slate-100 mb-4">
                                <img v-show="activeImage === 'img1'" src="https://images.unsplash.com/photo-1614200024993-215600644155?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover">
                                <img v-show="activeImage === 'img2'" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover" x-cloak>
                                <img v-show="activeImage === 'img3'" src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover" x-cloak>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <button @click="activeImage = 'img1'" :class="activeImage === 'img1' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                                    <img src="https://images.unsplash.com/photo-1614200024993-215600644155?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                                </button>
                                <button @click="activeImage = 'img2'" :class="activeImage === 'img2' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                                </button>
                                <button @click="activeImage = 'img3'" :class="activeImage === 'img3' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                                    <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                                </button>
                                <div class="relative rounded-lg overflow-hidden h-24 bg-slate-900 flex items-center justify-center text-white font-bold cursor-pointer hover:bg-slate-800 transition">
                                    <span>+12 Photos</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                            <h2 class="text-2xl font-bold mb-6">Vehicle Specifications</h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-4">
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Engine</p>
                                    <p class="text-slate-900 font-bold">4.0L Flat-6</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Transmission</p>
                                    <p class="text-slate-900 font-bold">7-Speed PDK</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Mileage</p>
                                    <p class="text-slate-900 font-bold">1,245 mi</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Drive Type</p>
                                    <p class="text-slate-900 font-bold">RWD</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Exterior Color</p>
                                    <p class="text-slate-900 font-bold">Shark Blue</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Interior Color</p>
                                    <p class="text-slate-900 font-bold">Black / Blue Stitch</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">VIN</p>
                                    <p class="text-slate-900 font-bold">WP0AA2A9XPS2...</p>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Location</p>
                                    <p class="text-slate-900 font-bold">Miami, FL</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                            <h2 class="text-2xl font-bold mb-4">Auction Description</h2>
                            <article class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                                <p>This 2023 Porsche 911 GT3 is finished in Shark Blue over a Black leather and Race-Tex interior. Powered by a 4.0-liter flat-six paired with a seven-speed PDK dual-clutch transaxle, features include the Chrono Package, a front-axle lift system, and LED headlights in black...</p>
                                <ul class="list-disc pl-5 mt-4 space-y-2">
                                    <li>Clean CARFAX Report</li>
                                    <li>Ceramic Composite Brakes (PCCB)</li>
                                    <li>Full Front PPF (Paint Protection Film)</li>
                                </ul>
                            </article>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-200 sticky top-24">
                            <div class="mb-6">
                                <h1 class="text-3xl font-black text-slate-900 mb-2">2023 Porsche 911 GT3</h1>
                                <div class="flex items-center gap-2">
                                    <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">PREMIUM</span>
                                    <span class="text-slate-400 text-sm">Listing #44029</span>
                                </div>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-6 mb-6">
                                <div class="flex justify-between items-end mb-4">
                                    <div>
                                        <p class="text-slate-500 text-sm font-medium">Current Bid</p>
                                        <p class="text-4xl font-black text-blue-600">$185,500</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-slate-500 text-sm font-medium">Time Left</p>
                                        <p class="text-xl font-bold text-red-600">02:45:12</p>
                                    </div>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                                    <input type="number" placeholder="Enter amount" class="w-full bg-white border-2 border-slate-100 p-4 pl-8 rounded-xl focus:border-blue-600 outline-none transition font-bold text-lg">
                                </div>
                                <button class="w-full bg-blue-600 text-white py-4 rounded-xl font-black text-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 transform active:scale-95">
                                    PLACE BID
                                </button>
                                <p class="text-center text-xs text-slate-400">Minimum bid increment: $500</p>
                            </div>

                            <hr class="my-8 border-slate-100">

                            <div>
                                <h3 class="font-bold text-slate-900 mb-4 flex justify-between">
                                    Recent Bids
                                    <span class="text-blue-600 text-sm font-medium cursor-pointer">View All</span>
                                </h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-3">
                                            <img src="https://i.pravatar.cc/100?img=12" class="w-8 h-8 rounded-full">
                                            <span class="font-bold">j_car_enthusiast</span>
                                        </div>
                                        <span class="font-bold">$185,500</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm opacity-60">
                                        <div class="flex items-center gap-3">
                                            <img src="https://i.pravatar.cc/100?img=8" class="w-8 h-8 rounded-full">
                                            <span class="font-bold">speed_demon</span>
                                        </div>
                                        <span class="font-bold">$185,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-3xl border border-slate-200 flex items-center gap-4">
                            <img src="https://i.pravatar.cc/100?img=33" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="text-xs text-slate-400 uppercase font-bold">Seller</p>
                                <p class="font-bold text-slate-900">Miami Exotic Collections</p>
                                <div class="flex text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star text-slate-200"></i>
                                    <span class="ml-2 text-slate-500 font-medium">(48 deals)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</template>