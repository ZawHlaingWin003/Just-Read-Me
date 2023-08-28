<template>
    <section-container class="py-16">
        <LinkButton to="/download">To Library</LinkButton>
        <div class="my-8 lg:flex">
            <div class="border-b-2 lg:border-t-2 lg:border-b-0 lg:w-full lg:py-8">
                <img
                    src="/frontend/assets/books/img10.jpg"
                    alt=""
                    class="mx-auto"
                />
                <div class="flex justify-center gap-8 my-4 text-xs">
                    <p>
                        <span><i class="fa-solid fa-eye"></i></span>
                        32 reads
                    </p>
                    <p>
                        <span><i class="fa-solid fa-thumbs-up"></i></span>
                        51 likes
                    </p>
                </div>
            </div>
            <div class="space-y-4 py-4 lg:py-8 lg:px-8 lg:border-t-2 lg:border-l-2">
                <p class="text-primary-800 space-x-4 flex">
                    <span><TextLink to="/ee">Biography</TextLink></span>
                    <span>|</span>
                    <span><TextLink to="/ee">Mystery</TextLink></span>
                    <span>|</span>
                    <span> <TextLink to="/ee">Horror</TextLink></span>
                </p>
                <div class="lg:pr-8">
                    <h1 class="text-2xl lg:text-3xl lg:mb-1 font-big-title leading-6">
                        Deep Trade Agreements With Other
                    </h1>
                    <div class="flex justify-between">
                        <p class="flex gap-2">
                            <span>by</span>
                            <TextLink to="/authors" class="text-primary-800"
                                >Dr. David Karlo</TextLink
                            >
                        </p>
                        <p class="flex gap-2">
                            <span>published at</span>
                            <TextLink to="/dates" class="text-primary-800">
                                17-06-2001</TextLink
                            >
                        </p>
                    </div>
                </div>
                <p class="lg:pr-8">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id
                    qui corrupti quae cumque facilis odit voluptatibus
                    necessitatibus ea deleniti, animi a, quod ipsam aliquid
                    illum facere. Minus expedita consequuntur blanditiis.
                </p>
                <TextLink to="/download" class="inline-block underline"
                    >Download PDF</TextLink
                >
            </div>
        </div>
        <div class="pdf-wrapper w-full lg:mt-20">
            <iframe
                src="/frontend/assets/pdfs/The-Invisible-Man.pdf#toolbar=0"
                frameborder="0"
                class="md:w-4/5 mx-auto h-[500px] lg:h-[600px] border-2 border-black"
            ></iframe>
        </div>
        <hr class="border-dark-brown-700 my-8" />
        <div class="">
            <div>
                <h3 class="text-xl font-big-title leading-5 mb-2">
                    Do you recommend this book?
                </h3>
                <LinkButton to="/ee">Like This Book</LinkButton>
            </div>
            <hr class="border-dark-brown-700 my-8">
            <div class="card my-8 border shadow divide-y-2">
                <div class="card-header p-2 lg:px-4 bg-gray-100">
                    <p class="font-semibold">Total Reviews (5)</p>
                </div>
                <div class="card-body px-2 lg:px-4 py-4">
                    <div class="text-center hidden">
                        <h3 class="font-big-title leading-5 text-xl mb-2">
                            You have to login to review books.
                        </h3>
                        <LinkButton to="/login">Login</LinkButton>
                    </div>
                    <div>
                        <form action="">
                            <FormGroup>
                                <Label for="book-review" class="text-xs lg:text-sm">Book Review : </Label>
                                <Textarea id="book-review" rows="5"></Textarea>
                            </FormGroup>
                            <Button>Submit</Button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="review-list">
                <ReviewCard />
                <ReviewCard />
                <ReviewCard />
                <ReviewCard />
            </div>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import TextLink from "../../components/form/TextLink.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import Button from "../../components/form/Button.vue";
import FormGroup from "../../components/form/FormGroup.vue";
import Label from "../../components/form/Label.vue";
import Textarea from "../../components/form/Textarea.vue";
import ReviewCard from "../../components/cards/ReviewCard.vue";
export default {
    components: { SectionContainer, TextLink, LinkButton, Button, ReviewCard, FormGroup, Label, Textarea },
};
</script>

<style>
</style>