<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { 
  Mail, 
  Phone, 
  MapPin, 
  MessageSquare, 
  Send, 
  Facebook, 
  Twitter, 
  Instagram,
  Clock
} from 'lucide-vue-next';
import App from '@/layouts/App.vue';

defineOptions({ layout: App });
</script>

<template>
  <Head title="Contact Our Concierge" />

  <div class="bg-slate-50 min-h-screen py-12 md:py-24 px-4">
    <div class="max-w-7xl mx-auto">
      
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        
        <div class="space-y-12">
          <div class="space-y-6">
            <span class="inline-block px-4 py-1.5 text-sm font-black tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full">
              Get in Touch
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter">
              We’re here to <span class="text-blue-600">help.</span>
            </h1>
            <p class="text-xl text-slate-500 max-w-lg leading-relaxed">
              Whether you're looking to list a rare collection or need help with a winning bid, our concierge team is standing by.
            </p>
          </div>

          <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <MessageSquare :size="24" />
              </div>
              <h3 class="font-black text-slate-900 mb-2">Chat with us</h3>
              <p class="text-slate-500 text-sm mb-4">Live chat available for active auctions.</p>
              <a href="#" class="text-blue-600 font-bold text-sm hover:underline">Start Chat</a>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
              <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                <Phone :size="24" />
              </div>
              <h3 class="font-black text-slate-900 mb-2">Call Support</h3>
              <p class="text-slate-500 text-sm mb-4">Mon-Fri from 8am to 6pm EST.</p>
              <a href="tel:+1234567890" class="text-indigo-600 font-bold text-sm hover:underline">+1 (234) 567-890</a>
            </div>
          </div>

          <div class="flex items-center gap-6 pt-4">
            <p class="text-xs font-black uppercase tracking-widest text-slate-400">Follow the action</p>
            <div class="flex gap-4">
              <a v-for="icon in [Facebook, Twitter, Instagram]" :key="icon" href="#" class="p-3 bg-white rounded-xl text-slate-400 hover:text-blue-600 transition shadow-sm border border-slate-100">
                <component :is="icon" :size="18" />
              </a>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-blue-600/5 rounded-full blur-3xl"></div>
          
          <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl shadow-slate-200 border border-white">
            <form @submit.prevent class="space-y-6">
              <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Full Name</label>
                  <input type="text" placeholder="John Doe" class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:ring-2 focus:ring-blue-600 focus:bg-white transition" />
                </div>
                <div class="space-y-2">
                  <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Email Address</label>
                  <input type="email" placeholder="john@example.com" class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:ring-2 focus:ring-blue-600 focus:bg-white transition" />
                </div>
              </div>

              <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Subject</label>
                <select class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:ring-2 focus:ring-blue-600 focus:bg-white transition appearance-none cursor-pointer">
                  <option>Selling a Vehicle</option>
                  <option>Bidding Support</option>
                  <option>Technical Issue</option>
                  <option>Partnership Inquiry</option>
                </select>
              </div>

              <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Message</label>
                <textarea rows="4" placeholder="How can we help you?" class="w-full px-6 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:ring-2 focus:ring-blue-600 focus:bg-white transition resize-none"></textarea>
              </div>

              <button class="group w-full bg-slate-900 text-white py-5 rounded-2xl font-black text-lg flex items-center justify-center gap-3 hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-slate-200">
                Send Message
                <Send :size="20" class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
              </button>

              <div class="flex items-center justify-center gap-2 text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                <Clock :size="14" /> Average response time: 2 hours
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>