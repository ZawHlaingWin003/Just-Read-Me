<template>
    <section-container class="px-0 md:px-0">
        <div class="bg-subscribe bg-center bg-cover bg-fixed pt-20 pb-24">
            <div class="subscribe-form lg:w-1/2 ml-auto px-8 lg:pl-8 lg:pr-32">
                <h3 class="font-big-title text-2xl mb-2">
                    Subscribe For Latest Updates
                </h3>
                <p>
                    The pricing table is a must-have for any online business.
                    For a successful conception and a perfect design
                </p>
                <form class="my-4">
                    <Input
                        type="email"
                        id="email"
                        placeholder="Enter Your Email"
                    />
                </form>
                <Button>Subscribe</Button>
            </div>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import Input from "../../components/form/Input.vue";
import Button from "../../components/form/Button.vue";

export default {
    components: {
        SectionContainer,
        Input,
        Button,
    },
};
</script>

<style>
</style>