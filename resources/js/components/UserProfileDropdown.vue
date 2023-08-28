<template>
    <div class="relative">
        <button
            @click="isShowProfileDropdown = !isShowProfileDropdown"
            class="rounded-full w-8 h-8 lg:w-10 lg:h-10 ring-2 ring-offset-2 ring-gray-300"
            :class="{
                'ring-primary-500': isShowProfileDropdown,
            }"
        >
            <img
                :src="
                    user.avatar
                        ? user.avatar
                        : 'https://ui-avatars.com/api/?name=JohnDoe&bold=true&rounded=true'
                "
                alt="Profile"
                class="w-full h-full rounded-full"
            />
        </button>
        <div
            v-if="isShowProfileDropdown"
            class="absolute z-10 right-0 mt-2 pt-2 bg-white rounded-md shadow-lg divide-y divide-dark-brown-800 divide-opacity-50"
        >
            <div class="px-4 py-3 font-bold">
                <div class="flex items-center">
                    <img
                        :src="
                            user.avatar
                                ? user.avatar
                                : 'https://ui-avatars.com/api/?name=JohnDoe&bold=true&rounded=true'
                        "
                        alt="Profile"
                        class="rounded-full w-10 h-10"
                    />
                    <div class="pl-4 pr-10">
                        <span>{{ user.name }}</span
                        ><br />
                        <span class="text-dark-blue-900">{{ user.email }}</span>
                    </div>
                </div>
            </div>
            <div class="text-gray-700">
                <router-link
                    to="/dkfdf"
                    class="block px-4 py-2 text-sm hover:bg-gray-100 transition"
                >
                    <i class="fa-solid fa-user"></i>
                    <span class="ml-2">My Account</span>
                </router-link>
                <router-link
                    to="dfdfdf"
                    class="block px-4 py-2 text-sm hover:bg-gray-100 transition"
                >
                    <i class="fa-solid fa-envelope"></i>
                    <span class="ml-2">Inbox</span>
                </router-link>
                <router-link
                    :to="{ name: 'user.setting' }"
                    class="block px-4 py-2 text-sm hover:bg-gray-100 transition"
                >
                    <i class="fa-solid fa-gear"></i>
                    <span class="ml-2">Settings & Privacy</span>
                </router-link>
            </div>
            <a
                class="block px-4 py-2 text-sm hover:bg-gray-100 transition cursor-pointer"
                @click.prevent="logout"
            >
                <!-- <i class="fa-solid fa-right-from-bracket"></i> -->
                <i class="fa-solid fa-power-off"></i>
                <span class="ml-2">Logout</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        window.addEventListener("click", this.closeDropdown);
    },
    beforeUnmount() {
        window.removeEventListener("click", this.closeDropdown);
    },
    data() {
        return {
            isShowProfileDropdown: false,
        };
    },
    methods: {
        closeDropdown(event) {
            // If the user clicks inside the dropdown, don't close it
            if (!this.$el.contains(event.target)) {
                this.isShowProfileDropdown = false;
            }
        },

        logout() {
            localStorage.removeItem("API_TOKEN");
            this.$router.push({ name: "login" });
        },
    },
};
</script>
