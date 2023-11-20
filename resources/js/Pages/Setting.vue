<script setup>
import {Head,useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ToastMessage from "@/helper/ToastMessage.js";

const props=defineProps({
    'settings':''
})


const form = useForm({
    field: 'email_verification',
    value: props.settings.value>0 ?true:false,
})


function success(){
    ToastMessage()
}

function submit(){
    form.post(route('setting.store'), {
        preserveScroll: true,
        onSuccess: () =>success()})

}


</script>
<template>
    <Head title="Setting"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Setting</h2>
        </template>
        <span class="formTitle">Setting</span>
        <div class="container  my-12 mx-auto  md:px-12 h-screen">
            <div class="py-5">
                <form>
                <span class="formTitle">Email Verification</span>

<br>
                <label class="relative inline-flex items-center mb-5 cursor-pointer">
                    <input @change="submit" v-model="form.value" type="checkbox" value="" class="sr-only peer" :checked="1" >
                    <div  class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300 font-bold "></span>
                </label>

                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
