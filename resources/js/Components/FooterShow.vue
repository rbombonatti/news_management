<script setup>
import BtnSimple from "@/Components/BtnSimple.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
    subject: {
        type: Object,
        required: true,
    }
})

</script>

<template>

    <div class="max-w-full flex justify-between mt-4">
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <BtnSimple :routeName="`/${routeName}`">{{ 'Cancelar' }}</BtnSimple>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <Link :href="route(`${routeName}.edit`, subject)" class="edit-button hover:bg-blue-700">{{ 'Editar' }}</Link>
        </div>
    </div>

</template>

<style scoped>

</style>
