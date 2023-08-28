<template>
    <section-container class="py-16">
        <div class="overflow-hidden">
            <pre class="overflow-hidden">
                {{ user }}
            </pre>
        </div>
    </section-container>
</template>

<script>
import SectionContainer from "../../components/SectionContainer.vue";
import { request } from "../../helpers/request";

export default {
    components: {
        SectionContainer,
    },
    data() {
        return {
            user: {},
            isOpen: false,
        };
    },
    mounted() {
        this.getAuthenticatedUser();
        window.addEventListener("click", this.closeDropdown);
    },
    beforeUnmount() {
        window.removeEventListener("click", this.closeDropdown);
    },

    methods: {
        getAuthenticatedUser() {
            request("get", "/api/user").then((response) => {
                this.user = response;
            });
        },
    },
};
</script>

<style>
</style>