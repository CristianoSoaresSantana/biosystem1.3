<template>
    <div class="preloader" v-show="preloader">
        <img src="/images/preloader.gif" alt="Preloader...">
    </div>
</template>

<script>
export default {
    computed: {
        preloader () {
            return this.$store.state.preloader.loading
        }
    }
}
</script>

<style>
.preloader{
    background: rgb(45, 56, 58);
    position: absolute;
    z-index: 9999;
    opacity: .2;
    width: 100%;
    height: 100%;
    margin: 0;
    text-align: center;
    padding: 6% 9%;
}
.preloader img{
    max-width: 700px;
}
</style>

