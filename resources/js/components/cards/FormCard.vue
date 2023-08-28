<template>
    <div class="py-16 lg:w-1/2 lg:mx-auto">
        <div class="border rounded shadow sm:mx-10 divide-y-2">
            <div class="card-header p-4">
                <h2 class="text-2xl font-big-title text-primary-900">
                    <slot name="header" />
                </h2>
            </div>
            <div class="card-body p-4">
                <slot />
            </div>
            <div class="card-footer p-4">
                <div class="text-center">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style>
</style>
