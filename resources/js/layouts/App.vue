<script setup>
import Bottom from '@/components/footers/Bottom.vue';
import Navbar from '@/components/headers/Navbar.vue';
</script>
<template>
    <div class="min-h-screen bg-gray-100 overflow-x-hidden">
        <Navbar />

        <main class="md:pt-10">
            <slot />
        </main>
        <bottom />
    </div>
</template>