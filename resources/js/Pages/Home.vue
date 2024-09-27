<script setup>
import NavBar from "@/Components/NavBar.vue";
import NewsCard from "@/Components/NewsCard.vue";
import Footer from "@/Components/Footer.vue";

const newsList = [
    { id: 1, title: 'Título da notícia', content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...' },
    { id: 2, title: 'Título da notícia', content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...' },
    { id: 3, title: 'Título da notícia', content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...' },
];

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <NavBar />

        <!-- Cards -->
        <NewsCard :newsList="newsList" />

        <!-- Footer -->
        <Footer />

    </div>
</template>

<style scoped>
</style>
