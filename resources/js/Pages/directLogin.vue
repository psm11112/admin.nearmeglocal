<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm,usePage } from '@inertiajs/vue3'

const props=defineProps({
    user:[],
})


const form = useForm({

    email:props.user.email,
    password:props.user.password,



})

</script>
<template>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-800">
    <div class="flex">
        <div class="w-1/2  pt-28 p-8">

            <div class="shadow-lg p-28  bg-gray-800 rounded-sm ">
                <span class="text-2xl justify-start text-white font-extrabold">WelCome Back, {{user.name}} </span>
                <div class="text-white">Click to Button Go to Admin Penal</div>
                <div class="p-4">
                <input type="text" v-model="form.email">
                    <input type="text" v-model="form.password">
                <button class="bg-blue-600 p-4 text-white font-bold w-full">Go To Admin</button>
                </div>
            </div>


        </div>
        <div class="w-1/2 p-4">
            <img  src="../../../public/images/illustration.svg" width="1200" height="800">
        </div>

    </div>

</div>

</template>
