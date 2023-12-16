<script setup >
import {defineEmits, defineProps, ref} from "vue";
import Image from "@/Components/Image.vue"
import ToggleButton from "@/Components/ToggleButton.vue"
import {useForm,Link,usePage} from "@inertiajs/vue3";
import ToastMessageNotification from "@/helper/ToastMessage";
import GetValue from "@/helper/GetValue.js"
import Chip from 'primevue/chip';

const baseUrl='/storage/';

const emit= defineEmits(['showView'])

const value=GetValue()

const props=defineProps({
    tableHeader:[],
    data:[],
    deleteRoute:[],
    changeStatusRoute:[],
    userEditName:'',
    imageDisplay:'',
    svg:'',
    multiList:'',
    view:true

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

function removeSubCategory(id) {

    form.id=id;
    form.post(route('sub-category.remove'),{
        preserveState:true,
        preserveScroll:true,
        onSuccess:()=>success()
    })



    console.log(id);
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
                <div class="flex items-center p-2"  >

                    <span v-if="item.url==null"></span>
                    <span v-if="item.image_url!==null">
<!--                        <Image v-if="imageDisplay && !item.city_image"  :url="usePage().props.path.public+item.image_url" :name="item.name"></Image>-->
                        <Image :style="'w-14 h-14 p-1 rounded-full ring-1 ring-gray-100 dark:ring-gray-500'" v-if="imageDisplay && item.image_url"  :url="usePage().props.path.public+item.image_url" :name="item.name"></Image>
                        <Image :style="'w-14 h-14 p-1 rounded-full ring-1 ring-gray-100 dark:ring-gray-500'" v-if="imageDisplay && item.city_image"  :url="usePage().props.path.public+item.city_image" :name="item.city_image"></Image>

                            <Image :style="'w-14 h-14 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500'" v-if="imageDisplay && item.feature_image_url"  :url="usePage().props.path.public+item.feature_image_url" :name="item.title"></Image>

                       <span v-if="svg" v-html="item.svg" class="text-2xl"></span>
                    </span>

                </div>
            </td>


            <td v-if="item.title" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.title}}
                </div>

            </td>

            <td v-if="item.category_id" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.parent_category.name}}

                </div>
            </td>
            <td v-if="item.name" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.name}}
                </div>

            </td>

            <td v-if="item.city" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.city.city_name}}
                </div>

            </td>

            <td v-if="item.area_name" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.area_name}}
                </div>

            </td>

            <td v-if="item.state_name" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.state_name}}
                </div>

            </td>

            <td v-if="item.city_name" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.city_name}}
                </div>

            </td>



            <td v-if="item.state_id" scope="row" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.states.state_name}}
                </div>

            </td>


            <td v-if="item.country_id" class="px-1 py-4">
                <div class="flex  text-base font-semibold px-1">
                    <span  v-html="item.country.svg" class="text-2xl"></span>
                </div>
            </td>






            <td v-if="item.email" class="px-1 py-4">
                <div class="flex items-center text-base font-semibold px-1">
                    {{item.email}}

                </div>
            </td>


            <td v-if="item.item_status">
                <div class="flex justify-center items-center text-base font-semibold px-1">

                    <Chip v-if="item.item_status == 2" class="pl-0 pr-3 bg-orange-400 text-white">
                        <span class="bg-orange-800 text-white border-circle flex justify-center   rounded-full w-5 h-5">
                            <span  class="text-sm">P</span>

                            </span>
                        <span class="ml-2 font-rubik ">
                            <span class="" >Published</span>


                            </span>
                    </Chip>

                    <Chip v-if="item.item_status ==1" class="pl-0 pr-3 bg-green-400 text-white">
                        <span class="bg-green-800 text-white border-circle flex justify-center   rounded-full w-5 h-5">

                            <span  class="text-sm">S</span>
                            </span>
                        <span class="ml-2 font-rubik ">

                             <span class="" >Submit</span>

                            </span>
                    </Chip>

                    <Chip v-if="item.item_status ==3" class="pl-0 pr-3 bg-red-400 text-white">
                        <span class="bg-red-800 text-white border-circle flex justify-center   rounded-full w-5 h-5">

                            <span  class="text-sm">S</span>
                            </span>
                        <span class="ml-2 font-rubik ">

                             <span>Suspended</span>

                            </span>
                    </Chip>



                </div>

            </td>
            <td>
                <div class="px-1 flex items-center">



                    <ToggleButton  @statusChange="changeStatus" :id="item.id" :check="value.setValue(item.is_active)" :processing="form.processing" ></ToggleButton>
                </div>
            </td>
            <td class="py-4 space-x-2 ">
                <!-- Modal toggle -->


                <button class="editButton">
                <Link :href="userEditName+item.id"   >
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><g fill="currentColor"><path d="M221.66 90.34L192 120l-56-56l29.66-29.66a8 8 0 0 1 11.31 0L221.66 79a8 8 0 0 1 0 11.34Z" opacity=".2"></path><path d="m227.31 73.37l-44.68-44.69a16 16 0 0 0-22.63 0L36.69 152A15.86 15.86 0 0 0 32 163.31V208a16 16 0 0 0 16 16h44.69a15.86 15.86 0 0 0 11.31-4.69L227.31 96a16 16 0 0 0 0-22.63ZM51.31 160L136 75.31L152.69 92L68 176.68ZM48 179.31L76.69 208H48Zm48 25.38L79.31 188L164 103.31L180.69 120Zm96-96L147.31 64l24-24L216 84.68Z"></path></g></svg>
                </Link>
                </button>


                <button v-if="view"   @click="$emit('showView',item.id)"  class="viewButton" >
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M247.31 124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57 61.26 162.88 48 128 48S61.43 61.26 36.34 86.35C17.51 105.18 9 124 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208s66.57-13.26 91.66-38.34c18.83-18.83 27.3-37.61 27.65-38.4a8 8 0 0 0 0-6.5ZM128 192c-30.78 0-57.67-11.19-79.93-33.25A133.47 133.47 0 0 1 25 128a133.33 133.33 0 0 1 23.07-30.75C70.33 75.19 97.22 64 128 64s57.67 11.19 79.93 33.25A133.46 133.46 0 0 1 231.05 128c-7.21 13.46-38.62 64-103.05 64Zm0-112a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Z"></path></svg>
                </button>

                <button @click="deleteItem(item.id)" type="button" class="deleteButton">
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M216 48h-36V36a28 28 0 0 0-28-28h-48a28 28 0 0 0-28 28v12H40a12 12 0 0 0 0 24h4v136a20 20 0 0 0 20 20h128a20 20 0 0 0 20-20V72h4a12 12 0 0 0 0-24ZM100 36a4 4 0 0 1 4-4h48a4 4 0 0 1 4 4v12h-56Zm88 168H68V72h120Zm-72-100v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Zm48 0v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Z"></path></svg>
                </button>

                <button v-if="multiList" @click="$emit('addSubCategory',item.id)" type="button" class="deleteButton" title="add new sub category">
                    <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><g fill="currentColor"><path d="M88 64a24 24 0 1 1-24-24a24 24 0 0 1 24 24Zm104-24a24 24 0 1 0 24 24a24 24 0 0 0-24-24Z" opacity=".2"></path><path d="M224 64a32 32 0 1 0-40 31v9a16 16 0 0 1-16 16H88a16 16 0 0 1-16-16v-9a32 32 0 1 0-16 0v9a32 32 0 0 0 32 32h32v25a32 32 0 1 0 16 0v-25h32a32 32 0 0 0 32-32v-9a32.06 32.06 0 0 0 24-31ZM48 64a16 16 0 1 1 16 16a16 16 0 0 1-16-16Zm96 128a16 16 0 1 1-16-16a16 16 0 0 1 16 16Zm48-112a16 16 0 1 1 16-16a16 16 0 0 1-16 16Z"></path></g></svg>


                </button>

            </td>
        </tr>
        </tbody>
    </table>

    <div class="flex justify-center p-10" v-if="form.processing">
        <svg class="text-6xl dark:text-white" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g><circle cx="3" cy="12" r="2" fill="currentColor"></circle><circle cx="21" cy="12" r="2" fill="currentColor"></circle><circle cx="12" cy="21" r="2" fill="currentColor"></circle><circle cx="12" cy="3" r="2" fill="currentColor"></circle><circle cx="5.64" cy="5.64" r="2" fill="currentColor"></circle><circle cx="18.36" cy="18.36" r="2" fill="currentColor"></circle><circle cx="5.64" cy="18.36" r="2" fill="currentColor"></circle><circle cx="18.36" cy="5.64" r="2" fill="currentColor"></circle><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></g></svg>
    </div>
</template>
