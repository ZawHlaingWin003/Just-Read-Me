<template>
    <section-container>
        <nav class="py-4">
            <div class="container flex flex-wrap items-center justify-between">
                <router-link to="/">
                    <Logo></Logo>
                </router-link>
                <div class="flex items-center lg:order-2 relative py-2">
                    <template v-if="isAuthenticated">
                        <user-profile-dropdown-vue
                            :user="user"
                        ></user-profile-dropdown-vue>
                    </template>
                    <template v-else>
                        <LinkButton to="/login">
                            <span>Login</span>
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </LinkButton>
                    </template>

                    <button
                        class="p-2 ml-4 rounded-lg hover:bg-light-blue focus:outline-none focus:ring-2 focus:ring-dark-blue-10 lg:hidden"
                        :class="{
                            'bg-light-blue': showMobileNav,
                        }"
                        @click="toggleMobileNav"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div
                    class="w-full bg-dark-blue-900 lg:bg-white lg:text-dark-blue-900 rounded-lg text-gray-300 mt-4 lg:m-0 lg:w-auto"
                    v-show="showMobileNav"
                >
                    <ul class="flex flex-col lg:flex-row px-4 py-2">
                        <li>
                            <router-link
                                :to="{ name: 'home' }"
                                class="block py-2 pl-3 pr-4 hover:bg-primary-700 lg:hover:bg-white lg:hover:text-primary-900 rounded-md"
                            >
                                Home
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/books"
                                class="block py-2 pl-3 pr-4 hover:bg-primary-700 lg:hover:bg-white lg:hover:text-primary-900 rounded-md"
                            >
                                Library
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/authors"
                                class="block py-2 pl-3 pr-4 hover:bg-primary-700 lg:hover:bg-white lg:hover:text-primary-900 rounded-md"
                            >
                                Authors
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/genres"
                                class="block py-2 pl-3 pr-4 hover:bg-primary-700 lg:hover:bg-white lg:hover:text-primary-900 rounded-md"
                            >
                                Genres
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section-container>
</template>

<script>
import Logo from "./partials/Logo.vue";
import LinkButton from "./form/LinkButton.vue";
import SectionContainer from "./SectionContainer.vue";
import UserProfileDropdownVue from "./UserProfileDropdown.vue";

import { request } from "../helpers/request";

export default {
    components: {
        Logo,
        LinkButton,
        SectionContainer,
        UserProfileDropdownVue,
    },
    props: {
        isAuthenticated: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
    },
    data() {
        return {
            showMobileNav: true,

            // isAuthenticated: false,
            // user: {},
        };
    },
    // mounted() {
    //     this.checkAuthenticated();
    //     if (this.isAuthenticated) {
    //         this.getAuthenticatedUser();
    //     }
    //     console.log(this.user);
    // },
    methods: {
        // getAuthenticatedUser() {
        //     request("get", "/api/user").then((response) => {
        //         this.user = response.data.data;
        //     });
        // },

        // checkAuthenticated() {
        //     this.isAuthenticated = Boolean(localStorage.getItem("API_TOKEN"));
        // },

        toggleMobileNav() {
            this.showMobileNav = !this.showMobileNav;
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
</style>
