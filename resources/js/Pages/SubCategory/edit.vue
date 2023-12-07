<script setup>
import Dropdown from 'primevue/dropdown';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {onMounted, ref, watch} from 'vue'
import { useForm,usePage } from '@inertiajs/vue3'
import ToastMessage from "@/helper/ToastMessage";
import ErrorMessage from '@/Components/Error.vue'
import Image from '@/Components/Image.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import TextInput from '@/Components/TextInput.vue'
import Button from '@/Components/Button.vue'
import FileUpload from 'primevue/fileupload';
import MultiSelect from 'primevue/multiselect';


const props=defineProps({
    subCategory:[],
    category:[],
    sub_category_list:[]
})



const image=ref('');
const hidden=ref(true);
let subCategoryList=ref(null);


onMounted(() => {
    axios.get('/api/sub-category/all').then((res)=>{

        subCategoryList.value=res.data;
    });
})

function success(){
    // form.reset('name');
    ToastMessage()

}
const form = useForm({
    id:props.subCategory.id,
    category_id:props.subCategory.category_id,
    name: props.subCategory.name,
    sku: props.subCategory.sku,
    photo:'',
    old_image:props.subCategory.image_url,
    child_category_id:props.subCategory.parent_id


})

const breadcrumbList=[
    {
        name:'Sub Category',
        url:route('sub-category.index'),
        active:true
    },
    {
        name:'Edit',
        url:'',
        active:false
    },
]

function getChildCat(){


    // if(props.subCategory.children){
    //     return props.subCategory.children[0]['id'];
    // }
    // else if(props.subCategory.children[0]['children']){
    //
    //     return  props.subCategory.children[0]['children'][0]['id']
    // }else if(props.subCategory.children[0]['children'][0]['children']){
    //     return  props.subCategory.children[0]['children'][0]['children'];
    // }


}
function previewImage(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);
    hidden.value=false;


}
function submit() {
    form.post(route('sub-category.update'), {
        preserveScroll: true,
        onSuccess: () => success()
    });
}

watch(props.subCategory, (newValue, prevSelection) => {
    console.log(props.subCategory)

})

function onAdvancedUpload(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);

}

function deleteImage(){
    form.post(route('sub-category.delete-image'), {
        preserveScroll: true,
        onSuccess: () => success(),
    })
    form.photo=null
}
</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <div class="formTitle">Update Sub Category</div>
{{subCategory}}

        <div class="py-5">

            <Breadcrumb :data="breadcrumbList"></Breadcrumb>

            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <form  @submit.prevent="submit">
                    <div class="grid gap-6 mb-6 md:grid-cols-1">
                        <div>

                            <label for="name" class="formLable" >Category</label>
                            <Dropdown
                                :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                v-model="form.category_id"
                                :options="category"
                                option-value="id"
                                option-label="name"
                                placeholder="Select a Category"
                                filter
                                class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.category_id" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.category_id"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>

                            <label for="name" class="formLable" >Name</label>

                            <TextInput
                                id="email"
                                type="text"
                                :class="form.errors.name?'errorInput':'input'"
                                v-model="form.name"
                                :process="form.processing"

                                autofocus
                            />

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.name" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.name"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                        <div>
                            <label for="slg" class="formLable">Slag</label>
                            <TextInput
                                type="text"
                                :class="form.errors.sku?'errorInput':'input'"
                                v-model="form.sku"
                                :process="form.processing"

                                autofocus
                            />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.sku" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.sku"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                    </div>


                    <div class="grid gap-6 mb-6 md:grid-cols-1">
                        <div>

                            <label for="name" class="formLable" >Child Category


                            </label>
                            <!--                             <MultiSelect-->
                            <!--                                :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"-->
                            <!--                                v-model="form.child_category_id"-->
                            <!--                                :options="subCategoryList"-->
                            <!--                                option-value="id"-->
                            <!--                                option-label="name"-->
                            <!--                                placeholder="Select a Category"-->
                            <!--                                filter-->
                            <!--                                :class="form.errors.category_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"-->
                            <!--                            />-->

                            <Dropdown
                                :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'input'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                root:{class:'backGrounAndText'},


                            }"

                                :loading="loading"  v-model="form.child_category_id" :options="sub_category_list" filter option-label="category_name" option-value="category_id" placeholder="Select Cities"

                                class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                display="chip"
                            />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.child_category_id" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.child_category_id"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                    </div>


                    <div  class="flex p-2 justify-center items-center">
                        <img v-if="image.length>0" :src="image" class="rounded-lg w-24" title="preview">
                    </div>

                    <div   v-if="image.length<1 && form.old_image"  class="flex p-2 justify-center items-center">

                        <div class="relative me-4">

                            <img v-if="image.length<1 && form.old_image"  :src="usePage().props.path.public+form.old_image" class="rounded-lg w-24" title="preview">

                            <span class="top-0   absolute w-4.5 h-4.5 ">
                                <svg @click="deleteImage" class="text-sm font-bold hover:cursor-pointer hover:bg-indigo-400" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="#00000" d="M168.49 104.49L145 128l23.52 23.51a12 12 0 0 1-17 17L128 145l-23.51 23.52a12 12 0 0 1-17-17L111 128l-23.49-23.51a12 12 0 0 1 17-17L128 111l23.51-23.52a12 12 0 0 1 17 17ZM236 128A108 108 0 1 1 128 20a108.12 108.12 0 0 1 108 108Zm-24 0a84 84 0 1 0-84 84a84.09 84.09 0 0 0 84-84Z"></path></svg>
                            </span>
                        </div>

                    </div>


                                                            <div class="flex items-center justify-center w-full">
                                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6" >
                                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG</p>
                                                </div>
                                                <input id="dropzone-file" @input="form.photo = $event.target.files[0]" type="file" class="hidden" @change="previewImage" />
                                            </label>
                                        </div>
                                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                            <p v-if="form.errors.photo" class="text-sm text-gray-600">
                                                <ErrorMessage  :message="form.errors.photo"></ErrorMessage>
                                            </p>
                                        </Transition>


                    <div class="p-2">
                        <!--                        <button type="submit" class="formButton" :disabled="form.processing">Submit</button>-->

                        <Button :name="'Update Sub Category'" :process="form.processing"></Button>
                    </div>
                </form>

            </div>
            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="text-2xl text-gray-500">Manage Sub Category</div>

                <div class="bg-gray-300 p-2 " v-for="(sub1,index) in subCategory.children" :key="index">
                    {{sub1.name}}
                    <div class="bg-gray-50 border-2  ml-6" v-if="sub1.children" v-for="(sub2,index1)   in sub1.children" :key="index1">
                        {{sub2.name}}
                        <div class="ml-6" v-if="sub2.children" v-for="(sub3,index3)   in sub2.children" :key="index3">
                            {{sub3.name}}

                            <div class="ml-6" v-if="sub3.children" v-for="(sub4,index4)   in sub3.children" :key="index4">
                                {{sub4.name}}
                                <div class="ml-6" v-if="sub4.children" v-for="(sub5,index5)   in sub4.children" :key="index5">
                                    {{sub5.name}}
                                </div>
                            </div>
                        </div>



                    </div>

                </div>



            </div>

        </div>

    </AuthenticatedLayout>
</template>
