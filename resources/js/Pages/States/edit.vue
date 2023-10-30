<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import {ref} from "vue";
import ToastMessage from "@/Components/Totast.vue";
import { useToast } from "vue-toastification";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ErrorMessage from '@/Components/Error.vue'


const props=defineProps({
    stats:[],
    country:[]
})


const form = useForm({
    name: props.stats.name,
    country_id:props.stats.country_id,
    id:props.stats.id

})
const toast= useToast();

function success(){
    toast.success(ToastMessage,{
        icon: false,
    })
}

function submit(){
    form.post(route('state.update'),{
        preserveScroll: true,
        onSuccess: () =>success()
    })

}



</script>
<template>

    <Head title="Create States"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New States</h2>
        </template>

        <div class="py-5 h-auto">
            <div class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <form @submit.prevent="submit" >

                    <div v-auto-animate class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>
                            <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <div v-auto-animate class="relative mb-6">
                                <select v-model="form.country_id" class="input">
                                    <option class="text-lg"  v-for="(item,key) in country" :key="key" :value="item.id">
                                        <span  v-html="item.svg"></span>
                                        {{item.name}}</option>
                                </select>

                                <div class="p-2"  v-if="form.errors.name">
                                    <ErrorMessage  :message="form.errors.country_id"></ErrorMessage>
                                </div>
                            </div>
                            <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State Name</label>
                            <div v-auto-animate class="relative mb-6">
                                <input :disabled="form.processing" v-model="form.name" type="text"  class="input" placeholder="Enter State Name">
                                <div class="p-2"  v-if="form.errors.name">
                                    <ErrorMessage  :message="form.errors.name"></ErrorMessage>
                                </div>
                            </div>


                            <PrimaryButton class="formButton pt-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <svg v-if="form.processing" xmlns="http://www.w3.org/2000/svg" width="1.7em" height="1.7em" viewBox="0 0 24 24"><g><circle cx="3" cy="12" r="2" fill="#888888"></circle><circle cx="21" cy="12" r="2" fill="#888888"></circle><circle cx="12" cy="21" r="2" fill="#888888"></circle><circle cx="12" cy="3" r="2" fill="#888888"></circle><circle cx="5.64" cy="5.64" r="2" fill="#888888"></circle><circle cx="18.36" cy="18.36" r="2" fill="#888888"></circle><circle cx="5.64" cy="18.36" r="2" fill="#888888"></circle><circle cx="18.36" cy="5.64" r="2" fill="#888888"></circle><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"></animateTransform></g></svg>
                                <span v-if="!form.processing">Add State</span>
                                <!--                                <div v-if="form.">There are unsaved form changes.</div>-->

                            </PrimaryButton>
                        </div>


                    </div>
                </form>


            </div>




        </div>


    </AuthenticatedLayout>



</template>
