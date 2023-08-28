<template>
    <router-link
        class="
            flex
            items-center
            gap-2
            text-xs
            md:text-sm
            hover:text-primary-900
            active:text-primary-700
        "
    >
        <slot />
    </router-link>
</template>

<script>
export default {};
</script>

<style>
</style>
