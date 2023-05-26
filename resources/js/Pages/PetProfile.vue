<script setup>
import {toRefs} from 'vue'
import { Link, Head } from '@inertiajs/vue3';
import MainNavLayout from '@/Layouts/MainNavLayout.vue';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import Post from '@/Components/Post.vue';

import Camera from 'vue-material-design-icons/Camera.vue'
import Pen from 'vue-material-design-icons/Pen.vue'

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';
const useGeneral = useGeneralStore()
const { isCropperModal, isImageDisplay } = storeToRefs(useGeneral)

// defineProps({ , posts: Object })
const props = defineProps({
    pet: Object,
    user: Object,
    posts: Object,
});

const { posts, user, } = toRefs(props);

console.log('pet posts', posts)
</script>

<template>
    <Head title="pet Profile" />

    <MainNavLayout :pet="pet"/>
    <div class="w-full min-h-[100vh] pb-20 bg-[#F1F2F5]">
        <div class="w-full bg-white">
            <div class="max-w-[1100px] pt-[56px] mx-auto pb-1">
                <img class="rounded-b-xl ml-[469px]" src="/images/icons/Petmetlogo.jpg">

                <div id="ProfileInfo" class="flex md:flex-row flex-col items-center justify-between px-4">
                    <div class="flex md:flex-row flex-col gap-4 md:-mt-6 -mt-16 items-center">
                        <div class="relative">
                            <img v-if="pet"
                                class="rounded-full w-[165px] h-[165px] border-white border-4"
                                :src="pet.image"
                            >
                            <button
                                @click="isCropperModal = true"
                                class="absolute right-0 top-[100px] bg-gray-200 hover:bg-gray-300 p-1.5 rounded-full cursor-pointer"
                            >
                                <Camera :pet_id="pet.id" :size="25"/>
                            </button>
                        </div>
                        <div class="md:mt-4 text-center md:text-left -mt-3">
                            <div class="text-[28px] font-extrabold pt-1">
                                {{ pet.name }}
                            </div>

                        </div>
                    </div>

                    <Link
                        :href="route('profile.edit')"
                        class="
                            flex
                            justify-center
                            w-7/12
                            md:w-[160px]
                            items-baseline
                            md:my-0
                            my-4
                            bg-gray-200
                            hover:bg-gray-300
                            rounded-lg
                            cursor-pointer
                        "
                    >
                        <button class="flex items-center px-5 py-2 font-bold">
                            <Pen class="-ml-2 mr-1" :size="22"/> Edit profile
                        </button>
                    </Link>
                </div>

                <div class="flex items-centerw-full border-t h-[50px] py-[4px]">
                    <button class="w-[85px]">
                        <div
                            class="
                                flex
                                items-center
                                text-[15px]
                                justify-center
                                h-[45px]
                                text-blue-500
                                hover:bg-[#F2F2F2]
                                w-full
                                font-bold
                                rounded-lg
                                cursor-pointer
                            "
                        >
                            Posts
                        </div>
                        <div class="border-b-4 border-b-blue-400 rounded-md"></div>
                    </button>
                
                </div>
            </div>
        </div>

        <div class="flex-cols md:flex w-full max-w-[1100px] justify-between h-[calc(100%-56px)] md:px-0 px-2 mx-auto">

            <div id="LeftSection" class="w-full md:w-5/12 mt-4 mr-4">
               

                <div class="bg-white p-3 mt-4 rounded-lg shadow-lg">
                    <div class="font-extrabold pb-2 text-xl">Photos</div>
                    <div class="flex flex-wrap items-center justify-start w-full">
                        <span
                            v-for="photo in posts.data"
                            :key="photo"
                            class="w-1/3"
                            v-show="photo.image !== null"
                        >
                            <img
                                @click="isImageDisplay = photo.image"
                                class="aspect-square object-cover p-1 rounded-lg cursor-pointer"
                                :src="photo.image"
                            >
                        </span>
                    </div>
                </div>
            </div>

            <div id="PostsSection" class="w-full md:w-7/12  overflow-auto">

                <CreatePostBox
                    :pet="pet"
                    :image="pet.image"
                    :placeholder="'What\'s on your mind ' + pet.name "
                />

                <div v-for="post in posts" :key="post">
                    <Post :user="pet" :post="post" :comments="post.comments" />
                </div>

            </div>

        </div>
    </div>
</template>
