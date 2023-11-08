<script setup>


const props=defineProps({
    url:'',
    name:''
})

</script>
<template>


    <img   v-lazy="{ src: url,loading:'https://api.iconify.design/svg-spinners:3-dots-fade.svg' ,error: 'https://api.iconify.design/ph:images-bold.svg' }" class=" w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"     :alt="name">

</template>
