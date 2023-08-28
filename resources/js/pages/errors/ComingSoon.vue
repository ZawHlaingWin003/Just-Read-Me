<template>
    <section-container class="py-16">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold font-big-title tracking-wide lg:tracking-widest py-2">
                <span><i class="fa-solid fa-person-running"></i></span>
                Coming soon
                <span><i class="fa-solid fa-person-running"></i></span>
            </h1>
            <p class="text-red-500">This page is under construction!</p>
        </div>
        <img src="/frontend/assets/under-construction.svg" alt="" class="w-3/5 mx-auto h-4/5">
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue"

export default {
    components: {
        SectionContainer
    }
}
</script>

<style>

</style>