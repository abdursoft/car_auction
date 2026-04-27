<script setup>
import { Icon } from '@iconify/vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import { usePage } from '@inertiajs/vue3';
import { watch, computed } from 'vue';
import { route } from 'ziggy-js';

const page = usePage();
const flash = computed(() => page.props.flash);

watch(() => flash.value.message, (msg) => {
    if (msg) {
        // Trigger your Toast notification here
        alert(msg); 
    }
});

const signupForm = useForm({
    role: 'user',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    signupForm.post(route('authregister'), {
        onSuccess: () => signupForm.reset('password'),
        // Errors are automatically handled and populated in signupForm.errors
    });
};
</script>

<template>
    <div class="flex min-h-screen bg-slate-50">

        <Head title="Signup" />
        <div class="relative hidden w-1/2 items-center justify-center overflow-hidden bg-slate-900 lg:flex">
            <img src="https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?auto=format&fit=crop&q=80&w=1000"
                alt="Luxury Car" class="absolute inset-0 h-full w-full object-cover opacity-60" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent"></div>

            <div class="relative z-10 max-w-lg p-12">
                <div
                    class="mb-8 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 shadow-2xl shadow-indigo-500/40">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl leading-tight font-bold tracking-tight text-white">
                    Join the community of enthusiasts.
                </h1>
                <p class="mt-6 text-lg leading-relaxed text-slate-300">
                    Access exclusive auctions, real-time bidding, and a
                    world-class collection of collector cars.
                </p>
            </div>
        </div>

        <div class="flex w-full items-center justify-center bg-white p-8 md:p-16 lg:w-1/2">
            <div class="w-full max-w-md space-y-8">
                <Link :href="route('home')" class="mb-5 flex items-center gap-2 hover:font-bold">
                    <Icon icon="eva:arrow-ios-back-fill" width="24" height="24" />
                    Back
                </Link>
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-extrabold text-slate-900">
                        Create an account
                    </h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Already have an account?
                        <Link :href="route('login')" class="font-semibold text-indigo-600 hover:underline">Sign in
                        </Link>
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-3 font-medium text-slate-700 shadow-sm transition-all hover:bg-slate-50">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="Google" />
                        <span>Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-3 font-medium text-slate-700 shadow-sm transition-all hover:bg-slate-50">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="h-5 w-5"
                            alt="Facebook" />
                        <span>Facebook</span>
                    </button>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-4 text-slate-400">Or continue with email</span>
                    </div>
                </div>

                <form class="space-y-5" @submit.prevent="submit">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Full Name</label>
                        <input type="text" placeholder="John Doe"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 transition-all outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            v-model="signupForm.name" />
                        <small class="text-red-500" v-show="signupForm?.errors.name">{{ signupForm?.errors.name }}</small>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email Address</label>
                        <input type="email" placeholder="name@company.com"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 transition-all outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            v-model="signupForm.email" />
                        <small class="text-red-500" v-show="signupForm?.errors.email">{{ signupForm?.errors.email }}</small>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 transition-all outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            v-model="signupForm.password" />
                        <small class="text-red-500" v-show="signupForm?.errors.password">{{ signupForm?.errors.password }}</small>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 transition-all outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            v-model="signupForm.password_confirmation" />
                        <small class="text-red-500" v-show="signupForm?.errors.password_confirmation">{{ signupForm?.errors.password_confirmation }}</small>
                        <p class="mt-2 text-xs text-slate-500">
                            Must be at least 8 characters.
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full rounded-xl bg-indigo-600 py-4 font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:bg-indigo-700 active:scale-[0.98]">
                        Create Account
                    </button>
                </form>

                <p class="text-center text-xs leading-relaxed text-slate-400">
                    By signing up, you agree to our
                    <a href="#" class="underline hover:text-slate-600">Terms of Service</a>
                    and
                    <a href="#" class="underline hover:text-slate-600">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>
</template>
