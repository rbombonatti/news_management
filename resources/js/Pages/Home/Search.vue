<script setup>

import {Head, Link} from "@inertiajs/vue3";
import NavBar from "@/Components/NavBar.vue";

const props = defineProps({
    results: {
        type: Array,
        required: true,
    },
    search: {
        type: String,
    }
})

</script>

<template>

    <Head title="Busca" />
    <NavBar :search="search" />
    <section class="container mx-auto py-8 px-4">

        <h1 class="text-3xl font-bold mb-8 text-gray-800">Resultados da Busca - <i class="text-blue-400">{{ search }}</i></h1>

        <div v-if="results.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div
                v-for="news in results"
                :key="news.id"
                class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between h-full"
            >

                <div>
                    <p class="text-sm text-gray-500 mb-2">
                        Categoria: <span class="font-semibold">{{ news.category.title }}</span>
                    </p>
                    <h2 class="text-xl font-bold text-gray-800 mb-4 truncate">{{ news.title }}</h2>
                </div>

                <!-- Trecho do Conteúdo -->
                <div class="text-gray-700 mb-6">
                    {{ news.content.length > 100 ? news.content.substring(0, 100) + '...' : news.content }}
                </div>

                <!-- Tags -->
                <div v-if="news.tags.length" class="text-xs text-gray-500 mt-auto mb-4">
                    #{{ [...new Set(news.tags.map(tag => tag.slug))].join(' #') }}
                </div>

                <!-- Botão Ver Mais -->
                <div class="flex justify-end mt-4">
                    <Link :href="route('news.details', news.id)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                        Ver mais
                    </Link>
                </div>
            </div>
        </div>

        <!-- Mensagem de nenhum resultado encontrado -->
        <div v-else class="text-center text-gray-500">
            <p class="text-xl">Nenhum resultado encontrado</p>
        </div>
    </section>
</template>

<style scoped>

</style>
