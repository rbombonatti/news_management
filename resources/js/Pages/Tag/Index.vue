<script setup>
import Header from "@/Components/Header.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link } from "@inertiajs/vue3";
import 'vue-toast-notification/dist/theme-sugar.css';
import BtnDeleteForm from "@/Components/BtnDeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchBar from "@/Components/SearchBar.vue";

const routeName = 'tags';

const props = defineProps({
    request: {
        type: Object,
    },
    tags: {
        type: Object,
    },

})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="'Tags'" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Tags'" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <SearchBar :placeholder="`Procurar por tag`" :routeName="routeName" :modelValue="request.search" />
                        <div class="hidden lg:flex lg:gap-x-12">
                            <Link :href="route(`${routeName}.create`)" class="edit-button hover:bg-blue-700 mb-4">Criar Nova Tag</Link>
                        </div>
                        <div class="space-y-4">
                            <div class="flex px-4 py-6 border border-gray-200" v-for="tag in tags.data">
                                <div class="md:w-3/4">
                                    <b>{{ tag.slug }}</b>
                                    <br>
                                </div>
                                <div class="md:w-1/4">
                                    <BtnDeleteForm :routeName="routeName" :subjectId="tag.id" >Delete</BtnDeleteForm>
                                    <Link :href="route(`${routeName}.edit`, {tag})" class="edit-button hover:bg-blue-700">Editar</Link>
                                    <Link :href="route(`${routeName}.show`, {tag})" class="edit-button hover:bg-blue-700 ml-2">Detalhes</Link>
                                </div>
                            </div>
                        </div>
                        <div v-if="(!tags.total)" class="text-sm text-center mt-4 mb-4">Nenhum resultado encontrado!</div>
                    </div>
                </div>
                <Pagination :pagination="tags"></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
