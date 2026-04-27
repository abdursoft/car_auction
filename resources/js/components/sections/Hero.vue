<template>
    <section class="relative py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 z-10" 
                 x-init="setTimeout(() => show = true, 100)"
                 x-show="show" x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 -translate-x-10">
                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Drive Your Dream <br><span class="gradient-text">At Your Own Price</span>
                </h1>
                <p class="text-lg text-slate-600 mb-8 max-w-lg">
                    The most transparent car auction platform. Bid on verified luxury, classic, and daily drivers with full history reports.
                </p>
                <div class="flex gap-4">
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition transform hover:-translate-y-1">Explore Auctions</button>
                    <button class="border border-slate-300 px-8 py-4 rounded-xl font-bold hover:bg-slate-100 transition">View Daily Drops</button>
                </div>
            </div>
            
            <div class="lg:w-1/2 mt-12 lg:mt-0 relative"
                 x-init="setTimeout(() => show = true, 300)"
                 x-show="show" x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 translate-x-10">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
                <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=600" 
                     alt="Sports Car" 
                     class="rounded-3xl shadow-2xl relative z-10 transform -rotate-2 hover:rotate-0 transition duration-500">
            </div>
        </div>
    </section>
</template>