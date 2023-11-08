<script setup>
import { useForm } from '@inertiajs/vue3'

const props=defineProps({
    check:'',
    id:''
})

const form = useForm({
    status:[],
})


const emit=defineEmits(['statusChange'])


</script>



<template>
    <label class="relative inline-flex items-center mr-5 cursor-pointer">

        <input type="checkbox" @change="$emit('statusChange',form.status,id)" v-model="form.status[id]"  class="sr-only peer" :checked="check" >
        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>

    </label>
</template>
