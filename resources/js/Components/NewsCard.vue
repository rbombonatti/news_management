<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    newsList: Object,
})

</script>

<template>
    <section class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                v-for="news in newsList"
                :key="news.id"
                class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between"
                style=" height: 100%;"
            >
                <!-- Categoria e Título -->
                <div>
                    <div class="flex justify-end mb-2">
                        <span class="text-sm text-gray-500">
                            {{ news.category.title }}
                        </span>
                    </div>
                    <h2 class="text-xl font-bold mb-4 truncate" style="max-height: 3em; overflow: hidden;">
                        <Link :href="route('home.details', news.id)">
                            {{ news.title }}
                        </Link>
                    </h2>
                </div>

                <!-- Conteúdo -->
                <p class="text-gray-600 mb-6 flex-grow">
                    {{ news.content }}
                </p>

                <!-- Tags -->
                <div v-if="news.tags.length" class="text-xs mt-4">
                    #{{ [...new Set(news.tags.map((tag) => tag.slug))].join(' #') }}
                </div>

                <!-- Botão Acessar -->
                <div class="flex justify-center mt-6">
                    <Link :href="route('home.details', news.id)" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-blue-600 transition-colors duration-300">
                        Acessar
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>


<style scoped>

</style>
