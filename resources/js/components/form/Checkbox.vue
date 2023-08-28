<template>
    <input
        type="checkbox"
        class="mr-2"
        :id="id"
        :value="modelValue"
        @input="(e) => $emit('update:modelValue', e.target.checked)"
    />

    <label :for="id" class="text-sm">
        <slot />
    </label>
</template>

<script>
export default {
    props: {
        id: String,
        modelValue: Boolean,
    },
};
</script>

<style></style>
