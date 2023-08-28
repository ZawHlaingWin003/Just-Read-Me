<template>
    <section-container class="py-20">
        <h1
            class="relative text-center mb-8 before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:w-full before:h-px before:bg-dark-blue-900 before:-z-10"
        >
            <span
                class="text-2xl md:text-4xl text-white font-big-title uppercase px-4 py-2 bg-light-brown rounded"
                >OUR PRICING PLANS</span
            >
        </h1>
        <div class="recent-book-list">
            <div class="text-center lg:w-1/2 mx-auto">
                <p>
                    A simple and effient pricing table is exactly what we need!
                    This great example is build with Cards and this will provide
                    a perfect display on any device. The setup and the
                    customization are very easy.
                </p>
            </div>
            <div
                class="container space-y-8 lg:flex lg:space-y-0 justify-between items-center gap-8 mt-20 mb-10"
            >
                <PlanCard plan_level="basic" plan_price="free">
                    <ul class="space-y-4">
                        <li>Complete Book</li>
                        <li>Access to Downloads</li>
                        <li>Reduced Price</li>
                        <li>Additional Book</li>
                        <li>Bonus Content</li>
                    </ul>
                </PlanCard>
                <PlanCard
                    plan_level="standard"
                    plan_price="59"
                    class="pt-20 pb-16 hover:shadow-primary-900 hover:shadow-sm border-2 border-primary-700 hover:border-primary-900"
                >
                    <ul class="space-y-4">
                        <li>Complete Book</li>
                        <li>Access to Downloads</li>
                        <li>Reduced Price</li>
                        <li>Additional Book</li>
                        <li>Bonus Content</li>
                    </ul></PlanCard
                >
                <PlanCard plan_level="pro" plan_price="99">
                    <ul class="space-y-4">
                        <li>Complete Book</li>
                        <li>Access to Downloads</li>
                        <li>Reduced Price</li>
                        <li>Additional Book</li>
                        <li>Bonus Content</li>
                    </ul>
                </PlanCard>
            </div>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import Button from "../../components/form/Button.vue";
import PlanCard from "../../components/cards/PlanCard.vue";

export default {
    components: {
        SectionContainer,
        Button,
        PlanCard,
    },
};
</script>

<style>
</style>