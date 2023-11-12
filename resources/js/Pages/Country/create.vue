<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ToastMessage from '@/helper/ToastMessage.js'
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ErrorMessage from '@/Components/Error.vue'
import {ref} from "vue";
import Breadcrumb from '@/Components/Breadcrumb.vue'
const toast= useToast();
let selectedFlag=ref('');

const breadcrumbList=[
    {
        name:'Country',
        url:route('country.index'),
        active:true
    },
    {
        name:'Create',
        url:'',
        active:false
    },

]
const props = defineProps({
    flag: [],
})




const form = useForm({
    name: null,
    svg: null,
    description: null,
})

function success(){
    form.reset('name');
    ToastMessage()

}

function selectFlag(name,svg){
    selectedFlag.value=svg
    form.svg=svg

}
function removeFlag(){
    selectedFlag.value=''
    //console.log(selectdFlag.value);
  console.log("working");
}

</script>


<template>

    <Head title="Country Create"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Country</h2>
        </template>

            <div class="py-5">
                <Breadcrumb :data="breadcrumbList"></Breadcrumb>
                <div class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                    <form  @submit.prevent="form.post('/country/store', {
                    preserveScroll: true,
                    onSuccess: () =>success()})">

                    <div class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>
                            <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <div v-auto-animate class="relative mb-6">
                                <svg v-if="selectedFlag!==''" @click="removeFlag" class="absolute -mt-[7px] -ml-[7px] hover:cursor-pointer hover:bg-gray-50 " xmlns="http://www.w3.org/2000/svg" width="0.8em" height="0.8em" viewBox="0 0 24 24">
                                    <g stroke="#9CA3AF" strokeLinecap="round" strokeWidth="2"><path fill="#9CA3AF" fillOpacity="0" strokeDasharray="60" strokeDashoffset="60" d="M12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s" values="60;0"></animate><animate fill="freeze" attributeName="fill-opacity" begin="0.8s" dur="0.15s" values="0;0.3"></animate></path><path fill="none" strokeDasharray="8" strokeDashoffset="8" d="M12 12L16 16M12 12L8 8M12 12L8 16M12 12L16 8"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="8;0"></animate></path></g></svg>

                                <div class="absolute inset-y-0 left-0 pt-3 items-center pl-2 pointer-events-none">
                                    <span    v-html="selectedFlag"></span>
                                </div>
                                <input :disabled="form.processing" v-model="form.name" type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Country Name">
                                <div class="p-2"  v-if="form.errors.name">
                                    <ErrorMessage  :message="form.errors.name"></ErrorMessage>
                                </div>
                            </div>






                            <PrimaryButton class="formButton pt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <svg v-if="form.processing" xmlns="http://www.w3.org/2000/svg" width="1.7em" height="1.7em" viewBox="0 0 24 24"><g><circle cx="3" cy="12" r="2" fill="#888888"></circle><circle cx="21" cy="12" r="2" fill="#888888"></circle><circle cx="12" cy="21" r="2" fill="#888888"></circle><circle cx="12" cy="3" r="2" fill="#888888"></circle><circle cx="5.64" cy="5.64" r="2" fill="#888888"></circle><circle cx="18.36" cy="18.36" r="2" fill="#888888"></circle><circle cx="5.64" cy="18.36" r="2" fill="#888888"></circle><circle cx="18.36" cy="5.64" r="2" fill="#888888"></circle><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></g></svg>
                                <span v-if="!form.processing">Add Country</span>
<!--                                <div v-if="form.">There are unsaved form changes.</div>-->

                            </PrimaryButton>
                        </div>
                        <div v-auto-animate>
                            <label for="slg" class="formLable">Flag</label>

                            <div class="grid grid-cols-8 sm:grid-cols-12 md:grid-cols-12 space-y-3">
                                <div  class="hover:cursor-pointer"  v-for="(ty,index) in flag" :key="index">
                                    <span @click="selectFlag(ty.name,ty.svg)"  v-html="ty.svg"></span>

                                </div>

                            </div>
                        </div>

                    </div>
                    </form>


                </div>




            </div>


        </AuthenticatedLayout>



</template>
