<script setup>
import {Head, Link} from "@inertiajs/vue3";
import Search from "@/Components/Search.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

</script>

<template>
    <header class="bg-gray-200 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="w-1/3">
                <h1 class="text-lg font-bold">
                    <Link :href="route('home')" class="hover:text-gray-600">
                    <ApplicationLogo />
                    </Link>
                </h1>
            </div>
            <div class="w-1/3">
                <nav>
                    <ul class="flex space-x-4">
                        <li><a href="#" class="hover:text-gray-600">Cadastrar Notícias</a></li>
                        <Link :href="route('home')" class="hover:text-gray-600">Exibir Notícias</Link>
                    </ul>
                </nav>
            </div>
            <div class="w-1/3" >
                <Search />
            </div>
        </div>
    </header>
</template>

<style scoped>

</style>
