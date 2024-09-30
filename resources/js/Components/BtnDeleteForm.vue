<template>
    <a @click="destroySubject" class="bg-red-500 hover:bg-red-700 text-white font-bold p-2 px-4 rounded mb-2 mr-2 delete-button">
        {{ 'Delete' }}
    </a>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

const props = defineProps({
    subjectId: Number,
    routeName: {
        type: String,
        required: true,
    }
});

const form = useForm({});
const destroySubject = () => {
    Swal.fire({
        title: 'Confirma a exclusão?',
        text: 'Não será possível desfazer.',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: 'Sim, pode excluir',
        cancelButtonText: 'Não',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route(`${props.routeName}.destroy`, props.subjectId), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Feito!',
                        text: 'O registro foi excluído!',
                        icon: "success",
                    });
                },
                onError: (errors) => {
                    console.error(errors);
                }
            })
        }
    });
};
</script>
