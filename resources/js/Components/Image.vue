<script setup>
import VLazyImage from "v-lazy-image";


const props=defineProps({
    url:'',
    name:''
})

</script>
<template>
    <v-lazy-image

        sizes="(max-width: 150px) 200px, 400px, 800p"
        :src="url"
        class=" w-14 h-14 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
        src-placeholder="https://api.iconify.design/line-md:loading-loop.svg?color=%23888888"
        :alt="name"
    />
<!--    <img v-lazy="{ src: '/storage/image/SK7R2rhunMYRe8TofoIOUy1DYvSQzQLxUmNEvaz9.jpg',loading:'https://api.iconify.design/svg-spinners:3-dots-fade.svg' ,error: 'https://api.iconify.design/ph:images-bold.svg' }" class=" w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"     :alt="name">-->

</template>
