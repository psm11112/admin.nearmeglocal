<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head,Link,useForm} from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import Serach from '@/Components/Search.vue'
import Table from "@/Components/Table.vue";
import Image from "@/Components/Image.vue"
import Breadcrumb from '@/Components/Breadcrumb.vue'




const breadcrumbList=[
    {
        name:'User',
        url:route('user.index'),
        active:true
    },

]

import {ref} from "vue";

const props=defineProps({
    'user':[],
})

const baseUrl='/images/'

let hidden=ref(true);
let viewData=ref(null);
const form = useForm({
    tearm: null,
})
function generalSearch(teram){


    form.tearm=teram;
    form.get(route('user.index'),{
        preserveState:true,
        preserveScroll:true
    })

}
function showView(id){

    hidden.value = hidden.value ? false:true
    axios.get('/api/user/view/'+id).then((res)=>{
        viewData.value=res.data;
    });

}



function closeShowView(){
    hidden.value = hidden.value ? false:true
}
</script>
<template>
    <Head title="User"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User</h2>
        </template>
        <span class="formTitle">User</span>
        <div  class="h-full my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class="p-5">
                <Breadcrumb :data="breadcrumbList"></Breadcrumb>
                <div class="relative  shadow-md sm:rounded-lg p-8">
                    <div class="flex items-center justify-end p-4">

                        <Serach @generalSearch="generalSearch" :processing="form.processing"></Serach>
                    </div>
                    <Table
                        :tableHeader="['','Name','Email','Status','Action']"
                        :data="user"
                        @showView="showView"
                        :deleteRoute="route('user.delete')"
                        :changeStatusRoute="route('user.change-status')"
                        :userEditName="/user/"
                    ></Table>
                    <!-- Edit user modal -->
                    <div  class="p-5 flex justify-center" v-if="user.data.length">

                        <Pagination :pages="user"></Pagination>
                    </div>
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




<!--                        <Image :url="baseUrl+'user/1.jpg'" :name="viewData.name"></Image>-->
                        <img :src="baseUrl+'user/1.jpg'">

                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{viewData.name}}</h5>
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400 flex space-x-2">
                            <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M224 48H32a8 8 0 0 0-8 8v136a16 16 0 0 0 16 16h176a16 16 0 0 0 16-16V56a8 8 0 0 0-8-8Zm-20.57 16L128 133.15L52.57 64ZM216 192H40V74.19l82.59 75.71a8 8 0 0 0 10.82 0L216 74.19V192Z"></path></svg>
                            <span>   {{viewData.email}} </span>
                        </span>
                        <span v-if="viewData.mobile_number" class="text-sm font-bold text-gray-500 dark:text-gray-400 flex space-x-2">
                            <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M148.41 36.9a12 12 0 0 1 14.69-8.49a90.12 90.12 0 0 1 64.49 64.49a12 12 0 1 1-23.18 6.2a66.42 66.42 0 0 0-47.51-47.51a12 12 0 0 1-8.49-14.69Zm87.44 138.68A60.27 60.27 0 0 1 176 228C94.39 228 28 161.61 28 80a60.27 60.27 0 0 1 52.42-59.85A20.05 20.05 0 0 1 101.2 32l21.11 47.13a1.42 1.42 0 0 0 .08.18a20 20 0 0 1-1.66 18.83a10.67 10.67 0 0 1-.85 1.15L100.82 122c7.06 12.84 20.5 26.16 33.49 33.21l22.31-19a13.08 13.08 0 0 1 1.12-.84a19.91 19.91 0 0 1 19-1.74l.18.08L224 154.8a20.06 20.06 0 0 1 11.85 20.78Zm-24.31-.06l-42-18.81l-22.43 19.07a11.63 11.63 0 0 1-1.11.85a20 20 0 0 1-19.69 1.37c-19.48-9.4-38.89-28.68-48.31-48a20 20 0 0 1 1.28-19.64a10.75 10.75 0 0 1 .86-1.15L99.3 86.49l-18.82-42A36.29 36.29 0 0 0 52 80a124.15 124.15 0 0 0 124 124a36.29 36.29 0 0 0 35.54-28.48Zm-65.91-86.05a32 32 0 0 1 20.9 20.9a12 12 0 0 0 11.44 8.4a12.22 12.22 0 0 0 3.61-.55a12 12 0 0 0 7.84-15a56 56 0 0 0-36.59-36.59a12 12 0 1 0-7.2 22.89Z"></path></svg>
                            <span>{{viewData.mobile_number}} </span>
                        </span>

                        <span  class="text-sm font-bold text-gray-500 dark:text-gray-400 flex space-x-2">
                          <div class="flex space-x-2">
                           <label>Verified:</label>
                              <span v-if="viewData.is_verified" class="text-lg font-medium mr-1 rounded text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M176.49 95.51a12 12 0 0 1 0 17l-56 56a12 12 0 0 1-17 0l-24-24a12 12 0 1 1 17-17L112 143l47.51-47.52a12 12 0 0 1 16.98.03ZM236 128A108 108 0 1 1 128 20a108.12 108.12 0 0 1 108 108Zm-24 0a84 84 0 1 0-84 84a84.09 84.09 0 0 0 84-84Z"></path></svg>
                              </span>
                              <span v-else class="text-lg font-medium mr-1 rounded text-rose-400">

                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm37.66 130.34a8 8 0 0 1-11.32 11.32L128 139.31l-26.34 26.35a8 8 0 0 1-11.32-11.32L116.69 128l-26.35-26.34a8 8 0 0 1 11.32-11.32L128 116.69l26.34-26.35a8 8 0 0 1 11.32 11.32L139.31 128Z"></path></svg>

                              </span>
                          </div>
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
