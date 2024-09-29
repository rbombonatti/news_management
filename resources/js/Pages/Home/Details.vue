<script setup>
import NavBar from "@/Components/NavBar.vue";
import NewsDetails from "@/Components/NewsDetails.vue";
import Footer from "@/Components/Footer.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    news: Object,
})

</script>

<template>
    <Head title="Home" />
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <NavBar />

        <!-- Details -->
        <NewsDetails :news="news" />

        <!-- Footer -->
        <Footer />

    </div>
</template>

<style scoped>
</style>
