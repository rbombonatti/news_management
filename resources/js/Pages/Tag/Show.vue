<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import InputLabel from "@/Components/InputLabel.vue";
import FooterShow from "@/Components/FooterShow.vue";

const routeName = 'tags';

const props = defineProps({
    tag: Object,
})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="'Detalhes da Tag'" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Detalhes da Tag'" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <InputLabel for="title" :value="'Slug'"/>
                                {{ tag.title }}
                            </div>

                        </div>
                        <FooterShow :routeName="routeName" :subject="tag"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
