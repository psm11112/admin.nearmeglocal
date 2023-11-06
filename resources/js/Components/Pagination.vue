<script setup>
import {Link} from '@inertiajs/vue3';

const props=defineProps({
    pages:[]
})

console.log(props)


</script>
<template>
    <nav aria-label="Page navigation example">
    <ul  class="inline-flex -space-x-px text-base h-10">



        <li v-for="(page,index)  in pages.links" :key="index">

            <div v-if="page.url===null" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-200 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700
                                dark:hover:text-white cursor-not-allowed"
                 v-html="page.label"
            >

            </div>

            <Link v-else :href="page.url"  :class="pages.current_page==page.label?'paginationActive':'pagination'"
                  v-html="page.label">


            </Link>
        </li>


    </ul>
    </nav>
</template>
