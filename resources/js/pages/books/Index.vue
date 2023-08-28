<template>
    <section-container class="py-16 lg:py-28">
        <div
            class="lg:flex lg:justify-between lg:items-center space-y-8 lg:space-y-0"
        >
            <div class="book-content text-center">
                <div class="space-y-2 mb-4">
                    <TextLink
                        to="/books/show"
                        class="uppercase underline tracking-widest justify-center"
                        >Author: Dr. Danielle Steel</TextLink
                    >
                    <h1
                        class="font-big-title text-2xl md:text-3xl lg:text-4xl font-bold tracking-wide lg:font-normal uppercase"
                    >
                        Black history months and slos other three words
                    </h1>
                    <p class="text-justify mb-4 lg:text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Esse, repellat illo consequatur sequi perferendis nobis
                        quae harum in vel molestiae praesentium molestias, velit
                        eum numquam eos magni? Accusantium, consectetur
                        doloremque?
                    </p>
                </div>
                <LinkButton to="/books/show">
                    <span>Read Now</span>
                    <i class="fa-solid fa-book-open-reader"></i>
                </LinkButton>
            </div>
            <div class="book-cover lg:w-full">
                <img
                    src="/frontend/assets/books/img5.jpg"
                    alt=""
                    class="mx-auto"
                />
            </div>
        </div>
    </section-container>
    <hr class="border-dark-brown-700" />

    <!-- <ComingSoon /> -->
    <section-container class="py-16">
        <div class="flex flex-col-reverse gap-10 lg:flex-row">
            <div class="books">
                <div
                    class="book-filters md:flex items-center justify-between mb-4"
                >
                    <div class="sort-by flex items-center gap-4">
                        <label for="" class="">Sort By : </label>
                        <select
                            id=""
                            class="p-2 my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block"
                        >
                            <option value="1">Latest Added</option>
                            <option value="5">Most Popular</option>
                            <option value="5">Best Selling</option>
                            <option value="10">Alphabetically, A-Z</option>
                            <option value="15">Alphabetically, Z-A</option>
                            <option value="15">Price, Low To High</option>
                            <option value="15">Price, High To Low</option>
                        </select>
                    </div>
                    <div class="showing flex items-center gap-4">
                        <label for="" class="">Showing : </label>
                        <select
                            id=""
                            class="p-2 my-1 ring-2 ring-primary-700 rounded focus:outline-none focus:ring-primary-900 disabled:ring-gray-400 text-sm tracking-wide block"
                        >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
                <div class="book-list grid grid-cols-2 md:grid-cols-3 gap-4">
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
            </div>
            <div class="book-actions lg:w-4/5 space-y-4">
                <div class="md:flex justify-between items-center lg:block">
                    <!-- Search Action -->
                    <div
                        class="relative flex items-center justify-between md:w-3/5 lg:w-full"
                    >
                        <Input id="name" class="pr-5 py-3" />
                        <Button class="absolute right-1">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </Button>
                    </div>

                    <LinkButton :to="{ name: 'books.create' }"
                        >Add New Book</LinkButton
                    >
                </div>
                <div class="genres-list border px-6 py-4">
                    <h1
                        class="text-xl font-extrabold mb-4 md:mb-6 border-b-2 border-b-primary-900 w-max"
                    >
                        Book Genres
                    </h1>
                    <ul class="space-y-4">
                        <li
                            class="border rounded p-2 font-big-title hover:bg-gray-50"
                            v-for="genre in genres"
                            :key="genre.id"
                        >
                            <TextLink to="/ej">
                                <i class="fa-solid fa-caret-right"></i>
                                <div
                                    class="w-full flex justify-between items-center"
                                >
                                    <span>{{ genre.name }}</span>
                                    <span class="text-gray-600">26</span>
                                </div>
                            </TextLink>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import TextLink from "../../components/form/TextLink.vue";
import Input from "../../components/form/Input.vue";
import Button from "../../components/form/Button.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import ComingSoon from "../errors/ComingSoon.vue";
import BookCard from "../../components/cards/BookCard.vue";

import { request } from "../../helpers/request";

export default {
    components: {
        SectionContainer,
        TextLink,
        Input,
        Button,
        LinkButton,
        ComingSoon,
        BookCard,
    },
    data() {
        return {
            genres: [],
            books: {},
        };
    },
    mounted() {
        this.getGenres();
        this.getBooks();
    },
    methods: {
        async getGenres() {
            await request("get", "/api/genres").then((response) => {
                this.genres = response.data.data;
            });
        },

        async getBooks() {
            await request("get", "/api/books").then((response) => {
                console.log(response);
            });
        },
    },
};
</script>

<style>
</style>