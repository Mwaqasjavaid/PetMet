<script setup>
import {toRefs} from 'vue'
import { Head, Link, usePage } from '@inertiajs/vue3';
import UserNavLayout from '@/Layouts/UserNavLayout.vue';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import Post from '@/Components/Post.vue';

import Magnify from 'vue-material-design-icons/Magnify.vue'
import TelevisionPlay from 'vue-material-design-icons/TelevisionPlay.vue'
import StorefrontOutline from 'vue-material-design-icons/StorefrontOutline.vue'
import AccountGroup from 'vue-material-design-icons/AccountGroup.vue'
import AccountMultiple from 'vue-material-design-icons/AccountMultiple.vue'
import Flag from 'vue-material-design-icons/Flag.vue'
import ClockTimeTwoOutline from 'vue-material-design-icons/ClockTimeTwoOutline.vue'
import Restore from 'vue-material-design-icons/Restore.vue'
import VideoImage from 'vue-material-design-icons/VideoImage.vue'
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'

// defineProps({ posts: Object })

const user = usePage().props.auth.user
const props = defineProps({
    // pet: Object,
    posts: Object,
});

const { posts, } = toRefs(props);

console.log('pet posts', posts)
</script>

<template>
    <Head title="Dashboard"/>

    <UserNavLayout>
    </UserNavLayout>
    <div class="fixed   w-full h-[100%] bg-[#F1F2F5]" style="z-index:-1;">
        <div class="grid  grid-rows-3 grid-flow-col w-full max-w-[1600px]  h-[calc(100%-56px)] mx-auto px-4 pr-[24rem]">
            <div id="LeftSection" class="xl:w-[345px] lg:block hidden">
                <div class="pt-4 max-w-[320px] pr-4">
                    <Link :href="route('user.show', { id: user.id })" class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] p-2 rounded-md">
                        <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" :src="user.image">
                        <div class="text-[15px] text-gray-800 font-extrabold pl-3">{{ user.name }}</div>
                    </Link>
                    <button class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] px-2 py-1.5 rounded-md">
                        <AccountMultiple :size="40" fillColor="#5BD7C6"/>
                        <div class="text-[15px] text-gray-800 font-extrabold pl-3">Friends</div>
                    </button>
                   
                </div>
            </div>

            <div id="PostsSection" class="row-span-6 max-w-[600px] lg:mx-0 mx-auto overflow-auto ">
                <!-- <CreatePostBox
                    :image="user.image"
                    :placeholder="'Click here to post ' + user.name "
                /> -->

                <div v-for="post in posts" :key="post">
                    <Post :pet="post.pet" :post="post" :comments="post.comments" />
                </div>

            </div>

           
        </div>
    </div>
</template>
