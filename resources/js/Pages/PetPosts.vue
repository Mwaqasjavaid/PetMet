<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import MainNavLayout from '@/Layouts/MainNavLayout.vue';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import Post from '@/Components/Post.vue';


import AccountMultiple from 'vue-material-design-icons/AccountMultiple.vue'


defineProps({ posts: Object })

const user = usePage().props.auth.user

</script>

<template>
    <Head title="Dashboard" />

    <MainNavLayout>
        <div class="fixed w-full h-[100%] bg-[#F1F2F5]">
            <div class="grid grid-rows-3 grid-flow-col w-full max-w-[1600px] mt-[56px] h-[calc(100%-56px)] mx-auto px-4 pr-[24rem]">
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

                    <CreatePostBox
                        :image="user.image"
                        :placeholder="'Click here to post ' + user.name "
                    />

                    <div v-for="post in posts.data" :key="post">
                        <Post :user="post.user" :post="post" :comments="post.comments" :likes="post.likes" />
                    </div>

                </div>
            </div>
        </div>
    </MainNavLayout>
</template>
