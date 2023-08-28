<template>
    <section-container class="bg-home bg-cover bg-center px-0 md:px-0">
        <div class="cover text-center">
            <div
                class="
                    content
                    w-full
                    h-full
                    bg-black bg-opacity-60
                    text-white
                    py-20
                    lg:py-28
                    px-4
                    md:px-10
                "
            >
                <h1 class="font-big-title text-3xl mb-4 lg:text-4xl">
                    Some Features That Made Us Unique
                </h1>
                <p>
                    Lately it seems like we're all spending more time doing
                    chores. Read on for 14 ideas to help you make tedious tasks
                    easier, less stressful.
                </p>
            </div>
        </div>
    </section-container>
    <div class="container mx-auto my-8 md:-mt-10">
        <div class="flex flex-wrap justify-center gap-4 text-center lg:gap-8">
            <div
                class="
                    rect
                    border
                    shadow
                    rounded
                    w-40
                    h-32
                    lg:w-64 lg:h-40
                    p-4
                    bg-white
                    flex flex-col
                    items-center
                    justify-center
                "
            >
                <h1
                    class="
                        text-4xl
                        lg:text-5xl
                        font-big-title
                        text-primary-900
                        mb-2
                        lg:mb-4
                    "
                >
                    145
                </h1>
                <p>Popular Books</p>
            </div>
            <div
                class="
                    rect
                    border
                    shadow
                    rounded
                    w-40
                    h-32
                    lg:w-64 lg:h-40
                    p-4
                    bg-white
                    flex flex-col
                    items-center
                    justify-center
                "
            >
                <h1
                    class="
                        text-4xl
                        lg:text-5xl
                        font-big-title
                        text-primary-900
                        mb-2
                        lg:mb-4
                    "
                >
                    84
                </h1>
                <p>Smart Authors</p>
            </div>
            <div
                class="
                    rect
                    border
                    shadow
                    rounded
                    w-40
                    h-32
                    lg:w-64 lg:h-40
                    p-4
                    bg-white
                    flex flex-col
                    items-center
                    justify-center
                "
            >
                <h1
                    class="
                        text-4xl
                        lg:text-5xl
                        font-big-title
                        text-primary-900
                        mb-2
                        lg:mb-4
                    "
                >
                    1056
                </h1>
                <p>Happy Readers</p>
            </div>
            <div
                class="
                    rect
                    border
                    shadow
                    rounded
                    w-40
                    h-32
                    lg:w-64 lg:h-40
                    p-4
                    bg-white
                    flex flex-col
                    items-center
                    justify-center
                "
            >
                <h1
                    class="
                        text-4xl
                        lg:text-5xl
                        font-big-title
                        text-primary-900
                        mb-2
                        lg:mb-4
                    "
                >
                    43
                </h1>
                <p>Rare Books</p>
            </div>
        </div>
    </div>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";

export default {
    components: {
        SectionContainer,
    },
};
</script>

<style>
</style>
