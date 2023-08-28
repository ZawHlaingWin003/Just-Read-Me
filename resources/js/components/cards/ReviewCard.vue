<template>
    <div
        class="review-card border bg-gray-100 shadow py-4 px-2 mb-4 lg:mb-6 rounded hover:shadow-md group"
    >
        <div class="flex gap-4">
            <div class="w-20 md:w-10 lg:w-14">
                <!-- <img
                                src="https://ui-avatars.com/api/?name=DavidZaw"
                                alt=""
                                class="
                                    w-full
                                    rounded-full
                                    border border-gray-500
                                "
                            /> -->
                <img
                    src="/frontend/assets/users/2.jpg"
                    alt=""
                    class="w-full rounded-full border border-gray-500"
                />
            </div>
            <div class="w-full">
                <div class="content">
                    <div class="flex justify-between">
                        <div class="info">
                            <p class="font-extrabold">Kylo</p>
                            <p class="text-xs items-end">3 months ago</p>
                        </div>
                        <div class="actions space-x-2 hidden group-hover:flex">
                            <Button class="px-3 inline"
                                ><i class="fa-solid fa-edit"></i
                            ></Button>
                            <Button
                                class="px-3 inline bg-red-900 border-red-900 hover:text-red-500 focus:ring-red-700 active:ring-red-500"
                                ><i class="fa-solid fa-trash"></i
                            ></Button>
                        </div>
                    </div>
                    <p class="mt-4 lg:mt-6">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        In, quos? Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Ipsam quaerat blanditiis libero
                        tenetur magni dolorum, vitae perferendis consequuntur
                        esse laboriosam atque pariatur ex voluptates, nam at
                        deserunt quasi aliquid sed.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TextLink from "../../components/form/TextLink.vue";
import LinkButton from "../../components/form/LinkButton.vue";
import Button from "../../components/form/Button.vue";
export default {
    components: { TextLink, LinkButton, Button },
};
</script>

<style>
</style>