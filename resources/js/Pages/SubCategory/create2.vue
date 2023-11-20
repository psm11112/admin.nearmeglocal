<script setup>
import Dropdown from 'primevue/dropdown';
import { useForm,Head } from '@inertiajs/vue3'
const props=defineProps({
    category:[]
})

const form = useForm({

    photo:'',
    old_image:props.category.image_url,

})
</script>
<template>
    <Dropdown v-model="form.photo" :options="category" optionLabel="name" placeholder="Select a City" filter class="input" />

</template>
