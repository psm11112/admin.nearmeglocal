<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
// import Button from '@/Components/Button.vue'
import { useForm,usePage } from '@inertiajs/vue3'

const props=defineProps({
    user:[],
})


const form = useForm({

    email:props.user.email,
    password:null,



})

function submit(){
    form.post(route('login'));
}
</script>
<template>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-800">
    <div class="flex">
        <div class="w-1/2  pt-28 p-8">


            <form @submit.prevent="form.post(route('login'))">

            <div class="  p-28  bg-gray-800 rounded-lg shadow shadow-slate-700 shadow-md ">
                <span class="text-2xl justify-start text-white font-extrabold">WelCome Back, {{user.name}} </span>
                <div class="text-white text-sm">Enter Your Password And Click to Button Go to Admin Penal</div>
                <div class="p-4 space-y-2">
                <input type="text" class="input hover:cursor-not-allowed" v-model="form.email">
                <input type="password" class="input" v-model="form.password">
                </div>
                <Button class="w-full" :name="'Go To Admin'" :process="form.processing"></Button>
                <button type="submit" class="w-full rounded-lg bg-purple-600 p-4 text-white text-lg font-extrabold font-rubik hover:bg-green-700 hover:delay-300 hover:duration-500">Go To Admin</button>
            </div>


            </form>

        </div>
        <div class="w-1/2 p-4">
            <img  src="../../../public/images/illustration.svg" width="1200" height="800">
        </div>

    </div>

</div>

</template>
