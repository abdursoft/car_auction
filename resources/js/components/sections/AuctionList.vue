<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import BiddingClock from '../clocks/BiddingClock.vue';

const cars = [
    {
        title: '2023 Porsche 911 GT3',
        description: '4.0L H6 • 1,200 miles • Miami, FL',
        image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600',
        status: 'Live',
        currentBid: '$185,000',
        endDate: '2026-05-21T17:25:05'
    },
    {
        title: '1967 Ford Mustang',
        description: 'Manual • Restored • Austin, TX',
        image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600',
        status: 'Upcoming',
        currentBid: '$42,500',
        endDate: '2026-05-28T04:20:20'
    },
    {
        title: '2023 Porsche 911 GT3',
        description: '4.0L H6 • 1,200 miles • Miami, FL',
        image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600',
        status: 'Live',
        currentBid: '$185,000',
        endDate: '2026-05-15T05:35:07'
    },
    {
        title: '1967 Ford Mustang',
        description: 'Manual • Restored • Austin, TX',
        image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600',
        status: 'Upcoming',
        currentBid: '$42,500',
        endDate: '2026-04-29T14:50:18'
    },
    {
        title: '2023 Porsche 911 GT3',
        description: '4.0L H6 • 1,200 miles • Miami, FL',
        image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600',
        status: 'Live',
        currentBid: '$185,000',
        endDate: '2026-05-26T01:30:26'
    },
    {
        title: '1967 Ford Mustang',
        description: 'Manual • Restored • Austin, TX',
        image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600',
        status: 'Upcoming',
        currentBid: '$42,500',
        endDate: '2026-05-20T16:30:45'
    },
];

const filter = ref('all');
</script>

<template>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Upcomings</h2>
                    <p class="text-slate-500">Don't miss out on these active listings ending soon.</p>
                </div>
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">All</button>
                    <button @click="filter = 'luxury'" :class="filter === 'luxury' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">Luxury</button>
                    <button @click="filter = 'classic'" :class="filter === 'classic' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">Classic</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(car, index) in cars" :key="index" class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img :src="car.image" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute bottom-3 mx-auto flex items-center justify-center w-full">
                            <BiddingClock :endTime="car.endDate" />
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">{{ car.title }}</h3>
                        <p class="text-slate-500 text-sm mb-4">{{ car.description }}</p>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider">Current Bid</p>
                                <p class="text-2xl font-black text-blue-600">{{ car.currentBid }}</p>
                            </div>
                            <Link :href="route('bidding')" class="bg-slate-900 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-600 transition">Bid Now</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>