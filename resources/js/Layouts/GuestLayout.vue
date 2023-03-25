<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="h-[100vh] flex flex-col items-center pt-[11px] bg-white">
        <Link :href="route('login')">
            <img width="200" src="/images/icons/Petmetlogo.jpg">
        </Link>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
