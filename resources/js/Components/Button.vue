<script setup>

const props=defineProps({
    name:'',
    process:'',
    disableOnly:''
})
</script>

<template>

    <button type="submit" class="formButton" :class="process?'hover:cursor-not-allowed':''" :disabled="process">



        <span v-if="!process">{{name}}</span>

        <svg v-else  xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g><circle cx="3" cy="12" r="2" fill="#888888"></circle><circle cx="21" cy="12" r="2" fill="#888888"></circle><circle cx="12" cy="21" r="2" fill="#888888"></circle><circle cx="12" cy="3" r="2" fill="#888888"></circle><circle cx="5.64" cy="5.64" r="2" fill="#888888"></circle><circle cx="18.36" cy="18.36" r="2" fill="#888888"></circle><circle cx="5.64" cy="18.36" r="2" fill="#888888"></circle><circle cx="18.36" cy="5.64" r="2" fill="#888888"></circle><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></g></svg>
    </button>
</template>
