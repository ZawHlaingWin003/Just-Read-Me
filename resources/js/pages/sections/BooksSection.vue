<template>
    <section-container class="py-20">
        <h1
            class="relative text-center mb-8 before:content-[''] before:absolute before:top-1/2 before:left-0 before:-translate-y-1/2 before:w-full before:h-px before:bg-dark-blue-900 before:-z-10"
        >
            <span
                class="text-3xl md:text-4xl text-white font-big-title uppercase px-4 py-2 bg-light-brown rounded"
                >Popular Books</span
            >
        </h1>
        <div class="recent-book-list">
            <div class="flex justify-between items-center">
                <h3 class="font-big-title text-[1.2rem] md:text-2xl">
                    Recent Book List
                </h3>
                <LinkButton :to="{ name: 'books.index' }">
                    <span>View Library</span>
                    <i class="fa-solid fa-book-bookmark"></i>
                </LinkButton>
            </div>
            <hr class="my-4 border-dark-brown-900 border-opacity-50" />
            <div class="">
                <swiper
                    :modules="modules"
                    :breakpoints="swiperOptions.breakpoints"
                    :slides-per-view="4"
                    :space-between="50"
                    navigation
                >
                    <swiper-slide v-for="(book, index) in books" :key="index">
                        <BookCard :author="book.author" :name="book.name" />
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </section-container>
</template>

<script>
import BookCard from "../../components/cards/BookCard.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import SectionContainer from "../../components/SectionContainer.vue";

// import required modules for swiper
import { Navigation } from "swiper";
import "swiper/css/navigation";

export default {
    components: { SectionContainer, LinkButton, BookCard },
    data() {
        return {
            books: [
                {
                    name: "This is book one",
                    author: "Author one",
                },
                {
                    name: "This is book two",
                    author: "Author two",
                },
                {
                    name: "This is book three what if this is long title",
                    author: "Author three",
                },
                {
                    name: "This is book four",
                    author: "Author four",
                },
                {
                    name: "This is book five",
                    author: "Author five",
                },
                {
                    name: "This is book six",
                    author: "Author six",
                },
            ],
            modules: [Navigation],
            swiperOptions: {
                breakpoints: {
                    0: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    450: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                },
            },
        };
    },
};
</script>

<style>
.swiper-button-next,
.swiper-button-prev {
    border: 2px solid #016fb9;
    padding: 20px 17px;
    color: #016fb9;
    background: #eee;
    border-radius: 5px;
}

.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 1.5rem;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: #016fb9;
    color: #fff;
}
</style>