<template>
    <textarea
        class="
            p-2
            my-1
            ring-2 ring-primary-700
            rounded
            focus:outline-none focus:ring-primary-900
            disabled:ring-gray-400
            text-sm
            tracking-wide
            block
            w-full
        "
        :value="modelValue"
        @input = "e => $emit('update:modelValue', e.target.value)"
    ></textarea>
</template>

<script>
export default {
    props: [
        'modelValue'
    ],

    emits: ['update:modelValue'],
};
</script>

<style>
</style>