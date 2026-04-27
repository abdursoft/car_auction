<script setup>
const props = defineProps({
    cars: {
        type: Array,
        default: () => ([
            {
                id: 1,
                title: '2023 Porsche 911 GT3',
                description: '4.0L H6 • 1,200 miles • Miami, FL',
                currentBid: '$185,000',
                image: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600',
                timeLeft: '04h 22m Left',
            },
            {
                id: 2,
                title: '1967 Ford Mustang',
                description: '5.0L V8 • 45,000 miles • Los Angeles, CA',
                currentBid: '$75,000',
                image: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600',
                timeLeft: 'Live Auction',
            },
        ])
    }
})
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div v-for="(car, index) in cars" :key="index" class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
            <div class="relative h-64 overflow-hidden">
                <img :src="car.image" :alt="car.title" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                    {{ car.timeLeft }}
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
                    <button class="bg-slate-900 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-600 transition">Bid Now</button>
                </div>
            </div>
        </div>
    </div>
</template>