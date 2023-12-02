<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Dropdown from 'primevue/dropdown';
import TextInput from '@/Components/TextInput.vue'
import Panel from 'primevue/panel';
import {useForm, usePage} from '@inertiajs/vue3'
import MultiSelect from 'primevue/multiselect';
import {onMounted, ref} from "vue";
import Steps from 'primevue/steps';
import Button from '@/Components/Button.vue'
import Input from '@/Components/TextInput.vue'
import InputText from 'primevue/inputtext';
import GetSlug from "@/helper/GetSlug"
import {GoogleMap, Marker} from "vue3-google-map";
import FileUpload from 'primevue/fileupload';
import InputSwitch from 'primevue/inputswitch';
import ErrorMessage from '@/Components/Error.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import ToastMessage from "@/helper/ToastMessage";
import { useToast } from 'vue-toastification'



const ToastMessageError = useToast()




let loading = ref(false);
const subCategory = ref();
let from_load = ref(false)
let hidden = ref(true);
let stats=ref(null);
let city=ref(null);
let area=ref(null);
let image=ref(null);

let hours = "Monday: 10pm to 1pm And 2pm to 5pm\n" +
    "Tuesday: 10pm to 1pm And 2pm to 5pm\n" +
    "Wednesday: 10pm to 1pm And 2pm to 5pm\n" +
    "Thursday: 10pm to 1pm And 2pm to 5pm\n" +
    "Friday : 10pm to 1pm And 2pm to 5pm\n" +
    "Saturday:10pm to 1pm\n" +
    "Sunday :close"

let center = {lat: '', lng: ''};
const props = defineProps({
    category: [],
    country:[],
    // subCategory:[]
})


let itemFeaturedList=[
    {
        value:1,
        name:'Yes',

    },
    {
        value:0,
        name:'No',

    },
]
let generalFeatures=[
    {
        name:'Offering a Deal'
    },
    {
        name:'Accepts Credit Cards'
    },
    {
        name:'Good For Kids'
    },
    {
        name:'Wheelchair Accessible'
    },
    {
        name:'By Appointment Only'
    },
    {
        name:'Dogs Allowed'
    },
    {
        name:'Sells Gift Certificates'
    },
    {
        name:'Hot And New'
    },
    {
        name:'Offers Military Discount'
    },
    {
        name:'Gender Neutral Restrooms'
    },
    {
        name:'Open to All'
    },
];

let parkingList=[
    {
        name:'Street'
    },
    {
        name:'Garage'
    },
    {
        name:'Private Lot'
    },
    {
        name:'Validated',
    },
    {
        name:'Valet',
    },
]

const breadcrumbList=[
    {
        name:'List',
        url:route('list.index'),
        active:true
    },
    {
        name:'Create',
        url:route('list.create'),
        active:true
    },
]

let wifiList=[
    {name:'Paid'},
    {name:'Free'}
]

const form = useForm({
    title: null,
    title_slug: null,
    category_id:null,
    sub_category_id:null,
    country_id:null,
    city_id:null,
    state_id:null,
    area_id:null,
    post_code:null,
    address:null,
    longitude:null,
    latitude:null,
    phone_number:null,
    youtub_video_id:null,
    description:null,
    website:null,
    business_email:null,
    business_watsapp_url:null,
    facebook:null,
    twitter:null,
    linked_in:null,
    whatsapp_chat:null,
    email:null,
    price_range:null,
    general_features:null,
    request_an_appointment:null,
    wifi:null,
    hours:hours,
    banner:null,
    feature:null,
    item_featured:null,
    parking:null,
    dfr:null
})

function selectSubCategory() {
    loading.value = true
    axios.post('/api/sub-category', form).then((res) => {
        console.log(res.data);
        subCategory.value = res.data;
    });
    loading.value = false

}

function fromLoad() {
    from_load.value = true;
}

function getSlug() {

    loading.value = true;
    let slug = GetSlug(form.title);
    slug.asyncCall().then((res) => {
        form.title_slug = res.data
        loading.value = false
    });


}
function selectStateByCountry(){
    loading.value = true;
    axios.get('/api/stats/'+form.country_id).then((res)=>{
        stats.value=res.data;
    });
    loading.value = false;

}

