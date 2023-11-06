<script setup >
import {defineEmits, defineProps, ref} from "vue";
import Image from "@/Components/Image.vue"
import ToggleButton from "@/Components/ToggleButton.vue"
import {useForm,Link} from "@inertiajs/vue3";
import ToastMessageNotification from "@/helper/ToastMessage";
const baseUrl='/storage/';

const emit= defineEmits(['showView'])

const props=defineProps({
    tableHeader:[],
    data:[],
    deleteRoute:[],
    changeStatusRoute:[],
    userEditName:'',

})



function success(){
    const {ToastMessage}=ToastMessageNotification();
    ToastMessage;

}

const form = useForm({
    id:null,
    status:{},
    page:null
})
function changeStatus(status,id){


    form.status=[
        {id:id, value:status[id] },

    ]
    form.id=id

    form.page=props.data.current_page;
    form.post(props.changeStatusRoute, {
        onSuccess:()=>success()
    })
}



function deleteItem(id){
    form.id=id;
    form.post(props.deleteRoute,{
        preserveState:true,
        preserveScroll:true,
        onSuccess:()=>success()
    });
}

</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" v-if="!form.processing">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>

            <th scope="col" class="p-4" v-for="(name,index) in tableHeader" :key="index">
                <div class="flex items-center">
                    {{name}}
                </div>
            </th>
        </tr>
        </thead>
        <tbody>

        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" v-for="(item,index) in data.data" :key="index">
            <td >
                <div class="flex items-center"  >

                    <span v-if="item.url==null"></span>
                    <span   v-if="item.url!==null">
                                        <Image :url="baseUrl+item.url" :name="item.name"></Image>
                                       </span>
                </div>
            </td>

            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">

                <div class="pl-3">
                    <div class="text-base font-semibold">{{item.name}}</div>

                </div>
            </th>


            <td v-if="item.email" class="px-6 py-4">
                <div class="flex items-center text-base font-semibold">
                    {{item.email}}

                </div>
            </td>


            <td class="px-6 py-4">
                <div class="flex items-center">
                    <ToggleButton  @changeStatus="changeStatus" :id="item.id" :checked="item.is_active" :processing="form.processing" ></ToggleButton>

                </div>
            </td>
            <td class="px-6 py-4 ">
                <!-- Modal toggle -->

                <Link :href="userEditName+item.id"  type="button" class="editButton">
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><g fill="currentColor"><path d="M221.66 90.34L192 120l-56-56l29.66-29.66a8 8 0 0 1 11.31 0L221.66 79a8 8 0 0 1 0 11.34Z" opacity=".2"></path><path d="m227.31 73.37l-44.68-44.69a16 16 0 0 0-22.63 0L36.69 152A15.86 15.86 0 0 0 32 163.31V208a16 16 0 0 0 16 16h44.69a15.86 15.86 0 0 0 11.31-4.69L227.31 96a16 16 0 0 0 0-22.63ZM51.31 160L136 75.31L152.69 92L68 176.68ZM48 179.31L76.69 208H48Zm48 25.38L79.31 188L164 103.31L180.69 120Zm96-96L147.31 64l24-24L216 84.68Z"></path></g></svg>
                </Link>

                <button   @click="$emit('showView',item.id)"  class="viewButton" >
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M247.31 124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57 61.26 162.88 48 128 48S61.43 61.26 36.34 86.35C17.51 105.18 9 124 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208s66.57-13.26 91.66-38.34c18.83-18.83 27.3-37.61 27.65-38.4a8 8 0 0 0 0-6.5ZM128 192c-30.78 0-57.67-11.19-79.93-33.25A133.47 133.47 0 0 1 25 128a133.33 133.33 0 0 1 23.07-30.75C70.33 75.19 97.22 64 128 64s57.67 11.19 79.93 33.25A133.46 133.46 0 0 1 231.05 128c-7.21 13.46-38.62 64-103.05 64Zm0-112a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Z"></path></svg>
                </button>

                <button @click="deleteItem(item.id)" type="button" class="deleteButton">
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M216 48h-36V36a28 28 0 0 0-28-28h-48a28 28 0 0 0-28 28v12H40a12 12 0 0 0 0 24h4v136a20 20 0 0 0 20 20h128a20 20 0 0 0 20-20V72h4a12 12 0 0 0 0-24ZM100 36a4 4 0 0 1 4-4h48a4 4 0 0 1 4 4v12h-56Zm88 168H68V72h120Zm-72-100v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Zm48 0v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Z"></path></svg>
                </button>

            </td>
        </tr>
        </tbody>
    </table>

    <div class="flex justify-center p-10" v-if="form.processing">
        <svg class="text-6xl dark:text-white" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g><circle cx="3" cy="12" r="2" fill="currentColor"></circle><circle cx="21" cy="12" r="2" fill="currentColor"></circle><circle cx="12" cy="21" r="2" fill="currentColor"></circle><circle cx="12" cy="3" r="2" fill="currentColor"></circle><circle cx="5.64" cy="5.64" r="2" fill="currentColor"></circle><circle cx="18.36" cy="18.36" r="2" fill="currentColor"></circle><circle cx="5.64" cy="18.36" r="2" fill="currentColor"></circle><circle cx="18.36" cy="5.64" r="2" fill="currentColor"></circle><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></g></svg>
    </div>
</template>
