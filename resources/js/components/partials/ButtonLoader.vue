<template>
    <div class="custom-loader" style="width: 18px; height: 18px"></div>
</template>

<script>
export default {};
</script>

<style>
.custom-loader {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: conic-gradient(#0000 10%, #000000);
    -webkit-mask: radial-gradient(
        farthest-side,
        #0000 calc(100% - 4px),
        #000 0
    );
    animation: animate 1s infinite linear;
}
@keyframes animate {
    to {
        transform: rotate(1turn);
    }
}
</style>