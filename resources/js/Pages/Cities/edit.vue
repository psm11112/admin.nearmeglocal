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



const props=defineProps({
    cities:[]
})

const image=ref('');
const hidden=ref(true);
let stateList=ref(true)
let loading=ref(false);

function success(){
    // form.reset('name');
    ToastMessage()

}
const form = useForm({
    id:props.cities.id,
    name:props.cities.city_name,
    state:null ,
    slug:props.cities.city_slug,
    photo:'',
    old_image:props.cities.city_image,
    about:props.cities.city_about


})

const breadcrumbList=[
    {
        name:'City',
        url:route('cities.index'),
        active:true
    },
    {
        name:'Edit',
        url:'',
        active:false
    },
]

function previewImage(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);
    hidden.value=false;


}
function submit() {

    form.post(route('cities.update'), {
        preserveScroll: true,
        onSuccess: () => success()
    });
}

function getSlug(){

    loading=true;
    axios.get('/api/slug/'+form.name).then((res)=>{

        form.slug=res.data

    });
    loading=false;
}


function deleteImage(){
    form.post(route('cities.delete-image'), {
        preserveScroll: true,
        onSuccess: () => success(),
    })
    form.old_image=null
}




onMounted(() => {

 //   form.state=props.cities.state_id;
    axios.get(route('states.all')).then((res)=>{
        stateList.value=res.data;
        form.state=props.cities.state_id
    });
})

watch(props.cities.state_id, (newValue, prevSelection) => {
    console.log(newValue)

})

</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <div class="formTitle">Update City</div>



        <div class="py-5">


            <Breadcrumb :data="breadcrumbList"></Breadcrumb>

            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <form  @submit.prevent="submit">

                    <div class="grid gap-6 mb-6 md:grid-cols-1">
                        <div>
                            <label for="name" class="formLable" >States</label>
                            <Dropdown
                                :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                 v-model="form.state"
                                :options="stateList"
                                option-value="id"
                                option-label="state_name"
                                placeholder="Select a Category"
                                filter

                                :class="form.errors.state?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                            />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.state" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.state"></ErrorMessage>
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
                                @change="getSlug"
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
                                id="email"
                                type="text"
                                :class="form.errors.slug?'errorInput':'input'"
                                v-model="form.slug"
                                :process="form.processing"
                                autofocus

                            />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.slug" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.slug"></ErrorMessage>
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
                        <Button :name="'Update City'" :process="form.processing"></Button>
                    </div>
                </form>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
