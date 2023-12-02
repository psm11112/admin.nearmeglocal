<script setup>
import Dropdown from 'primevue/dropdown';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {onMounted, ref, watch} from 'vue'
import { useForm,usePage,Head } from '@inertiajs/vue3'
import ToastMessage from "@/helper/ToastMessage";
import ErrorMessage from '@/Components/Error.vue'
import Image from '@/Components/Image.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import TextInput from '@/Components/TextInput.vue'
import Button from '@/Components/Button.vue'
import FileUpload from 'primevue/fileupload';



const props=defineProps({
    category:[]
})

const image=ref(null);
const hidden=ref(true);
let cityList=ref(true)
let loading=ref('');

function success(){
    // form.reset('name');
    ToastMessage()

}
const form = useForm({
     id:null,
     city_id:null,
     name:null,
     slug:null,
     about:null


})



const breadcrumbList=[
    {
        name:'Area',
        url:route('area.index'),
        active:true
    },
    {
        name:'Create',
        url:route('area.create'),
        active:true
    },
]

function previewImage(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);
    hidden.value=false;


}
function submit() {

    form.post(route('area.store'), {
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

onMounted(async () => {

    const res = await axios.get(route('cites.all'));
    cityList.value=res.data
    loading.value=false
})

watch(loading, (newValue, prevSelection) => {
    console.log(loading)

})

</script>
<template>
    <Head title="Area"/>
    <AuthenticatedLayout>
        <div class="formTitle">Add New Area</div>



        <div class="py-5">

            <Breadcrumb :data="breadcrumbList"></Breadcrumb>

            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


                <form  @submit.prevent="submit">


                    <div class="grid gap-6 mb-6 md:grid-cols-1">
                        <div>
                            <label for="name" class="formLable" >City</label>
                            <Dropdown
                                reqired
                                :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: loading }"
                                v-model="form.city_id"
                                :options="cityList"
                                option-value="id"
                                option-label="city_name"
                                placeholder="Select a City"
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




                    <div class="p-2">
                        <Button :name="'Add Area'" :process="form.processing"></Button>
                    </div>
                </form>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
