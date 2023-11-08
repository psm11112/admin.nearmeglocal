<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import {ref} from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import {useToast} from "vue-toastification";
import ToastMessage from "@/Components/Totast.vue";
import Table from "@/Components/Table.vue";

import Breadcrumb from '@/Components/Breadcrumb.vue'




const breadcrumbList=[
    {
        name:'Country',
        url:route('country.index'),
        active:true
    },
]


const props=defineProps({
    'country':[]
})

const toast= useToast();
let hidden=ref(true);
let viewData=ref(null);

const form = useForm({
    term: null,
    status:[],
    id:null,


})

function  search(){

    form.get('/country',{
        preserveState:true,
        preserveScroll:true,
        onSuccess: () => '',
    })



}

function showView(id){

    hidden.value = hidden.value ? false:true
    axios.get('/api/country/view/'+id).then((res)=>{
        viewData.value=res.data;
    });

}

function closeShowView(){
    hidden.value = hidden.value ? false:true
}



</script>
<template>

    <Head title="Country"/>
    <AuthenticatedLayout>

            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Country</h2>
            </template>
        <span class="formTitle">Country</span>
            <div class="py-5">
                <Breadcrumb :data="breadcrumbList"></Breadcrumb>

                <div class="relative overflow-x-auto rounded-lg shadow-lg  sm:rounded-lg p-5">
                    <div class="flex items-center justify-between  ">
                        <div class="p-5 sm:w-full">
                            <div class="flex justify-between w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <div>
                            <Link :href="route('country.create')" type="submit"  >
                                <button class="formButton p-5" :disabled="form.processing" :class="form.processing?'cursor-not-allowed':''"> Add Country</button>
                            </Link>
                                </div>

                                <div class="w-1/2">
                                    <form>

                                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg v-if="!form.processing" class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>

                                            <svg v-if="form.processing" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="4" cy="12" r="3" fill="currentColor"><animate id="svgSpinners3DotsFade0" fill="freeze" attributeName="opacity" begin="0;svgSpinners3DotsFade1.end-0.25s" dur="0.75s" values="1;.2"></animate></circle><circle cx="12" cy="12" r="3" fill="currentColor" opacity=".4"><animate fill="freeze" attributeName="opacity" begin="svgSpinners3DotsFade0.begin+0.15s" dur="0.75s" values="1;.2"></animate></circle><circle cx="20" cy="12" r="3" fill="currentColor" opacity=".3"><animate id="svgSpinners3DotsFade1" fill="freeze" attributeName="opacity" begin="svgSpinners3DotsFade0.begin+0.3s" dur="0.75s" values="1;.2"></animate></circle></svg>

                                        </div>
                                        <input @keyup="search()" v-model="form.term" type="search" id="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                                        <button :disabled="form.processing" type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-purple-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                    </div>
                                </form>
                                </div>
                            </div>

                            <!-- Dropdown menu -->

                        </div>


                    </div>
                    <div class="flex justify-center" v-if="!form.processing && country.data.length" >
                        <Table
                            :tableHeader="['','Name','Status','Action']"
                            :data="country"
                            @showView="showView"
                            :deleteRoute="route('country.deleted')"
                            :changeStatusRoute="route('country.change-status')"
                            :userEditName="/country/"
                        ></Table>

                    </div>

                    <div class="flex justify-center p-5 " v-if="country.data.length">
                        <Pagination :pages="country" ></Pagination>

                    </div>
                </div>
            </div>

        <div
            v-if="!hidden"
            v-motion-slide-bottom
            id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed rounded-full absolute top-48 left-0 right-0 lg:w-full z-50  w-full p-8  overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="flex h-screen justify-center items-center">
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-4">

                        <button @click="closeShowView" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                    </div>
                    <div class="flex flex-col items-center pb-10 space-y-2">
                        <span  class="rounded-full bg-pink-500" v-html="viewData.svg"></span>
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{viewData.name}}</h5>

                        <span  class="text-sm font-bold text-gray-500 dark:text-gray-400 flex space-x-2">

                              <div class="flex space-x-2">
                           <label>Active:</label>
                              <span v-if="viewData.is_active" class="text-lg font-medium mr-1 rounded text-green-400 ">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M176.49 95.51a12 12 0 0 1 0 17l-56 56a12 12 0 0 1-17 0l-24-24a12 12 0 1 1 17-17L112 143l47.51-47.52a12 12 0 0 1 16.98.03ZM236 128A108 108 0 1 1 128 20a108.12 108.12 0 0 1 108 108Zm-24 0a84 84 0 1 0-84 84a84.09 84.09 0 0 0 84-84Z"></path></svg>
                              </span>
                                    <span v-else class="text-lg font-medium mr-1 rounded  text-rose-400">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm37.66 130.34a8 8 0 0 1-11.32 11.32L128 139.31l-26.34 26.35a8 8 0 0 1-11.32-11.32L116.69 128l-26.35-26.34a8 8 0 0 1 11.32-11.32L128 116.69l26.34-26.35a8 8 0 0 1 11.32 11.32L139.31 128Z"></path></svg>
                              </span>
                          </div>
                        </span>

                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>

</template>
