<script setup>
import {usePage} from '@inertiajs/vue3'

</script>
<template>
    <div class="flex space-x-2">

        <svg class="text-2xl animate-waving-hand" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M176.49 95.51a12 12 0 0 1 0 17l-56 56a12 12 0 0 1-17 0l-24-24a12 12 0 1 1 17-17L112 143l47.51-47.52a12 12 0 0 1 16.98.03ZM236 128A108 108 0 1 1 128 20a108.12 108.12 0 0 1 108 108Zm-24 0a84 84 0 1 0-84 84a84.09 84.09 0 0 0 84-84Z"></path></svg>
        <span>
            {{usePage().props.flash.message}}
        </span>
    </div>
</template>