function selectCityByStats(){
    loading.value = true;
    axios.get('/api/city/'+form.state_id).then((res)=>{
        city.value=res.data;
    });
    loading.value = false;

}

function selectAreaByCity(){
    loading.value=true;
    axios.get('/api/area/'+form.city_id).then((res)=>{
        area.value=res.data;
    });
    loading.value = false;

}

function showMap() {
    window.scrollTo(0, 0);
    hidden.value = false;
    center = {
        'lat': Number(form.latitude),
        'lng': Number(form.longitude)

    }

}


function success(){
    ToastMessage("Validation Error")

}

function error(){
    ToastMessageError.error("Validation Error")
}

function closeShowView() {
    hidden.value = true;
}

function submit() {

    form.post(route('list.store'), {
        preserveScroll: false,
        onSuccess: () => success(),
        onError:()=>error()
    });



}

function onAdvancedUpload(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);

}



function onAdvancedUploadMutipal(e){
    form.dfr=e.files;
}

</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <div class="formTitle">Add A Listing</div>
        <div class="text-2xs text-gray-400">This page allows you to create a new business listing record.</div>


        <div class="py-5">
            <Breadcrumb :data="breadcrumbList"></Breadcrumb>

            <form>

                <div
                    class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow-lg shadow-gray-300/10 dark:bg-gray-800 dark:border-gray-700">
                    <small class="text-rose-500 font-bold">* Must Be Required</small>
                    <Panel :header="'Category Information'  " toggleable
                           :pt="{
                            header:{class:'backGrounAndText'},
                            toggleableContent:{class:'backGrounAndText'},
                            content:{class:'backGrounAndText'},
                            root:{class:'backGrounAndText'},
                        }">



                        <div class="p-2">
                            <div class="flex">
                            <label  class="formLable">Category
                                <small class="text-rose-500">*</small>
                            </label>

                            </div>
                            <Dropdown
                                :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                v-model="form.category_id"
                                :options="category"
                                option-value="id"
                                option-label="name"
                                placeholder="Select a Category"
                                filter
                                @change="selectSubCategory"
                                :class="form.errors.category_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'input'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},

                             }"
                            />
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.category_id" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.category_id"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                        <div class="p-2">
                            <label class="formLable ">Sub Category
                                <small class="text-rose-500">*</small>
                            </label>
                            <MultiSelect
                                :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                root:{class:'backGrounAndText'},


                            }"

                                :loading="loading" v-model="form.sub_category_id" :options="subCategory" filter
                                optionLabel="name" placeholder="Select Cities"

                                class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                display="chip"
                            />

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.sub_category_id" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.sub_category_id"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>
                        <div class="p-2">
                            <Button @click.prevent="fromLoad()" name="Load From" :process="!form.sub_category_id"
                                    :disableOnly="true"></Button>
                        </div>
                    </Panel>

                    <div v-motion-slide-top v-if="from_load" class="py-2">

                        <Panel :header="'General Information'  " toggleable
                               :pt="{
                            header:{class:'backGrounAndText'},
                            toggleableContent:{class:'backGrounAndText'},
                            content:{class:'backGrounAndText'},
                            root:{class:'backGrounAndText'},
                        }">

                            <div class="grid grid-cols-3">


                                <div class="p-2">
                                    <label class="formLable ">Title  <small class="text-rose-500">*</small></label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.title?'errorInput':'input'"
                                        v-model="form.title"
                                        :process="form.processing"
                                        @change="getSlug"
                                        autofocus
                                    />


                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.title" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.title"></ErrorMessage>
                                        </p>
                                    </Transition>

                                </div>
                                <div class="p-2">
                                    <label class="formLable ">Slug  <small class="text-rose-500">*</small></label>
                                    <i class="pi pi-spin pi-spinner"/>
                                    <div class="relative mb-6">
                                        <div v-if="loading"
                                             class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg v-auto-animate xmlns="http://www.w3.org/2000/svg" width="1em"
                                                 height="1em" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
                                                    <animateTransform attributeName="transform" dur="0.75s"
                                                                      repeatCount="indefinite" type="rotate"
                                                                      values="0 12 12;360 12 12"></animateTransform>
                                                </path>
                                            </svg>
                                        </div>
                                        <input :disabled="loading" type="text" v-model="form.title_slug"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder="name@flowbite.com">
                                    </div>

                                </div>
                                <div class="p-2">
                                    <label class="formLable ">Item Featured</label>


                                    <Dropdown
                                        :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                        v-model="form.item_featured"
                                        :options="itemFeaturedList"
                                        option-value="value"
                                        option-label="name"
                                        placeholder="Select a Featured"

                                        :class="form.errors.item_featured?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'input'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},

                             }"
                                    />
                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.item_featured" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.item_featured"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>

                            </div>

                            <div class="grid grid-cols-3">
                                <div class="p-2">


                                    <label class="formLable ">Country  <small class="text-rose-500">*</small></label>
                                    <Dropdown
                                        :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                        v-model="form.country_id"
                                        :options="country"
                                        option-value="id"
                                        option-label="name"
                                        placeholder="Select a Category"
                                        filter
                                        @change="selectStateByCountry"
                                        :class="form.errors.country_id ?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                 item:{class:'itemDropDown'}

                             }"
                                    />


                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.country_id " class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.country_id"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>
                                <div class="p-2">
                                    <label class="formLable ">State  <small class="text-rose-500">*</small></label>
                                    <Dropdown
                                        :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader:loading  }"
                                        v-model="form.state_id"
                                        :options="stats"
                                        option-value="id"
                                        option-label="state_name"
                                        placeholder="Select a State"
                                        filter
                                        @change="selectCityByStats"

                                        :loading="loading"
                                        :class="form.errors.category_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                 item:{class:'itemDropDown'}

                             }"
                                    />
                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.state_id" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.state_id"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>
                                <div class="p-2">
                                    <label  class="formLable ">City  <small class="text-rose-500">*</small></label>
                                    <Dropdown
                                        :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                        v-model="form.city_id"
                                        :options="city"
                                        option-value="id"
                                        option-label="city_name"
                                        placeholder="Select a Category"
                                        filter
                                        @change="selectAreaByCity"
                                        :class="form.errors.city_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                itemGroup:{class:'backGrounAndText'},
                                item:{class:'itemDropDown'}

                             }"
                                    />


                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.city_id" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.city_id"></ErrorMessage>
                                        </p>
                                    </Transition>

                                </div>


                            </div>
                            <div class="grid grid-cols-2">
                                <div class="p-2">
                                    <label  class="formLable ">Area  <small class="text-rose-500">*</small></label>
                                    <Dropdown
                                        :virtualScrollerOptions="{ lazy: true, onLazyLoad: true, itemSize: 48, showLoader: true, loading: false }"
                                        v-model="form.area_id"
                                        :options="area"
                                        option-value="id"
                                        option-label="area_name"
                                        placeholder="Select a Area"
                                        filter
                                        :class="form.errors.area_id?'errorInput':'w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"

                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                itemGroup:{class:'backGrounAndText'},
                                item:{class:'itemDropDown'}

                             }"
                                    />

                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.area_id" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.area_id"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>
                                <div class="p-2">
                                    <label  class="formLable ">Post Code  <small class="text-rose-500">*</small></label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.post_code?'errorInput':'input'"
                                        v-model="form.post_code"
                                        :process="form.processing"

                                        autofocus
                                    />
                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.post_code" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.post_code"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 w-full">

                                <div class="p-2">
                                    <label  class="formLable ">Address  <small class="text-rose-500">*</small></label>
                                    <textarea class="input" v-model="form.address"></textarea>

                                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                        <p v-if="form.errors.address" class="text-sm text-gray-600">
                                            <ErrorMessage  :message="form.errors.address"></ErrorMessage>
                                        </p>
                                    </Transition>
                                </div>

                            </div>


                            <div class="grid grid-cols-4 ">

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Latitude</span>

                                            <div v-if="form.longitude && form.latitude ">
                                                <svg @click="showMap"
                                                     class="text-2xl animate-waving-hand hover:cursor-pointer"
                                                     xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                     viewBox="0 0 24 24">
                                                    <g fill="currentColor">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                              stroke-width="2"
                                                              d="M12 20.5C12 20.5 6 13.5 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9C18 13.5 12 20.5 12 20.5z">
                                                            <animate fill="freeze" attributeName="d" dur="0.4s"
                                                                     keyTimes="0;0.7;1"
                                                                     values="M12 20.5C12 20.5 11 19 11 18C11 17.5 11.5 17 12 17C12.5 17 13 17.5 13 18C13 19 12 20.5 12 20.5z;M12 20.5C12 20.5 5 13 5 8C5 4.5 8 1 12 1C16 1 19 4.5 19 8C19 13 12 20.5 12 20.5z;M12 20.5C12 20.5 6 13.5 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9C18 13.5 12 20.5 12 20.5z"></animate>
                                                        </path>
                                                        <circle cx="12" cy="9" r="2.5" fillOpacity="0">
                                                            <animate fill="freeze" attributeName="fill-opacity"
                                                                     begin="0.5s" dur="0.4s" values="0;1"></animate>
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.latitude?'errorInput':'input'"
                                        v-model="form.latitude"
                                        :process="form.processing"
                                        autofocus
                                    />
                                </div>

                                <div class="p-2">

                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Longitude</span>

                                            <div v-if="form.longitude!==null && form.latitude!==null ">
                                                <svg @click="showMap" v-if="form.longitude && form.latitude "
                                                     class="text-2xl animate-waving-hand hover:cursor-pointer"
                                                     xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                     viewBox="0 0 24 24">
                                                    <g fill="currentColor">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                              stroke-width="2"
                                                              d="M12 20.5C12 20.5 6 13.5 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9C18 13.5 12 20.5 12 20.5z">
                                                            <animate fill="freeze" attributeName="d" dur="0.4s"
                                                                     keyTimes="0;0.7;1"
                                                                     values="M12 20.5C12 20.5 11 19 11 18C11 17.5 11.5 17 12 17C12.5 17 13 17.5 13 18C13 19 12 20.5 12 20.5z;M12 20.5C12 20.5 5 13 5 8C5 4.5 8 1 12 1C16 1 19 4.5 19 8C19 13 12 20.5 12 20.5z;M12 20.5C12 20.5 6 13.5 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9C18 13.5 12 20.5 12 20.5z"></animate>
                                                        </path>
                                                        <circle cx="12" cy="9" r="2.5" fillOpacity="0">
                                                            <animate fill="freeze" attributeName="fill-opacity"
                                                                     begin="0.5s" dur="0.4s" values="0;1"></animate>
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.longitude?'errorInput':'input'"
                                        v-model="form.longitude"
                                        :process="form.processing"
                                        autofocus
                                    />
                                </div>
                                <div class="p-2">

                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Phone Number</span>

                                        </div>
                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.phone_number?'errorInput':'input'"
                                        v-model="form.phone_number"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                                <div class="p-2">

                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Youtube video id</span>
                                        </div>
                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.youtub_video_id?'errorInput':'input'"
                                        v-model="form.youtub_video_id"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                            </div>
                            <div class="grid grid-cols-1 ">

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Description</span>
                                        </div>

                                    </label>
                                    <textarea class="input" v-model="form.description"></textarea>
                                </div>


                            </div>
                            <div class="p-2">
                                <hr class="border-1 p-2">
                            </div>
                            <div class="grid grid-cols-3 ">

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>WebSite</span>
                                        </div>

                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.website?'errorInput':'input'"
                                        v-model="form.website"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>


                                <div class="p-2 ">
                                    <label class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Business Email</span>

                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.business_email?'errorInput':'input'"
                                        v-model="form.business_email"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>
                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Business Whatsapp URL</span>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.business_watsapp_url?'errorInput':'input'"
                                        v-model="form.business_watsapp_url"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                            </div>
                            <div class="grid grid-cols-3 ">

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>FaceBook</span>
                                        </div>

                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.facebook?'errorInput':'input'"
                                        v-model="form.facebook"
                                        :process="form.processing"
                                        autofocus
                                    />
                                </div>


                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Twitter</span>

                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.twitter?'errorInput':'input'"
                                        v-model="form.twitter"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>
                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>LinkedIn</span>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.linked_in?'errorInput':'input'"
                                        v-model="form.linked_in"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                            </div>
                            <div class="grid grid-cols-3 ">


                                <div class="p-2">

                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Whatsapp Chat</span>
                                        </div>
                                    </label>

                                    <TextInput
                                        type="text"
                                        :class="form.errors.whatsapp_chat?'errorInput':'input'"
                                        v-model="form.whatsapp_chat"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>E-mail Id</span>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.email?'errorInput':'input'"
                                        v-model="form.email"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Price Range</span>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.price_range?'errorInput':'input'"
                                        v-model="form.price_range"
                                        :process="form.processing"

                                        autofocus
                                    />
                                </div>

                            </div>
                            <div class="grid grid-cols-1">
                                <div class="p-2">

                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>General Features</span>
                                        </div>
                                    </label>


                                    <MultiSelect
                                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'inputDropDown'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                root:{class:'backGrounAndText'},


                            }"
                                        :loading="loading" v-model="form.general_features" :options="generalFeatures" filter
                                        optionLabel="name" placeholder="Select General Features"

                                        class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                        display="chip"
                                    />


                                </div>

                            </div>
                            <div class="grid grid-cols-3 ">
                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Request an Appointment</span>
                                        </div>

                                    </label>
                                    <TextInput
                                        type="text"
                                        :class="form.errors.request_an_appointment?'errorInput':'input'"
                                        v-model="form.request_an_appointment"
                                        :process="form.processing"
                                        autofocus
                                    />
                                </div>

                                <div class="p-2 ">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Wifi</span>
                                        </div>

                                    </label>

                                    <MultiSelect
                                        :pt="{
                                                list: { class: 'backGrounAndText' },
                                                filterInput:{class:'backGrounAndText'},
                                                input:{class:'inputDropDown'},
                                                header:{class:'backGrounAndText'},
                                                filterContainer:{class:'backGrounAndText'},
                                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                                root:{class:'backGrounAndText'},
                                            }"

                                        :loading="loading" v-model="form.wifi" :options="wifiList" filter
                                        optionLabel="name" placeholder="Select Wifi"

                                        class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                        display="chip"
                                    />

                                </div>
                                <div class="p-2">
                                    <label  class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Parking</span>
                                        </div>

                                    </label>

                                    <MultiSelect
                                        :pt="{
                                                list: { class: 'backGrounAndText' },
                                                filterInput:{class:'backGrounAndText'},
                                                input:{class:'inputDropDown'},
                                                header:{class:'backGrounAndText'},
                                                filterContainer:{class:'backGrounAndText'},
                                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                                root:{class:'backGrounAndText'},
                                            }"

                                        :loading="loading" v-model="form.parking" :options="parkingList" filter
                                        optionLabel="name" placeholder="Select Parking"

                                        class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                                        display="chip"
                                    />


                                </div>

                            </div>

                            <div class="grid grid-cols-1 ">


                                <div class="p-2">

                                    <label class="formLable ">
                                        <div class="flex space-x-2">
                                            <span>Hours</span>
                                        </div>
                                    </label>

                                    <textarea class="input h-48" v-model="form.hours"></textarea>

                                </div>


                            </div>

                        </Panel>


                    </div>

                    <div v-motion-slide-top v-if="from_load" class="py-2">

                        <Panel :header="'Upload Image'  " toggleable
                               :pt="{
                            header:{class:'backGrounAndText'},
                            toggleableContent:{class:'backGrounAndText'},
                            content:{class:'backGrounAndText'},
                            root:{class:'backGrounAndText'},
                        }">


                            <div class="grid grid-cols-2">
                                <div class="p-2">
                                    <label  class="formLable ">Banner Images</label>
                                    <small> minimum ratio suggestion: 800px * 687px, and maximum file size: 5mb</small>



                                    <FileUpload fileLimit="1"
                                                @input="form.banner = $event.target.files[0]" name="demo[]"
                                                url="/api2/upload" @upload="onAdvancedUpload($event)"
                                                :multiple="false" accept="image/jpg/png/svg *"
                                                :maxFileSize="1000000"
                                                :pt="{
                                                         content: { class: 'backGrounAndText' },
                                                         buttonbar:{
                                                             class: 'backGrounAndText'
                                                         },
                                                         progressbar:{
                                                             class: 'backGrounAndText'
                                                         }
                                                     }"

                                    >
                                        <template #empty>
                                            <p>Drag and drop files to here to upload.</p>
                                        </template>
                                    </FileUpload>

                                </div>

                                <div class="p-2">
                                    <label  class="formLable ">Feature image</label>
                                    <small> minimum ratio suggestion: 800px * 687px, and maximum file size: 5mb</small>


                                    <FileUpload fileLimit="1"
                                                @input="form.feature = $event.target.files[0]" name="demo[]"
                                                url="/api2/upload" @upload="onAdvancedUpload($event)"
                                                :multiple="false" accept="image/jpg/png/svg *"
                                                :maxFileSize="1000000"
                                                :pt="{
                                                         content: { class: 'backGrounAndText' },
                                                         buttonbar:{
                                                             class: 'backGrounAndText'
                                                         },
                                                         progressbar:{
                                                             class: 'backGrounAndText'
                                                         }
                                                     }"

                                    >
                                        <template #empty>
                                            <p>Drag and drop files to here to upload.</p>
                                        </template>
                                    </FileUpload>


                                </div>


                            </div>
                            <hr>
                            <div class="grid grid-cols-1">
                                <div class="p-2">
                                    <label class="formLable ">Gallery images</label>
                                    <small> maximum file size: 5mb per image, maximum 5 images</small>

                                    <div class="card">
                                        <FileUpload  @input="form.dfr = $event.target.files"  name="gallery[]" url="/api/upload"

                                                     @upload="onAdvancedUploadMutipal($event)"
                                                     :multiple="true"
                                                      accept="image/*" :maxFileSize="1000000"
                                                    :file-limit="5"
                                                    :pt="{
                                                            content: { class: 'backGrounAndText' },
                                                            buttonbar:{class: 'backGrounAndText'},
                                                            chooseButton:{class:'formButton'},
                                                            chooseButtonLabel:'AAKSJS',
                                                            uploadButton:{class:'formButton'}

                                                        }">
                                            <template #empty>
                                                <p>Drag and drop files to here to upload.</p>
                                            </template>
                                        </FileUpload>
                                    </div>

                                </div>
                            </div>
                        </Panel>

                        <div class="p-5">

                            <button @click.prevent="submit" t
                                    ype="submit"
                                    class="hover:cursor-pointer hover:bg-green-500
                                    hover:duration-700 text-white
                                    font-bold w-1/2 h-full bg-purple-600 rounded p-5 ">

                                <svg class="items-center"  v-if="form.processing" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24"><path fill="currentColor" d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></path></svg>

                                <span v-else>Create New List</span>



                            </button>
                        </div>
                    </div>


                </div>
            </form>
        </div>

        <div
            v-if="!hidden"
            v-motion-slide-bottom
            id="defaultModal" tabindex="-1" aria-hidden="true"
            class="fixed rounded-full absolute top-10 left-0 right-0  lg:w-full z-50  w-full p-8  overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="flex h-screen justify-center items-center">
                <div
                    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-4">

                        <button @click="closeShowView" type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                    </div>
                    <div class="flex flex-col items-center p-5 space-y-2">

                        <GoogleMap api-key="AIzaSyDiWFBEycfJrWQo3Zhz6DpqcNhKnBc0ejM" style="width: 100%; height: 500px"
                                   :center="center" :zoom="15">
                            <Marker :options="{ position: center }"/>
                        </GoogleMap>

                    </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
