<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import FooterActions from "@/Components/FooterActions.vue";
import InputError from "@/Components/InputError.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import FormChanged from "@/Components/FormChanged.vue";

const toast = useToast();
const routeName = 'news';

const props = defineProps({
    categories: Object,
    tags: Array,
    errors: Object,
})


const form = useForm({
    title: '',
    description: '',
    category_id: '',
    tags: [],
});
const formErrors = ref({});
const validateForm = () => {

    let isValid = true;
    formErrors.value = {};

    if (!form.title) {
        formErrors.value.title = 'Obrigatório';
        isValid = false;
    }
    if (!form.description) {
        formErrors.value.description = 'Obrigatório';
        isValid = false;
    }
    if (!form.category_id) {
        formErrors.value.category_id = 'Obrigatório';
        isValid = false;
    }

    return isValid;
};
const store = () => {
    if (validateForm()) {
        form.post(route(`${routeName}.store`), {
            onSuccess: () => toast.success('Notícia criada!'),
        });
    }
}

</script>
<template>
    <AuthenticatedLayout>
        <Head :title="'Criar Notícia'" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Criar Notícia'" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="store">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <InputLabel for="title" :value="'Título'" />
                                    <TextInput
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                    />
                                    <InputError v-if="formErrors.title || errors.title" :message="formErrors.title || errors.title" />
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <InputLabel for="description" :value="'Conteúdo'" />
                                    <TextInput
                                        id="description"
                                        v-model="form.description"
                                        type="text"
                                        required
                                    />
                                    <InputError v-if="formErrors.description || errors.description" :message="formErrors.description || errors.description" />
                                </div>

                                <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                    <InputLabel for="category" :value="'Categoria'" />
                                    <SelectInput id="category" v-model="form.category_id" :options="categories" value-key="id" text-key="title" />
                                    <InputError v-if="formErrors.category_id || errors.category_id" :message="formErrors.category_id || errors.category_id" />
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0 mt-4">
                                    <InputLabel for="tags" :value="'Tags'"/>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div v-for="tag in tags" :key="tags.id">
                                            <input
                                                type="checkbox"
                                                :id="tag.id"
                                                :value="tag.id"
                                                v-model="form.tags"
                                            />
                                            {{ tag.slug }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <FooterActions :routeName="routeName" />
                        </form>
                        <FormChanged :state="form.isDirty" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
