<template>
    <home-section />

    <about-section />

    <books-section />

    <plan-section />

    <subscribe-section />
</template>

<script>
import LinkButton from "../components/form/LinkButton.vue";
import HomeSection from "./sections/HomeSection.vue";
import AboutSection from "./sections/AboutSection.vue";
import BooksSection from "./sections/BooksSection.vue";
import PlanSection from "./sections/PlanSection.vue";
import SubscribeSection from "./sections/SubscribeSection.vue";

export default {
    components: {
        LinkButton,
        HomeSection,
        AboutSection,
        BooksSection,
        PlanSection,
        SubscribeSection,
    },
};
</script>

<style></style>
