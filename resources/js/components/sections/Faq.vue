<template>
    <!-- faq section  -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4">
            
            <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Got Questions?</h2>
            <p class="text-slate-500 mt-3 text-lg">Everything you need to know about the LuxAuction experience.</p>
            </div>

            <div class="flex justify-center mb-10">
            <div class="inline-flex p-1 bg-slate-200/50 backdrop-blur-md rounded-2xl border border-slate-200">
                <button class="px-8 py-3 rounded-xl bg-white shadow-sm text-indigo-600 font-bold text-sm transition-all">Buying</button>
                <button class="px-8 py-3 rounded-xl text-slate-600 font-bold text-sm hover:text-indigo-600 transition-all">Selling</button>
                <button class="px-8 py-3 rounded-xl text-slate-600 font-bold text-sm hover:text-indigo-600 transition-all">Shipping</button>
            </div>
            </div>

            <div class="space-y-4">
            
            <details class="group bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-indigo-200 transition-all duration-300" open>
                <summary class="flex justify-between items-center p-6 cursor-pointer list-none">
                <span class="text-lg font-bold text-slate-800 flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    How does the bidding process work?
                </span>
                <span class="transition-transform duration-300 group-open:rotate-180 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
                </summary>
                <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-50 pt-4">
                Bidding is simple. Once you register and verify your payment method, you can place bids in $500 increments. If a bid is placed in the final 2 minutes, the clock resets to 2 minutes to prevent "sniping."
                </div>
            </details>

            <details class="group bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-indigo-200 transition-all duration-300">
                <summary class="flex justify-between items-center p-6 cursor-pointer list-none">
                <span class="text-lg font-bold text-slate-800 flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </span>
                    Is the vehicle title verified?
                </span>
                <span class="transition-transform duration-300 group-open:rotate-180 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
                </summary>
                <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-50 pt-4">
                Yes, every car listed must provide a clear VIN and photos of the title. We also provide a free Carfax report for every enthusiast vehicle on the platform.
                </div>
            </details>

            </div>

            <div class="mt-12 p-8 rounded-3xl bg-indigo-600 text-center text-white">
            <h3 class="text-xl font-bold">Still have questions?</h3>
            <p class="mt-2 text-indigo-100 opacity-90">Our 24/7 enthusiast support team is ready to help.</p>
            <button class="mt-6 px-8 py-3 bg-white text-indigo-600 font-black rounded-xl hover:bg-indigo-50 transition-colors">
                Contact Support
            </button>
            </div>
        </div>
    </section>
</template>