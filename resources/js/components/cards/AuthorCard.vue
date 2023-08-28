<template>
    <div class="border rounded shadow sm:mx-10 md:mx-auto md:w-full divide-y-2">
        <div class="card-body p-4 group">
            <div class="relative">
                <div class="setting absolute -right-2 -top-2">
                    <p
                        class="setting-icon px-[4px] rounded-full cursor-pointer border-2 border-light-blue hover:border-primary-900 transition-all duration-500 inline-block mb-2 float-right"
                        :class="{ 'border-primary-900': isSettingOpen }"
                        @click="isSettingOpen = !isSettingOpen"
                    >
                        <i class="fa-solid fa-ellipsis"></i>
                    </p>
                    <div
                        class="setting-actions clear-both flex flex-col gap-2"
                        v-show="isSettingOpen"
                    >
                        <LinkButton
                            :to="{
                                name: 'authors.edit',
                                params: { slug: author.slug },
                            }"
                            class="select-none"
                        >
                            <span>Edit</span>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </LinkButton>
                        <Button
                            class="select-none border-red-900 bg-red-900 hover:text-red-900 focus:ring-red-700 active:ring-red-500"
                            @click="$emit('deleteAuthor', author.slug)"
                        >
                            <span>Delete</span>
                            <i class="fa-solid fa-trash"></i>
                        </Button>
                    </div>
                </div>
                <div class="profile">
                    <img
                        :src="
                            author.profile
                                ? author.profile
                                : `https://ui-avatars.com/api/?name=${author.name}&bold=true&rounded=true`
                        "
                        alt=""
                        class="w-28 h-28 object-center object-cover rounded-full mx-auto"
                    />
                </div>
            </div>
        </div>
        <div class="card-footer p-4">
            <p class="text-center">
                <Link
                    :to="{
                        name: 'authors.show',
                        params: { slug: author.slug },
                    }"
                    >{{ author.name }}</Link
                >
            </p>
        </div>
    </div>
</template>

<script>
import Button from "../form/Button.vue";
import LinkButton from "../form/LinkButton.vue";
import Link from "../form/Link.vue";
import TextLink from "../form/TextLink.vue";

export default {
    components: {
        Link,
        Button,
        TextLink,
        LinkButton,
    },

    props: ["author"],

    data() {
        return {
            isSettingOpen: false,
        };
    },

    methods: {},
};
</script>

<style>
</style>