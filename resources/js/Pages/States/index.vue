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
import Search from '@/Components/Search.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue'

import Table from "@/Components/Table.vue";

const props=defineProps({
    'states':[]
})



const breadcrumbList=[
    {
        name:'States',
        url:route('state.index')
    }

]
const toast= useToast();
let hidden=ref(true);
let viewData=ref(null);

const form = useForm({
    term: null,
})
function success(){
    toast.success(ToastMessage ,{
        icon: false,
    })
}

function itemEdit(eId){
    form.get(route('state.edit',{'id':eId}))

}

function changeTerm(term){
    const form = useForm({
        term:null,

    })
    form.term=term
    form.get('/state',{
        preserveState:true,
        preserveScroll:true,
    })

}

function showView(id){
    hidden.value = hidden.value ? false:true
    axios.get('/api/state/view/'+id).then((res)=>{
        viewData.value=res.data;
    });

}

function closeShowView(){
    hidden.value = hidden.value ? false:true
}



</script>
<template>

    <Head title="States"/>
    <AuthenticatedLayout>
        <div class="formTitle">States</div>
        <div class="py-5">


            <!-- Breadcrumb -->

            <Breadcrumb :data="breadcrumbList"></Breadcrumb>


            <div class="relative overflow-x-auto rounded-lg shadow-lg  sm:rounded-lg p-5">
                <div class="flex items-center justify-between  ">
                    <div class="p-5 sm:w-full">
                        <div class="flex justify-between w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <div>
                                <Link :href="route('state.create')" type="submit"  >
                                    <button class="formButton p-5" :disabled="form.processing" :class="form.processing?'cursor-not-allowed':''"> Add States</button>
                                </Link>
                            </div>

                            <Search @generalSearch="changeTerm" ></Search>

                        </div>
                    </div>


                </div>
                <div class="flex justify-center" v-if="!form.processing && states.data.length" >
                    <Table
                        :imageDisplay="false"
                        :svg="true"
                        :tableHeader="['','Name','Country','Status','Action']"
                        :data="states"
                        @showView="showView"
                        :deleteRoute="route('state.deleted')"
                        :changeStatusRoute="route('state.change-status')"
                        :userEditName="/state/"
                    ></Table>

                </div>
                <div class="flex justify-center p-5 " v-if="states.data.length">
                    <Pagination :pages="states" ></Pagination>

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
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{viewData.name}}</h5>
                        <span  class="text-sm font-bold text-gray-500 dark:text-gray-400 flex space-x-2">
                            <div class="flex space-x-2">
                                   <label>Country:</label>
                                      <span  class="text-sm  rounded text-green-400 flex space-x-2 ">
                                         <span>{{viewData.country.name}}</span>
                                      </span>
                            </div>
                        </span>

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
