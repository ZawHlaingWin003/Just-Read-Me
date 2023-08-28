<template>
    <section-container class="py-16 mx-auto text-center">
        <div class="flex justify-center">
            <img src="/frontend/assets/404.svg" alt="">
        </div>
        <link-button to="/" class="my-8 inline-block">
            Go Back To Home Page
        </link-button>
    </section-container>
</template>

<script>
import LinkButton from '../../components/form/LinkButton.vue'
import SectionContainer from '../../components/SectionContainer.vue'
export default {
    components: { SectionContainer, LinkButton },

}
</script>

<style>

</style>
