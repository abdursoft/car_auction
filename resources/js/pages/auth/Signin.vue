<script setup>
import { Icon } from '@iconify/vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('authlogin'), {
        onSuccess: () => form.reset('password'),
        // Errors are automatically handled and populated in form.errors
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-50 flex">

        <Head title="Signin" />
        <div class="hidden lg:flex w-1/2 relative bg-slate-900 items-center justify-center overflow-hidden">
            <img src="https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?auto=format&fit=crop&q=80&w=1000"
                alt="Luxury Car" class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent"></div>

            <div class="relative z-10 p-12 max-w-lg">
                <div
                    class="h-12 w-12 bg-indigo-500 rounded-xl mb-8 flex items-center justify-center shadow-2xl shadow-indigo-500/40">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-bold text-white tracking-tight leading-tight">Welcome Back</h1>
                <p class="mt-6 text-slate-300 text-lg leading-relaxed">
                    Access exclusive auctions, real-time bidding, and a world-class collection of collector cars.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16 bg-white">
            <div class="w-full max-w-md space-y-8">
                <Link :href="route('home')" class="mb-5 flex items-center gap-2 hover:font-bold">
                    <Icon icon="eva:arrow-ios-back-fill" width="24" height="24" /> Back
                </Link>
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-extrabold text-slate-900">Welcome Back</h2>
                    <p class="mt-2 text-sm text-slate-500">Don't have an account? <Link :href="route('register')"
                            class="text-indigo-600 font-semibold hover:underline">Sign up</Link>
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex items-center justify-center gap-2 py-3 px-4 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all font-medium text-slate-700 shadow-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="Google">
                        <span>Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-2 py-3 px-4 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all font-medium text-slate-700 shadow-sm">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-5 w-5"
                            alt="Facebook">
                        <span>Facebook</span>
                    </button>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm"><span class="px-4 bg-white text-slate-400">Or
                            continue with email</span></div>
                </div>

                <form class="space-y-5" @submit.prevent="submit">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" v-model="form.email" placeholder="name@company.com"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                        <small class="text-red-500" v-show="form?.errors.email">{{ form?.errors.email }}</small>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" v-model="form.password" placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                        <small class="text-red-500" v-show="form?.errors.password">{{ form?.errors.password }}</small>
                        <p class="mt-2 text-xs text-slate-500">Must be at least 8 characters.</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-[0.98]">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>