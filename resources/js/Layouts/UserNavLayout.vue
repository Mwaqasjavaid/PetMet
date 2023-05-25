<script setup>
    import { ref } from 'vue';
    import { Link, usePage } from '@inertiajs/vue3';
    import CreatePostOverlay from '@/Components/CreatePostOverlay.vue'
    import ImageDisplay from '@/Components/ImageDisplay.vue';

    import Magnify from 'vue-material-design-icons/Magnify.vue'
    import Home from 'vue-material-design-icons/Home.vue'
    import HomeOutline from 'vue-material-design-icons/HomeOutline.vue'
    import TelevisionPlay from 'vue-material-design-icons/TelevisionPlay.vue'
    import StorefrontOutline from 'vue-material-design-icons/StorefrontOutline.vue'
    import AccountGroup from 'vue-material-design-icons/AccountGroup.vue'
    import ControllerClassicOutline from 'vue-material-design-icons/ControllerClassicOutline.vue'
    import DotsGrid from 'vue-material-design-icons/DotsGrid.vue'
    import FacebookMessenger from 'vue-material-design-icons/FacebookMessenger.vue'
    import Bell from 'vue-material-design-icons/Bell.vue'
    import Logout from 'vue-material-design-icons/Logout.vue'

    import UserCropperModal from '@/Components/UserCropperModal.vue';

    import { useGeneralStore } from '@/stores/general';
    import { storeToRefs } from 'pinia';
    const useGeneral = useGeneralStore()
    const { isPostOverlay, isUserCropperModal, isImageDisplay } = storeToRefs(useGeneral)

    const user = usePage().props.auth.user

    let showMenu = ref(false)

</script>

<template>
    
    <div
        id="MainNav"
        class="fixed bg-blue-500 w-full flex items-center justify-between h-[76px] shadow-3xl border-b"
    >
        <div id="NavLeft" class="flex items-center  justify-start w-[260px]">
            <Link :href="route('posts.index')" class="pl-3 min-w-[55px]">
                <img class="w-[55px] rounded-full" src="/images/icons/petmetlogo.jpg">
            </Link>
          
        </div>

      
        <div class="flex   items-center justify-center  bg-transparent border-2 p-1 rounded-full h-[40px] w-[300px]  ml-2">
                <Magnify class="p-1" :size="22" fillColor="white"/>
                <input
                    class="
                    bg-transparent
                        lg:block
                        hidden
                        border-none
                        p-0
                        text-white
                        placeholder-white
                        ring-0
                        focus:ring-0
                    "
                    placeholder="Search here"
                    type="text"
                >
            </div>
        <div class="flex items-center justify-end w-2/12 mr-4">
            
            <button class="rounded-full bg-[#E3E6EA] p-2 hover:bg-gray-300 mx-1 cursor-pointer">
                <Bell :size="23" fillColor="#050505"/>
            </button>
            <div v-if="user" class="flex items-center justify-center relative">
            <button @click="showMenu = !showMenu">
            <img class="rounded-full ml-1 min-w-[40px] max-h-[40px] cursor-pointer" :src="user.image">
            </button>

                <div
                    v-if="showMenu"
                    class="absolute bg-white shadow-xl top-10 right-0 w-[330px] rounded-lg p-1 border mt-1"
                >
                    <Link :href="route('user.show', { id: user.id })" @click="showMenu = !showMenu">
                        <div class="flex items-center gap-3 hover:bg-gray-200 p-2 rounded-lg">
                            <img class="rounded-full ml-1 min-w-[35px] max-h-[35px] cursor-pointer" :src="user.image">
                            <span>{{ user.name }}</span>
                        </div>
                    </Link>
                    <Link
                        class="w-full"
                        :href="route('logout')"
                        as="button"
                        method="post"
                    >
                        <div class="flex items-center gap-3 hover:bg-gray-200 px-2 py-2.5 rounded-lg">
                            <Logout class="pl-2" :size="30"/>
                            <span>Logout</span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <slot  />

  
    
    

    <CreatePostOverlay
        v-if="isPostOverlay"
        @showModal="isPostOverlay = false"
    />

    <UserCropperModal
        v-if="isUserCropperModal"
        @showModal="isUserCropperModal = false"
    />

    <ImageDisplay
        v-if="isImageDisplay"
    />
</template>
