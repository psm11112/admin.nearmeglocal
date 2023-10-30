<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {ref} from 'vue'
import { useForm } from '@inertiajs/vue3'
</script>
<template>
    <Head title="Country Create"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Country</h2>
        </template>
    </AuthenticatedLayout>


</template>
