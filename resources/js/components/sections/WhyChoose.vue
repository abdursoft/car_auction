<script setup> 
import { Icon } from '@iconify/vue';
</script>

<template>
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold">Why Choose AutoBid?</h2>
                <p class="text-slate-500 mt-2">We provide the most secure and transparent auction experience.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <Icon icon="fluent-color:shield-48" width="24" height="24" />
                    </div>
                    <h3 class="font-bold mb-2">Verified Sellers</h3>
                    <p class="text-sm text-slate-500">Every car is inspected and history verified before listing.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <Icon icon="material-symbols:electric-bolt" class="text-green-600" width="24" height="24" />
                    </div>
                    <h3 class="font-bold mb-2">Instant Transfers</h3>
                    <p class="text-sm text-slate-500">Automated paperwork and secure escrow payments.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <Icon icon="fa6-solid:headset" class="text-purple-600" width="24" height="24" />
                    </div>
                    <h3 class="font-bold mb-2">24/7 Support</h3>
                    <p class="text-sm text-slate-500">Dedicated auction experts to help you through the process.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                        <Icon icon="fa6-solid:truck" class="text-orange-600" width="24" height="24" />
                    </div>
                    <h3 class="font-bold mb-2">Nationwide Shipping</h3>
                    <p class="text-sm text-slate-500">Get your new car delivered right to your doorstep.</p>
                </div>
            </div>
        </div>
    </section>
</template>