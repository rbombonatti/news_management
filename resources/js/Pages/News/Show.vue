<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import InputLabel from "@/Components/InputLabel.vue";
import FooterShow from "@/Components/FooterShow.vue";

const routeName = 'news';

const props = defineProps({
    categories: Object,
    tags: Array,
    news: Object,
    newsTags: Array,
})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="'Detalhes de Notícias'"/>
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Detalhes de Notícias'"/>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <InputLabel for="Title" :value="'Título'"/>
                                {{ news.title }}
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="category" :value="'Categoria'"/>
                                {{ news.category.title }}
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="description" :value="'Conteúdo'"/>
                                {{ news.description }}
                            </div>

                            <div class="w-full px-3 mb-6 md:mb-0 mt-4">
                                <InputLabel for="tags" :value="'Tags'"/>
                                <div class="grid grid-cols-3 gap-4">
                                    <div v-for="tag in news.tags" :key="tag.id">
                                        {{ tag.slug }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <FooterShow :routeName="routeName" :subject="news"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
