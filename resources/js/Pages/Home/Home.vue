<script setup>
import NavBar from "@/Components/NavBar.vue";
import NewsCard from "@/Components/NewsCard.vue";
import Footer from "@/Components/Footer.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    newsList: Array,
})

</script>

<template>
    <Head title="Home" />
    <div class="min-h-screen bg-gray-100">
        <NavBar />

        <NewsCard :newsList="newsList" />

        <Footer />

    </div>
</template>

<style scoped>
</style>
