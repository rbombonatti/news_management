<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link } from "@inertiajs/vue3";
import 'vue-toast-notification/dist/theme-sugar.css';
import BtnDeleteForm from "@/Components/BtnDeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchBar from "@/Components/SearchBar.vue";
import Header from "@/Components/Header.vue";

const routeName = 'news';

const props = defineProps({
    request: {
        type: Object,
    },
    newsList: {
        type: Object,
    },

})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="routeName" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="routeName" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <SearchBar :placeholder="`${routeName}_search`" :routeName="routeName" :modelValue="request.search" />
                        <div class="hidden lg:flex lg:gap-x-12">
                            <Link :href="route(`${routeName}.create`)" class="edit-button hover:bg-blue-700 mb-4">{{ 'create_new' }}</Link>
                        </div>
                        <div class="space-y-4">
                            <div class="flex px-4 py-6 border border-gray-200" v-for="news in newsList.data">
                                <div class="md:w-3/4">
                                    <b>{{ news.title }}</b> <i class="ml-2">({{ news.category.title }})</i>
                                    <br>
                                    <span v-if="news.tags.length" class="text-xs">{{ news.tags.map((item) => item.slug ).join(', ') }}</span>
                                </div>
                                <div class="md:w-1/4">
                                    <BtnDeleteForm :routeName="routeName" :subjectId="news.id" >{{ 'delete' }}</BtnDeleteForm>
                                    <Link :href="route(`${routeName}.edit`, {news})" class="edit-button hover:bg-blue-700">{{ 'edit' }}</Link>
                                    <Link :href="route(`${routeName}.show`, {news})" class="edit-button hover:bg-blue-700 ml-2">{{ 'details' }}</Link>
                                </div>
                            </div>
                        </div>
                        <div v-if="(!newsList.total)" class="text-sm text-center mt-4 mb-4">{{ 'no_results' }}</div>
                    </div>
                </div>
                <Pagination :pagination="newsList"></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
