<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="
            bg-blue-800
            hover:bg-gray-900
            text-white
            font-bold
            text-[23px]
            p-2.5
            rounded-lg
        "
    >
        <slot />
    </button>
</template>
