<script setup>
import { toRefs, reactive , computed} from "vue";
import { ref } from 'vue';
import { router, Link, usePage,} from "@inertiajs/vue3";
import { put } from "@inertiajs/inertia";
import AccountMultiple from "vue-material-design-icons/AccountMultiple.vue";
import ThumbUp from "vue-material-design-icons/ThumbUp.vue";
import Check from "vue-material-design-icons/Check.vue";
import Delete from "vue-material-design-icons/Delete.vue";
import axios from 'axios';

import { useGeneralStore } from "@/stores/general";
import { storeToRefs } from "pinia";
const useGeneral = useGeneralStore();
const { isImageDisplay } = storeToRefs(useGeneral);

const form = reactive({ comment: null });

const props = defineProps({
    pet: Object,
    post: Object,
    comments: Object,
    likes: Array,
});
const user = usePage().props.auth.user;
var likeCount = 0;
var liked = false;
const { post, pet, comments,likes } = toRefs(props);
console.log(likes);
const createComment = () => {
    router.post(
        "/comment",
        {
            post_id: post.value.id,
            text: form.comment,
        },
        {
            preserveScroll: true,
        }
    );
};

const checkLikeStatus = () => {
    var res = 0;
    if (likes.value.length > 0) {
        res = likes.value.filter((like) => {
            return like.user_id == user.id
        })
    }
    console.log('like ==>', res);
    liked = res.length > 0 ?  true :  false;
    return liked;  
    // Return true or false based on your condition
    //   return inputValue.value.length > 0;
    
};


const deleteComment = (id) => {
    router.delete("/comment/" + id, {
        preserveScroll: true,
    });
};

const deletePost = (id) => {
    router.delete("/post/" + id, {
        preserveScroll: true,
    });
};

const isUser = () => {
    console.log("fi", props.pet.id, user.id);
    if (props.pet.user_id == user.id) router.get("/pet/" + props.pet.id);
};
// like module here
const toggleLike = (id) => {
    console.log('post_id', id);
  // Make an HTTP request to the like/unlike endpoint using axios.put
  router.put(`/posts/${id}/like`,{ preserveScroll: true});
 
   
};

</script>

<template>
    <div id="Post" class="w-full bg-white rounded-lg my-4 shadow-md">
        <div class="flex items-center py-3 px-3">
            <button @click="isUser" class="mr-2">
                <img
                    class="rounded-full ml-1 min-w-[42px] max-h-[42px]"
                    :src="pet.image"
                />
            </button>
            <div
                class="flex items-center justify-between p-2 rounded-full w-full"
            >
                <div>
                    <div class="font-extrabold text-[15px]">{{ pet.name }}</div>
                    <div class="flex items-center text-xs text-gray-600">
                        {{ post.created_at }}
                        <AccountMultiple
                            class="ml-1"
                            :size="15"
                            fillColor="#64676B"
                        />
                    </div>
                </div>
                <div
                    v-if="post.pet.user_id == $page.props.auth.user.id"
                    class="flex items-center"
                >
                    <button
                        @click="deletePost(post.id)"
                        class="rounded-full p-1.5 cursor-pointer hover:bg-[#F2F2F2]"
                    >
                        <Delete fillColor="#64676B" />
                    </button>
                </div>
            </div>
        </div>
        <div class="px-5 pb-2 text-[17px] font-semibold">{{ post.text }}</div>
        <img
            @click="isImageDisplay = post.image"
            class="mx-auto cursor-pointer"
            :src="post.image"
        />
        <div v-if="post.video">
            <video style="max-height: 100vh;max-width: 100vw;width: 100%;" controls>
                <source :src="post.video" type="video/mp4">
            </video>
        </div>
        <div id="Likes" class="px-5">
            <div class="flex items-center justify-between py-3 border-b">
                <!-- <button @click="">Like</button> -->
                <ThumbUp
                    v-if="checkLikeStatus()"
                    fillColor="blue"
                    :size="16"
                    @click.prevent="toggleLike(post.id)"
                    :class="{ 'text-blue-500': true }"
                    :style="{ cursor: 'pointer' }"
                />
                <ThumbUp
                    v-else
                    fillColor="gray"
                    :size="16"
                    @click.prevent="toggleLike(post.id)"
                    class="text-blue-500"
                    :style="{ cursor: 'pointer' }"
                />
                <div class="text-sm text-gray-600 font-semibold">
                    {{ likes.length }} likes
                </div>
                <div class="text-sm text-gray-600 font-semibold">
                    {{ comments.length }} comments
                </div>
            </div>
        </div>
        <div id="Comments" class="px-3">
            <div
                id="CreateComment"
                class="flex items-center justify-between py-2"
            >
                <div class="flex items-center w-full">
                    <Link
                        :href="
                            route('user.show', { id: $page.props.auth.user.id })
                        "
                        class="mr-2"
                    >
                        <img
                            class="rounded-full ml-1 min-w-[36px] max-h-[36px]"
                            :src="$page.props.auth.user.image"
                        />
                    </Link>
                    <div
                        class="flex items-center justify-center bg-[#EFF2F5] p-2 rounded-full w-full"
                    >
                        <input
                            v-model="form.comment"
                            class="w-full mx-1 border-none p-0 text-sm bg-[#EFF2F5] placeholder-[#64676B] ring-0 focus:ring-0"
                            placeholder="Write a public comment..."
                            type="text"
                        />
                        <button
                            type="button"
                            @click="createComment"
                            class="flex items-center text-sm pl-2 pr-3.5 rounded-full bg-blue-500 hover:bg-blue-600 text-white font-bold"
                        >
                            <Check fillColor="#FFFFFF" :size="20" /> Send
                        </button>
                    </div>
                </div>
            </div>

            <div
                v-if="comments"
                id="Comments"
                class="max-h-[120px] overflow-auto pb-2 px-4"
            >
                <div
                    class="flex items-center justify-between pb-2"
                    v-for="comment in comments"
                    :key="comment"
                >
                    <div class="flex items-center w-full mb-1">
                        <Link :href="route('posts.index')" class="mr-2">
                            <img
                                class="rounded-full ml-1 min-w-[36px] max-h-[36px]"
                                :src="comment.user.image"
                            />
                        </Link>
                        <div class="flex items-center w-full">
                            <div
                                class="flex items-center bg-[#EFF2F5] text-xs p-2 rounded-lg w-full"
                            >
                                {{ comment.text }}
                            </div>
                            <button
                                v-if="
                                    $page.props.auth.user.id === comment.user.id
                                "
                                @click="deleteComment(comment.id)"
                                class="rounded-full p-1.5 ml-2 cursor-pointer hover:bg-[#F2F2F2]"
                            >
                                <Delete fillColor="#64676B" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
