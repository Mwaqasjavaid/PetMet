<script setup>

    import { toRefs } from 'vue';
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

    import CropperModal from '@/Components/CropperModal.vue';

    import { useGeneralStore } from '@/stores/general';
    import { storeToRefs } from 'pinia';
    const useGeneral = useGeneralStore()
    const { isPostOverlay, isCropperModal, isImageDisplay } = storeToRefs(useGeneral)

    const props = defineProps({
        pet: Object,
    });

    const { pet } = toRefs(props)
    console.log('my pet profile', pet)
    const user = usePage().props.auth.user

    let showMenu = ref(false)

</script>

<template>
    <div
        id="MainNav"
        class="fixed z-50 w-full flex items-center justify-between h-[56px] bg-white shadow-xl border-b"
    >
        <div id="NavLeft" class="flex items-center justify-start w-[260px]">
            <Link :href="route('posts.index')" class="pl-3 min-w-[55px]">
                <img class="w-[55px]" src="/images/icons/petmetlogo.jpg">
            </Link>
            <!-- <div class="flex items-center justify-center bg-[#EFF2F5] p-1 rounded-full h-[40px] ml-2">
                <Magnify class="p-1" :size="22" fillColor="#64676B"/>
                <input
                    class="
                        lg:block
                        hidden
                        border-none
                        p-0
                        bg-[#EFF2F5]
                        placeholder-[#64676B]
                        ring-0
                        focus:ring-0
                    "
                    placeholder="Search here"
                    type="text"
                >
            </div> -->
        </div>

        <div id="NavCenter" class="hidden lg:flex items-center ml-5 justify-center w-8/12 max-w-[600px]">
            <Link class="w-full" :href="route('posts.index')">
                <div
                    :class="$page.url === '/' ? 'mt-1.5' : '' "
                    class="flex items-center justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-full rounded-lg cursor-pointer"
                >
                    <div>
                        <Home v-if="$page.url === '/'" class="mx-auto" :size="27" fillColor="#1A73E3"/>
                        <HomeOutline v-else class="mx-auto" :size="32" fillColor="#64676B"/>
                    </div>
                </div>
                <div
                    v-if="$page.url === '/'"
                    class="border-b-4 border-b-blue-400 rounded-md"
                ></div>
            </Link>
            
        </div>
        <div class="flex items-center justify-end w-2/12 mr-4">
            
            <!-- <button class="rounded-full bg-[#E3E6EA] p-2 hover:bg-gray-300 mx-1 cursor-pointer">
                <Bell :size="23" fillColor="#050505"/>
            </button> -->
            <div class="flex items-center justify-center relative">
                <button @click="showMenu = !showMenu">
                    <img v-if="pet.image" class="rounded-full ml-1 min-w-[40px] max-h-[40px] cursor-pointer" :src="pet.image">
                    <img v-else class="rounded-full ml-1 min-w-[40px] max-h-[40px] cursor-pointer" src="/images/user-placeholder.png">
                </button>
                <div
                    v-if="showMenu"
                    class="absolute bg-white shadow-xl top-10 right-0 w-[330px] rounded-lg p-1 border mt-1"
                >
                    <Link >
                        <div class="flex items-center gap-3 hover:bg-gray-200 p-2 rounded-lg">
                            <img class="rounded-full ml-1 min-w-[35px] max-h-[35px] cursor-pointer" :src="pet.image">
                            <span>{{ pet.name }}</span>
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
                            <span>Logout user</span>
                        </div>
                    </Link>
                    <Link 
                    class="w-full"
                        href="/changepet"
                        as="button"
                        method="get">
                      <div class="flex items-center gap-3 hover:bg-gray-200 px-2 py-2.5 rounded-lg">
                            <Logout class="pl-2" :size="30"/>
                             <span>change Pet</span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <slot />

    <CreatePostOverlay
        v-if="isPostOverlay"
        @showModal="isPostOverlay = false"
        :pet="pet"
    />

    <CropperModal
        v-if="isCropperModal"
        @showModal="isCropperModal = false"
        :pet="pet"
    />

    <ImageDisplay
        v-if="isImageDisplay"
    />
</template>
