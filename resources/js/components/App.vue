<template>
    <NavBar :isAuthenticated="isAuthenticated" :user="user"></NavBar>

    <!-- <router-view></router-view> -->

    <router-view v-slot="{ Component }">
        <transition name="fade">
            <component :is="Component" />
        </transition>
    </router-view>

    <!-- set progressbar -->
    <vue-progress-bar></vue-progress-bar>

    <Footer></Footer>
</template>

<script>
import NavBar from "./AppNavBar.vue";
import Footer from "./AppFooter.vue";

export default {
    components: { NavBar, Footer },
    data() {
        return {
            isAuthenticated: false,
            user: {},
        };
    },
    mounted() {
        this.checkAuthenticated();
        if (this.isAuthenticated) {
            this.getAuthenticatedUser();
        }
        console.log(this.user);
    },
    methods: {
        getAuthenticatedUser() {
            axios.get("/api/user").then((response) => {
                this.user = response.data.data;
            });
        },

        checkAuthenticated() {
            this.isAuthenticated = Boolean(localStorage.getItem("API_TOKEN"));
        },

        logout() {
            localStorage.removeItem("API_TOKEN");
            this.checkAuthenticated();
            this.$router.push({ name: "login" });
        },
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 300ms ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
