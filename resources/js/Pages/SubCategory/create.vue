<script setup>
import Dropdown from 'primevue/dropdown';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {ref} from 'vue'
import { useForm } from '@inertiajs/vue3'
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

function success(){
   // form.reset('name');
    ToastMessage()

}
const form = useForm({
    category_id:null,
    name: null,
    sku: null,
    description: null,
    photo:null

})

const breadcrumbList=[
    {
        name:'Sub Category',
        url:route('sub-category.index'),
        active:true
    },
    {
        name:'Create',
        url:route('sub-category.create'),
        active:true
    },
]

function previewImage(e){
    const file=e.target.files[0];

    image.value=URL.createObjectURL(file);
    hidden.value=false;


}
function submit() {
    form.post(route('sub-category.store'), {
        preserveScroll: true,
        onSuccess: () => success()
    });
}
</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <div class="formTitle">New Sub Category Add </div>



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
                                id="email"
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
                        <div class="w-full">
                            <label for="Description" class="formLable">Description</label>
                            <textarea class="input w-full" v-model="form.description"></textarea>
                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                                <p v-if="form.errors.sku" class="text-sm text-gray-600">
                                    <ErrorMessage  :message="form.errors.sku"></ErrorMessage>
                                </p>
                            </Transition>
                        </div>

                    </div>

<!--                    <div v-if="!hidden" v-motion-fade-visible class="flex p-2 justify-center items-center" >-->
<!--                        <img :src="image" class="rounded-lg w-48" title="preview">-->
<!--                    </div>-->
<!--                    <div class="flex items-center justify-center w-full">-->
<!--                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">-->
<!--                            <div class="flex flex-col items-center justify-center pt-5 pb-6" >-->
<!--                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>-->
<!--                                </svg>-->
<!--                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>-->
<!--                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG</p>-->
<!--                            </div>-->
<!--                            <input id="dropzone-file" @input="form.photo = $event.target.files[0]" type="file" class="hidden" @change="previewImage" />-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">-->
<!--                        <p v-if="form.errors.photo" class="text-sm text-gray-600">-->
<!--                            <ErrorMessage  :message="form.errors.photo"></ErrorMessage>-->
<!--                        </p>-->
<!--                    </Transition>-->

                    <div class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <FileUpload class="formButton"  @input="form.photo = $event.target.files[0]" name="demo[]" url="/api/upload"  @upload="onAdvancedUpload($event)"  accept="image/*" :maxFileSize="1000000">
                        <template #empty class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <p>Drag and drop files to here to upload.</p>
                        </template>
                    </FileUpload>
                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition delay-300 duration-700 ease-in-out">
                            <p v-if="form.errors.photo" class="text-sm text-gray-600">
                                <ErrorMessage  :message="form.errors.photo"></ErrorMessage>
                            </p>
                        </Transition>
                    </div>


                    <div class="p-2">
<!--                        <button type="submit" class="formButton" :disabled="form.processing">Submit</button>-->

                        <Button :name="'Add Sub Category'" :process="form.processing"></Button>
                    </div>
                </form>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
