<script setup>
import { Head } from '@inertiajs/vue3';
import Auction from '@/components/auctions/Auction.vue';
import Brand from '@/components/partial/Brand.vue';
import Category from '@/components/partial/Category.vue';
import AuctionList from '@/components/sections/AuctionList.vue';
import Faq from '@/components/sections/Faq.vue';
import Help from '@/components/sections/Help.vue';
import Hero from '@/components/sections/Hero.vue';
import HowWorks from '@/components/sections/HowWorks.vue';
import ReviewBidder from '@/components/sections/ReviewBidder.vue';
import WhyChoose from '@/components/sections/WhyChoose.vue';
import AppLayout from '@/layout/App.vue';
defineOptions({
    layout: AppLayout,
});
</script>

<template>
    <div>
        <Head title="Home" />

        <Hero />
        <Category />
        <Auction />
        <Brand />
        <AuctionList />
        <WhyChoose />
        <HowWorks />
        <ReviewBidder />
        <Faq />
        <Help />
    </div>
</template>
