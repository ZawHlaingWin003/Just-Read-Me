<template>
    <section-container class="py-16">
        <template v-if="isLoading">
            <loader />
        </template>

        <template v-else>
            <link-button to="/authors">Author List</link-button>

            <div class="my-8 text-center lg:w-4/5 lg:mx-auto">
                <img
                    :src="
                        author.profile
                            ? author.profile
                            : `https://ui-avatars.com/api/?name=${author.name}&bold=true`
                    "
                    alt=""
                    class="w-max mx-auto h-60 object-contain rounded border-2 border-primary-900"
                />
                <h3
                    class="text-2xl font-big-title uppercase my-4 border bg-dark-blue-900 text-white md:w-1/2 mx-auto"
                >
                    {{ author.name }}
                </h3>
                <div class="text-justify">
                    <h5
                        class="font-big-title text-xl w-max border-b-2 border-dark-brown-900"
                    >
                        Biography
                    </h5>
                    <p class="my-4 indent-10">
                        {{ author.biography }}
                    </p>
                </div>
            </div>

            <hr class="my-4 border-dark-brown-900 border-opacity-50" />
            <div class="flex justify-between items-center gap-4">
                <h3 class="text-xl font-big-title uppercase text-primary-900">
                    Published Book List
                </h3>
                <link-button to="/books">Go To Library</link-button>
            </div>
            <hr class="my-4 border-dark-brown-900 border-opacity-50" />

            <div class="book-list grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <book-card
                    name="How to be a better programmer?"
                    author="Dr. David James"
                ></book-card>
                <book-card
                    name="Be aware of being too nice to people around the world"
                    author="Hanry Karen"
                ></book-card>
                <book-card
                    name="The Invisible Man"
                    author="Willium Shakespehere"
                ></book-card>
                <book-card
                    name="Freedies Vs The Family Curse"
                    author="Carter Brown"
                ></book-card>
                <book-card
                    name="How to be a better programmer?"
                    author="Dr. David James"
                ></book-card>
            </div>
        </template>
    </section-container>
</template>

<script>
import BookCard from "../../components/cards/BookCard.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import Loader from "../../components/partials/Loader.vue";
import SectionContainer from "../../components/SectionContainer.vue";

import { request } from "../../helpers/request";

export default {
    components: { SectionContainer, LinkButton, BookCard, Loader },
    props: ["slug"],
    data() {
        return {
            author: [],
            isLoading: true,
        };
    },
    mounted() {
        this.getAuthor(this.slug);
    },
    methods: {
        async getAuthor(slug) {
            // const response = await request("get", "/api/authors/" + slug);
            // console.log(response);
            // if ((response.status = 200)) {
            //     this.author = response.data.data;
            //     this.isLoading = false;
            // } else if (response.status === 404) {
            //     window.location.href = "/404"; // redirect to 404 page
            // }
            await request("get", "/api/authors/" + slug)
                .then((response) => {
                    this.author = response.data.data;
                    this.isLoading = false;
                })
                .catch((error) => {
                    if ((error.response.status = 404)) {
                        this.$router.push({ name: "Error404" });
                    }
                });
        },
    },
};
</script>

<style>
</style>