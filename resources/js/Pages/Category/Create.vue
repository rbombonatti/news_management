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
const routeName = 'categories';

const props = defineProps({
    errors: Object,
})


const form = useForm({
    title: '',
});
const formErrors = ref({});
const validateForm = () => {

    let isValid = true;
    formErrors.value = {};

    if (!form.title) {
        formErrors.value.title = 'Obrigatório';
        isValid = false;
    }

    return isValid;
};
const store = () => {
    if (validateForm()) {
        form.post(route(`${routeName}.store`), {
            onSuccess: () => toast.success('Categoria criada!'),
        });
    }
}

</script>
<template>
    <AuthenticatedLayout>
        <Head :title="'Criar Categoria'" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="'Criar Categoria'" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="store">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
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
