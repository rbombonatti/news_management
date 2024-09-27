<script setup>

const props = defineProps({
    newsList: Object,
})

</script>

<template>
    <section class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div v-for="news in newsList" :key="news.id" class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">{{ news.title }}</h2>
                <p class="text-gray-600 mb-6">{{ news.content }}</p>
                <div class="flex justify-center">
                    <button class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Acessar</button>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
