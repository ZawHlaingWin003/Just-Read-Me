<template>
    <section-container>
        <div
            class="space-y-10 md:space-y-0 py-14 md:flex md:justify-between md:items-center"
        >
            <div class="home-content">
                <p class="font-semibold md:mb-2">Welcome to our</p>
                <h1
                    class="text-4xl lg:text-6xl font-semibold font-big-title mb-2"
                >
                    public <span class="text-primary-900">E</span>-library
                </h1>
                <p class="description mb-4 md:mb-8">
                    You can learn anything in our library,
                    <span class="text-primary-900 font-semibold"
                        >JustReadMe.com</span
                    >
                    for free. <br />
                    Remember! For Free, For Everyone.
                </p>
                <LinkButton to="/library">
                    <span>Go To Library</span>
                    <i class="fa-solid fa-book-bookmark"></i>
                </LinkButton>
            </div>
            <div class="home-image scale-90">
                <img src="/frontend/assets/home-bg.svg" alt="" />
            </div>
        </div>
    </section-container>
</template>

<script>
import LinkButton from "../../components/form/LinkButton.vue";
import SectionContainer from "../../components/SectionContainer.vue";

export default {
    components: { SectionContainer, LinkButton },
};
</script>

<style>
</style>