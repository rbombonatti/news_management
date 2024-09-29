<script setup>
const props = defineProps({
    news: Object,
})

const goBack = () => {
    window.history.back();
}
</script>

<template>
    <div class="flex min-h-max bg-gray-100 py-8 px-4 items-start justify-center">
        <div class="w-full max-w-3xl bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ news.title }}</h1>
            <p class="text-sm text-gray-500 mb-6">
                Categoria: <span class="font-semibold">{{ news.category.title }}</span>
            </p>

            <div class="text-gray-700 leading-relaxed mb-6">
                <p v-html="news.content"></p>
            </div>

            <div v-if="news.tags.length">
                #{{ [...new Set(news.tags.map((tag) => tag.slug))].join(' #') }}
            </div>
            <div class="flex justify-end mt-4">
                <button
                    @click="goBack"
                    class="bg-gray-300 px-4 py-2 text-black rounded-lg hover:bg-blue-600 transition-colors duration-300"
                >
                    Voltar
                </button>
            </div>
        </div>
    </div>
</template>




<style scoped>

</style>
