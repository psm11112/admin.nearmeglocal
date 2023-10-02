<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {ref} from 'vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: null,
    sku: null,
    description: null,
})
</script>
<template>
    <Head title="Category"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category</h2>
        </template>

        <div class="py-5">

            <span class="formTitle">Category</span>



            <div v-auto-animate class="my-12 mx-auto  md:px-12  p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <span class="formSubTitle">Add Category</span>

                <form  @submit.prevent="form.post('/category/create', {
  preserveScroll: true,
  onSuccess: () => form.reset('name'),

})">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>

                            <label for="name" class="formLable" >Name</label>
                            <input type="text" v-model="form.name" class="input" placeholder="John" required>
                        </div>
                        <div>
                            <label for="slg" class="formLable">Slag</label>
                            <input type="text" v-model="form.sku" class="input" placeholder="Doe" required>
                        </div>
                        <div>
                            <label for="company" class="formLable">Description</label>

                            <textarea class="input" v-model="form.description"></textarea>
                        </div>

                    </div>


                    <button type="submit" class="formButton" :disabled="form.processing">Submit</button>
                </form>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
