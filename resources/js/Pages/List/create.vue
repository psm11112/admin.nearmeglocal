<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Dropdown from 'primevue/dropdown';
import TextInput from '@/Components/TextInput.vue'
import Panel from 'primevue/panel';
import { useForm,usePage } from '@inertiajs/vue3'
import MultiSelect from 'primevue/multiselect';
import {ref} from "vue";
import Steps from 'primevue/steps';


const selectedCities = ref();
let loading=ref(false);
const subCategory=ref();
const props=defineProps({
    category:[],
   // subCategory:[]
})

const items = ref([
    {
        label: 'Personal',
        to: "/"
    },
    {
        label: 'Seat',
        to: "/seat",
    },
    {
        label: 'Payment',
        to: "/payment",
    },
    {
        label: 'Confirmation',
        to: "/confirmation",
    }
]);
const form=useForm({
    category_id:null,
    sub_category_id:null

})

function selectSubCategory(){


    loading.value=true
    axios.post('/api/sub-category', form).then((res)=>{

        console.log(res.data);
        subCategory.value=res.data;
    });

    loading.value=false

}



</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <div class="formTitle">Add A Listing</div>
        <div class="text-2xs text-gray-400">This page allows you to create a new business listing record.</div>


        <div class="py-5">

<!--            <Breadcrumb :data="breadcrumbList"></Breadcrumb>-->

            <div class="card">
                <Steps
                    :model="items"
                    :readonly="false"
                    :pt="{
                    root: { class: 'w-30rem' }
                }"
                />
            </div>

            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow-lg shadow-gray-300/10 dark:bg-gray-800 dark:border-gray-700">
            <Panel :header="'Add Information'  " toggleable
                   :pt="{
                            header:{class:'backGrounAndText'},
                            toggleableContent:{class:'backGrounAndText'},
                            content:{class:'backGrounAndText'},
                            root:{class:'backGrounAndText'},
                        }">

                <div>
                    <label for="category" class="formLable">Category</label>
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

                </div>

                <div>


                    <label for="category" class="formLable ">Sub Category</label>

                    <MultiSelect
                        :pt="{
                                list: { class: 'backGrounAndText' },
                                filterInput:{class:'backGrounAndText'},
                                input:{class:'input'},
                                header:{class:'backGrounAndText'},
                                filterContainer:{class:'backGrounAndText'},
                                labelContainer:{class:' dark:bg-gray-700 dark:text-white'},
                                root:{class:'backGrounAndText'},


                            }"

                        :loading="loading"  v-model="selectedCities" :options="subCategory" filter optionLabel="name" placeholder="Select Cities"
                                 :maxSelectedLabels="3"
                        class="w-full bg-gray-50 border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500   dark:bg-gray-700 dark:border-gray-600  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                        display="chip"
                    />

                </div>
            </Panel>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
