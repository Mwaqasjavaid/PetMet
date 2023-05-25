<script setup>
import UserNavLayout from "@/Layouts/UserNavLayout.vue";
import { ref } from "vue";
import { post, Inertia } from "@inertiajs/inertia";
import { Link, router, usePage } from "@inertiajs/vue3";
import { toRefs, reactive } from "vue";

const props = defineProps({
    user: Object,
    pets: Object,
});

const { pets, user } = toRefs(props);
</script>

<template>
    <UserNavLayout>
        <div class="">
            <div v-if="successMessage" class="success-message">
                {{ successMessage }}
            </div>

            <!-- <button @click="toggleForm">ADD PETS</button> -->
            <!-- <Link :href="route('addpets', { id: $page.props.auth.user.id })" class="mr-2"> -->
            <!-- ADD PETS -->
            <!-- </Link> -->
            <div class="flex items-center justify-center">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                >
                    <a href="addpets">ADD PETS</a>
                </button>
            </div>
           <div class="flex justify-items-center">
            <h1
                class="mb-2 mt-[50px] text-5xl font-medium leading-tight text-primary "
            >
                User PetList
            </h1>
            </div>
            <div
                class="flex items-center justify-between pb-2"
                
            >
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                        >
                            <div class="overflow-hidden">
                                <table
                                    class="min-w-full text-center text-sm font-light"
                                >
                                    <thead
                                        class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-4 ">
                                                PetID
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="pet in pets"
                                            :key="pet.id"
                                            class="border-b dark:border-neutral-500"
                                        >
                                            <td
                                                class="whitespace-nowrap px-6 py-4 font-medium  cursor-cell bg-white-600 hover:bg-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 "
                                            >
                                               <a :href="`/pet/${pet.id}`">{{ pet.name }}</a> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserNavLayout>
</template>
