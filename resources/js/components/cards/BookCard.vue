<template>
    <div
        class="
            book-card
            border border-slate-300
            rounded-sm
            hover:shadow hover:border-slate-400
            transition-all
            duration-500
        "
    >
        <div class="p-3 text-center">
            <img
                src="/frontend/assets/books/img10.jpg"
                alt=""
                class="book-cover mx-auto"
            />
            <hr class="my-4 border-dark-brown-900" />
            <h3 class="book-title">
                <TextLink
                    to="/"
                    class="
                        text-xl
                        lg:text-[1.3rem]
                        tracking-wider
                        font-big-title
                        text-gray-700
                        justify-center
                    "
                    >{{ name }}</TextLink
                >
            </h3>
            <p class="book-author my-3">
                By :
                <Link to="/ef" class="text-xs">{{ author }}</Link>
            </p>
            <link-button to="/dd" class="block">Read More</link-button>
        </div>
    </div>
</template>

<script>
import Link from "../form/Link.vue";
import LinkButton from "../form/LinkButton.vue";
import TextLink from "../form/TextLink.vue";

export default {
    components: { TextLink, Link, LinkButton },
    props: ["name", "author"],
};
</script>

<style>
</style>