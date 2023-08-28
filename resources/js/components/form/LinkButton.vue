<template>
    <router-link
        class="inline-block space-x-2 text-white text-xs px-3 py-2 md:px-5 shadow-md rounded-md font-big-title tracking-widest bg-primary-900 border-2 border-primary-900 hover:bg-white hover:text-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:ring-opacity-30 active:bg-opacity-30 active:ring-primary-500 disabled:bg-gray-500 disabled:border-gray-500 disabled:text-gray-100 disabled:hover:text-gray-100"
        :disabled="disabled"
    >
        <slot />
    </router-link>
</template>


<script>
export default {
    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

<style>
</style>
