<template>
    <section-container class="py-16">
        <template v-if="isLoading">
            <loader />
        </template>

        <template v-else>
            <LinkButton to="/authors/create">
                <span>Create New Author</span>
                <i class="fa-solid fa-user-plus"></i>
            </LinkButton>

            <div class="search-form mb-4 mt-8">
                <label
                    for="author"
                    class="text-2xl text-primary-900 font-big-title mb-2"
                >
                    Search Book Using Author Names
                </label>
                <Input type="text" id="author" />
            </div>

            <template v-if="authors.data.length">
                <div
                    class="authors-list grid grid-cols-2 gap-8 my-10 md:grid-cols-3 lg:grid-cols-4"
                >
                    <template v-for="author in authors.data" :key="author.id">
                        <AuthorCard
                            :author="author"
                            @deleteAuthor="deleteAuthor(author.slug)"
                        />
                    </template>
                </div>

                <div class="flex justify-center">
                    <Button>Load More ...</Button>
                </div>
            </template>

            <template v-else>
                <h1 class="mt-14 text-pink-700 text-3xl font-title text-center">
                    No Author Found! Please Add Author First
                </h1>
            </template>
        </template>
    </section-container>
</template>

<script>
import Button from "../../components/form/Button.vue";
import Input from "../../components/form/Input.vue";
import Link from "../../components/form/Link.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import SectionContainer from "../../components/SectionContainer.vue";

import AuthorCard from "../../components/cards/AuthorCard.vue";
import Loader from "../../components/partials/Loader.vue";

import { request } from "../../helpers/request";

export default {
    components: {
        SectionContainer,
        Input,
        Link,
        Button,
        LinkButton,
        AuthorCard,
        Loader,
    },
    data() {
        return {
            authors: {},
            isLoading: true,
        };
    },
    mounted() {
        this.getAuthors();
    },
    methods: {
        async getAuthors() {
            await request("get", "/api/authors")
                .then((response) => {
                    // console.log(response);
                    this.authors = response.data;
                    this.isLoading = false;
                })
                .catch((error) => {
                    // console.error(error);
                    this.authors = [];
                });
        },

        async deleteAuthor(slug) {
            if (confirm("Are you sure you want to delete this data?")) {
                await request("delete", "/api/authors/" + slug).then(
                    (response) => {
                        this.authors.data = this.authors.data.filter(
                            (author) => {
                                return author.slug != slug;
                            }
                        );
                    }
                );
            }
        },
    },
};
</script>

<style>
</style>