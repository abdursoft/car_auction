<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const backToTopBtn = ref(null)

const handleScroll = () => {
    if (!backToTopBtn.value) return

    if(window !== undefined){
        if (window.scrollY > 250) {
        backToTopBtn.value.classList.remove(
            'opacity-0',
            'translate-y-10',
            'pointer-events-none'
        )
        backToTopBtn.value.classList.add(
            'opacity-100',
            'translate-y-0',
            'pointer-events-auto'
        )
    } else {
        backToTopBtn.value.classList.add(
            'opacity-0',
            'translate-y-10',
            'pointer-events-none'
        )
        backToTopBtn.value.classList.remove(
            'opacity-100',
            'translate-y-0',
            'pointer-events-auto'
        )
    }
    }
}

const scrollToTop = () => {
    if(window !== undefined){
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
}

onMounted(() => {
    if(window !== undefined){
        window.addEventListener('scroll', handleScroll)
    }
})

onUnmounted(() => {
    if(window !== undefined){
        window.removeEventListener('scroll', handleScroll)
    }
})
</script>

<template>
    <!-- footer section  -->
    <footer class="bg-slate-950 text-slate-400 pt-16 pb-8 px-6 border-t border-slate-900">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-16">
            
            <div class="space-y-6">
                <div class="flex items-center gap-2">
                <div class="h-8 w-8 bg-indigo-500 rounded-lg shadow-[0_0_20px_rgba(99,102,241,0.4)]"></div>
                <span class="text-2xl font-bold text-white tracking-tighter">LUX<span class="text-indigo-500">AUCTION</span></span>
                </div>
                <p class="text-sm leading-relaxed max-w-xs">
                The premier marketplace for the world's most exciting enthusiast cars. Real-time bidding, verified sellers.
                </p>
                <div class="flex gap-4">
                <div class="h-10 w-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center hover:border-indigo-500 hover:text-white transition-all cursor-pointer">𝕏</div>
                <div class="h-10 w-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center hover:border-indigo-500 hover:text-white transition-all cursor-pointer">IG</div>
                </div>
            </div>

            <details class="group lg:block" open>
                <summary class="flex justify-between items-center cursor-pointer list-none lg:cursor-default lg:mb-6">
                <h4 class="text-white font-semibold uppercase tracking-wider text-xs">Marketplace</h4>
                <span class="lg:hidden transition-transform group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
                </summary>
                <ul class="space-y-4 text-sm mt-4 lg:mt-0">
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Live Auctions</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Past Results</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Sell Your Car</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Shipping Quotes</a></li>
                </ul>
            </details>

            <details class="group lg:block" open>
                <summary class="flex justify-between items-center cursor-pointer list-none lg:cursor-default lg:mb-6">
                <h4 class="text-white font-semibold uppercase tracking-wider text-xs">Resources</h4>
                <span class="lg:hidden transition-transform group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </span>
                </summary>
                <ul class="space-y-4 text-sm mt-4 lg:mt-0">
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Community</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Support</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Trust & Safety</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition-colors">Careers</a></li>
                </ul>
            </details>

            <div class="space-y-6">
                <h4 class="text-white font-semibold uppercase tracking-wider text-xs">Stay Updated</h4>
                <p class="text-sm">Get the daily dose of the best cars directly in your inbox.</p>
                <form class="relative group">
                <input 
                    type="email" 
                    placeholder="email@example.com" 
                    class="w-full bg-slate-900 border border-slate-800 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all"
                />
                <button class="absolute right-2 top-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-1.5 px-3 rounded-lg transition-all active:scale-95">
                    Join
                </button>
                </form>
            </div>

            </div>

            <div class="pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-6 text-[11px] font-medium uppercase tracking-widest">
            <p>© 2026 LUX AUCTION Inc.</p>
            <div class="flex gap-8 text-slate-500">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
                <a href="#" class="hover:text-white transition-colors">Cookies</a>
            </div>
            </div>
        </div>

        <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-50">

            <button 
                ref="backToTopBtn"
                id="back-to-top"
                @click="scrollToTop"
                class="p-3 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200 dark:border-slate-800 rounded-full shadow-xl hover:shadow-indigo-500/20 hover:-translate-y-1 transition-all duration-500 group opacity-0 translate-y-10 pointer-events-none cursor-pointer"
                aria-label="Back to top"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700 dark:text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>

            <a 
                href="https://wa.me/YOUR_NUMBER" 
                target="_blank"
                class="p-3 bg-emerald-500 hover:bg-emerald-600 rounded-full shadow-xl shadow-emerald-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center"
                aria-label="Contact on WhatsApp"
            >
                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
            </a>
        </div>
    </footer>
</template>
