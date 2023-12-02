<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Table from '@/Components/Table.vue'
import {useForm,Link,usePage} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import Image from "@/Components/Image.vue";
import Search from '@/Components/Search.vue';
import Breadcrumb from "@/Components/Breadcrumb.vue"
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';
import Button from '@/Components/Button.vue'

const props=defineProps({
    'subCategory':[]
})

let subCategoryList=ref(null)

onMounted(() => {
    axios.get('/api/sub-category/all').then((res)=>{

        subCategoryList.value=res.data;
    });
})

const baseUrl='/storage/';
const form = useForm({
    term: null,
    parent_id:null,
    category_id:null
})

const breadcrumbList=[
    {
        name:'Sub Category',
        url:route('sub-category.index'),
        active:true
    },
]


let hidden=ref(true);
let subcategoryHidden=ref(true);
let viewData=ref(null);

function showView(id){
    hidden.value = hidden.value ? false:true
    axios.get('/api/sub-category/view/'+id).then((res)=>{
        viewData.value=res.data;
    });

}

function addSubCategory(id){
    form.parent_id=id;
    subcategoryHidden.value= subcategoryHidden.value?false:true

}

function closeShowView(){
    hidden.value = hidden.value ? false:true
}
function closeSubCategory(){

    subcategoryHidden.value= subcategoryHidden.value?false:true
}
function changeTerm(term){

    form.term=term
    form.get(route('sub-category.index'),{
        preserveState:true,
        preserveScroll:true,
    })

}

function submit(){
    console.log(form.category_id);

    form.post(route('sub-category.add'),{
        preserveState:true,
        preserveScroll:true,
    });



}

</script>

<template>
<Head title="Country"/>
<AuthenticatedLayout>

<div class="formTitle">Sub Category</div>
<div class="py-5">
    <Breadcrumb :data="breadcrumbList"></Breadcrumb>
    <div class="relative overflow-x-auto rounded-lg shadow-lg  sm:rounded-lg p-5">


        <div class="flex items-center justify-between  ">
            <div class="p-5 sm:w-full">

                <div class="flex justify-between w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <div>
                        <Link :href="route('sub-category.create')"    >
                            <button class="formButton p-5" :disabled="form.processing" :class="form.processing?'cursor-not-allowed':''"> Add Sub Category</button>
                        </Link>
                    </div>
                    <Search @generalSearch="changeTerm" :process="form.processing" ></Search>
                </div>

                <!-- Dropdown menu -->

            </div>


        </div>

        <div class="flex justify-center" v-if="!form.processing && subCategory.data.length" >
            <Table
                :imageDisplay="true"
                :svg="true"
                :tableHeader="['','Name','Parent Category','Sub Category','Status','Action']"
                :data="subCategory"
                @showView="showView"
                @addSubCategory="addSubCategory"
                :deleteRoute="route('sub-category.deleted')"
                :changeStatusRoute="route('sub-category.change-status')"
                :userEditName="/sub-category/"
                :multiList="true"
                :view="true"
            ></Table>

        </div>

        <div class="flex justify-center p-5 " v-if="subCategory.data.length">
            <Pagination :pages="subCategory" ></Pagination>

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
                <Image v-if="viewData.image_url!==null"  :url="usePage().props.path.public+viewData.image_url" :name="viewData.name"></Image>
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{viewData.name}}</h5>
                <div class="flex space-x-2 ">
                <svg  xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 256 256"><path fill="#888888" d="M168 116h48a20 20 0 0 0 20-20V48a20 20 0 0 0-20-20h-48a20 20 0 0 0-20 20v12h-4a36 36 0 0 0-36 36v20H84v-4a20 20 0 0 0-20-20H32a20 20 0 0 0-20 20v32a20 20 0 0 0 20 20h32a20 20 0 0 0 20-20v-4h24v20a36 36 0 0 0 36 36h4v12a20 20 0 0 0 20 20h48a20 20 0 0 0 20-20v-48a20 20 0 0 0-20-20h-48a20 20 0 0 0-20 20v12h-4a12 12 0 0 1-12-12V96a12 12 0 0 1 12-12h4v12a20 20 0 0 0 20 20ZM60 140H36v-24h24Zm112 24h40v40h-40Zm0-112h40v40h-40Z" ></path></svg>
                    <div class="mb-1 text-sm font-medium text-gray-900 dark:text-white">{{viewData.parent_category.name}}</div>
                </div>
                <span  class="text-sm font-bold text-gray-500 dark:text-gray-400  space-x-2">

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

    <div
        v-if="!subcategoryHidden"
        v-motion-slide-bottom
        id="" tabindex="-1" aria-hidden="true" class="fixed rounded-full absolute top-48 left-0 right-0 lg:w-full z-50  w-full p-8  overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="flex h-screen justify-center items-center">
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">

                    <button @click="closeSubCategory" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                </div>



                <div class=" flex-col items-center pb-10 space-y-2 p-5">

                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Add Sub Category</h5>

                    <span  class="text-sm font-bold text-gray-500 dark:text-gray-400  space-x-2">

                         <form  @submit.prevent="submit">

                              <Dropdown
                                  :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                  v-model="form.category_id"
                                  :options="subCategoryList"
                                  option-value="id"
                                  option-label="name"
                                  placeholder="Select a Category"
                                  filter

                                  :class="form.errors.category_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                  :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'input'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},

                             }"
                              />

                        <div class="flex p-2 justify-center">

                            <Button :name="'Add'" :process="form.processing"></Button>
                        </div>
                         </form>
                    </span>

                </div>
            </div>

        </div>
    </div>
</AuthenticatedLayout>
</template>
