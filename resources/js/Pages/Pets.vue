<script setup>
import UserNavLayout from "@/Layouts/UserNavLayout.vue";
import { ref } from "vue";
import { post, Inertia } from "@inertiajs/inertia";
import { Link, router, usePage } from "@inertiajs/vue3";
import { toRefs, reactive } from "vue";
import bgImage from "../../../public/images/icons/dogbg.jpg/"
const props = defineProps({
    user: Object,
    pets: Object,
});

const { pets, user } = toRefs(props);

</script>

<template>
    <UserNavLayout>
        <div  class="pb-[120px] pt-8 ">
            <div v-if="successMessage" class="success-message">
                {{ successMessage }}
            </div>

            <!-- <button @click="toggleForm">ADD PETS</button> -->
            <!-- <Link :href="route('addpets', { id: $page.props.auth.user.id })" class="mr-2"> -->
            <!-- ADD PETS -->
            <!-- </Link> -->

            <div class="flex justify-center ">
                <h1
                    class="mb-2 text-[#303234] mt-[50px] text-5xl font-bold leading-tight"
                >
                    User PetList
                </h1>

                
            </div>

            <div class="flex justify-center ">
                <!-- <h1
                    class="mb-2 text-[#] mt-[10px] text-1xl font-bold leading-tight text-blue-500"
                >
                    Click on PET to login
                </h1> -->

                
            </div>
            <div class="flex justify-center pt-6 pb-2">
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
                                        class="border-b flex justify-between font-medium"
                                    >
                        
                                        <!-- <tr>
                                            <th
                                                scope="col"
                                                class="rounded-xl px-10 text-[#303234] py-4 text-4xl"
                                            >
                                                PET
                                            </th>
                                        </tr> -->
                                        <!-- <tr>
                                            <th
                                                scope="col"
                                                class="rounded-xl px-10 text-[#303234] py-4 text-4xl"
                                            >
                                                CATEGORY
                                            </th>
                                        </tr> -->
                                        <!-- <tr>
                                            <th
                                                scope="col"
                                                class="rounded-xl px-16 text-[#303234] py-4 text-4xl"
                                            >
                                                AGE
                                            </th>
                                        </tr> -->
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="pet in pets"
                                            :key="pet.id"
                                            class=" flex justify-between dark:border-neutral-500"
                                        >
                                            <td
                                                class="px-6 ml-0  py-4 hover:text-blue-600  font-bold text-2xl uppercase ">
                                             <div class="flex  flex-row">
                                                <div><img class="rounded-full hover:opacity-50  ml-1 min-w-[65px] max-h-[65px]  cursor-pointer" :src="pet.image"></div>
                                                <div class="ml-4 mt-[15px] hover:opacity-50  text-[#303234]"> <a  :href="`/pet/${pet.id}`"> {{ pet.name }} </a></div>
                                             </div>
                                                   
                                                
                    
                       
                                            </td>
                                            <!-- <td
                                                class="px-6 py-4 font-bold text-2xl uppercase text-center"
                                            >
                                                <a :href="`/pet/${pet.id}`">{{
                                                    pet.category
                                                }}</a>
                                            </td> -->
                                            <!-- <td
                                                class="px-6 py-4 mr-14 font-bold text-2xl uppercase"
                                            >
                                                <a :href="`/pet/${pet.id}`">{{
                                                    pet.age
                                                }}</a><span class="text-[11px]">years</span>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center pt-5 justify-center">
                <button
                    class="bg-blue-500 text-white font-bold py-3 px-10 rounded-full"
                >
                    <a href="addpets">ADD PETS</a>
                </button>
            </div>
        </div>
    </UserNavLayout>
</template>
