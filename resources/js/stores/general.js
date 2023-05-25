import { defineStore } from 'pinia'

export const useGeneralStore = defineStore('general', {
    state: () => ({
        isPostOverlay: false,
        isCropperModal: false,
        isUserCropperModal: false,
        isImageDisplay: null,
    }),
    persist: true,
})
