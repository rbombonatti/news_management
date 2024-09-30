<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import FooterActions from "@/Components/FooterActions.vue";
import InputError from "@/Components/InputError.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import FormChanged from "@/Components/FormChanged.vue";

const toast = useToast();
const routeName = 'tags';

const props = defineProps({
    tag: Object,
    errors: Object
})

const form = useForm({
    slug: props.tag.slug,
});
const formErrors = ref({});

const validateForm = () => {
    formErrors.value = {}; // Reset errors
    let isValid = true;

    if (!form.slug) {
        formErrors.value.slug = 'Obrigatório';
        isValid = false;
    }
    return isValid;
};
const update = () => {
    if (validateForm()) {
        form.put(route(`${routeName}.update`, props.tag.id), {
            onSuccess: () => toast.success('Tag atualizada!')
        });
    }
}

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="'Editar Categoria'" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Editar Categoria'" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="update">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <InputLabel for="slug" :value="'Slug'" />
                                    <TextInput
                                        id="title"
                                        v-model="form.slug"
                                        type="text"
                                        required
                                        />
                                    <InputError v-if="formErrors.slug || errors.slug" :message="formErrors.slug || errors.title" />
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
