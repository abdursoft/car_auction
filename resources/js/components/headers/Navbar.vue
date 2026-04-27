<script setup>
import { Icon } from '@iconify/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const auth = computed(() => page.props.auth);

const safeRoute = (name) => {
    try {
        // We check window.route (global) or the injected route helper
        const routeMapper = null;

        if (
            typeof window !== 'undefined' &&
            typeof window.route === 'function'
        ) {
            return window.route(name);
        } else if (typeof route === 'function') {
            return route(name);
        }

        if (routeMapper) {
            return routeMapper(name);
        }

        console.warn(
            `Ziggy route helper not found. Falling back to path for: ${name}`,
        );

        return `/${name}`;
    } catch (e) {
        console.error(`Error generating route for ${name}:`, e);

        return '/';
    }
};
</script>
<template>
    <nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" :class="auth.user ? 'hidden md:block' : 'block'">
            <div class="flex h-16 items-center justify-between">
                <Link :href="safeRoute('home')" class="flex items-center gap-2">
                    <div class="rounded-lg bg-blue-600 p-2">
                        <Icon icon="fluent:gavel-24-filled" width="24" height="24" class="text-white" />
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">Auto<span
                            class="text-blue-600">Bid</span></span>
                </Link>
                <div class="hidden space-x-8 font-medium md:flex">
                    <Link :href="safeRoute('auctions')" class="transition hover:text-blue-600">Auctions</Link>
                    <Link href="/sell-your-car" class="transition hover:text-blue-600">Sell Your Car</Link>
                    <Link :href="safeRoute('howToSell')" class="transition hover:text-blue-600">How to sell</Link>
                </div>
                <div class="flex items-center gap-4">
                    <template v-if="auth.user">
                        <Link :href="safeRoute('authlogout')" class="px-4 font-medium text-slate-600">Signout</Link>
                        <Link :href="safeRoute('dashboard')" class="px-4 font-medium text-slate-600">Dashboard</Link>
                    </template>
                    <template v-else>
                        <Link :href="safeRoute('login')" class="px-4 font-medium text-slate-600">Signin</Link>
                        <Link :href="safeRoute('register')"
                            class="rounded-full bg-blue-600 px-6 py-2 font-semibold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700">
                            Signup</Link>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>
