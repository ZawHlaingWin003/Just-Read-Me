<template>
    <div
        class="relative border shadow-sm hover:shadow-md rounded px-8 pt-10 pb-8 w-full text-center"
    >
        <h1
            class="title absolute -top-5 left-1/2 transform -translate-x-1/2 font-big-title text-xl tracking-wider bg-primary-900 text-white px-4 py-2 rounded w-40"
        >
            {{ plan_level }}
        </h1>
        <div
            class="prize font-big-title border-b-4 border-dotted border-b-light-brown pb-4 flex justify-center items-start"
            v-if="Number(plan_price)"
        >
            <div class="space-x-2">
                <span class="text-3xl">$</span>
                <span class="text-6xl font-bold tracking-widest">
                    {{ plan_price }}</span
                >
            </div>
            <div class="flex flex-col">
                <span class="text-xl">per</span>
                <span class="text-2xl">Month</span>
            </div>
        </div>
        <div
            class="prize font-big-title text-5xl font-bold tracking-widest border-b-4 border-dotted border-b-light-brown pt-2 pb-4"
            v-else
        >
            {{ plan_price }}
        </div>
        <div class="py-8">
            <slot />
        </div>
        <Button class="mx-auto">Buy Package Now</Button>
    </div>
</template>

<script>
import Button from "../../components/form/Button.vue";

export default {
    components: {
        Button,
    },
    props: ["plan_level", "plan_price"],
};
</script>

<style>
</style>