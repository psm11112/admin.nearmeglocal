<!--<script setup>-->
<!--import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';-->
<!--import { Head } from '@inertiajs/vue3';-->
<!--import { Bar } from 'vue-chartjs'-->
<!--import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'-->

<!--const  chartData ={-->
<!--         labels: [ 'January', 'February', 'March' ],-->
<!--         datasets: [ { data: [40, 20, 12] } ]-->
<!--}-->


<!--</script>-->

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/vue3'
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'

import {useAutoAnimate} from '@formkit/auto-animate/vue'


ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


export default {
    name: 'BarChart',
    components: {Bar, AuthenticatedLayout, Head},
    data() {
        return {
            chartData: {
                labels: ['January', 'February', 'March'],
                datasets: [
                    {
                        label: 'Data One',
                        backgroundColor: '#fcd34d',
                        data: [40, 20, 12]
                    },
                    {
                        label: 'Data One',
                        backgroundColor: '#d8b4fe',
                        data: [40, 20, 12]
                    },
                    {
                        label: 'Data One',
                        backgroundColor: '#86efac',
                        data: [40, 20, 12]
                    }
                ]
            },
            chartOptions: {
                responsive: true
            },
            show: '',
            category: 'mobile'

        }
    },
    computed: {
        myStyles() {
            return {
                width: '10px',
                position: 'relative'
            }
        }
    },
    mounted() {
        this.show = useAutoAnimate({
            duration: 300,
            easing: 'ease-in',
        })
    },

    methods: {

        changeCategory(category) {
            this.category = category;
            console.log(this.category);
        }


    }
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="container  my-12 mx-auto  md:px-12">

            <div class="flex flex-wrap  -mx-1 lg:-mx-4 space-x-5">

                <!-- Column -->
                <div
                    class="cardHover cardDark p-4 my-1   px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/5    ">
                    <div class="flex justify-between  ">
                        <div>
                            <h5 class="mb-2 font-bold text-gray-500  dark:text-white relative">New Orders</h5>

                            <div class="flex items-end ">
                                <span
                                    class="font-normal text-3xl text-slate-950 font-extrabold dark:text-gray-300 relative">$2,890</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-sm  text-purple-600" width="1em"
                                     height="1em" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                          d="M205.66 117.66a8 8 0 0 1-11.32 0L136 59.31V216a8 8 0 0 1-16 0V59.31l-58.34 58.35a8 8 0 0 1-11.32-11.32l72-72a8 8 0 0 1 11.32 0l72 72a8 8 0 0 1 0 11.32Z"></path>
                                </svg>
                                <span class="text-xs font-bold text-purple-600">+20%</span>
                            </div>
                        </div>
                        <div class="hover:animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-purple-600 " width="2.3em"
                                 height="2.3em" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                      d="m223.68 66.15l-88-48.15a15.94 15.94 0 0 0-15.36 0l-88 48.18a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03ZM168 152v50.09l-32 17.52v-86.87l80-43.8v32l-43.84 24A8 8 0 0 0 168 152Zm-84.16-7L40 121V89l80 43.8v86.87l-32-17.58V152a8 8 0 0 0-4.16-7Zm-.7-88.41l41 22.45a8 8 0 0 0 7.68 0l41-22.45l34.48 18.87l-79.3 43.42l-79.34-43.44ZM128 32l28.2 15.44L128 62.89L99.8 47.45ZM40 139.22l32 17.52v36.59l-32-17.51Zm144 54.11v-36.59l32-17.52v36.6Z"></path>
                            </svg>
                        </div>

                    </div>

                </div>
                <!-- END Column -->

                <!-- Column -->
                <div class="cardHover cardDark my-1 p-4  px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/5">

                    <div class="flex justify-between ">
                        <div>
                            <h5 class="mb-2 font-bold text-gray-500  dark:text-white relative">Customer</h5>

                            <div class="flex items-end">
                                <span
                                    class="font-normal text-3xl text-slate-950 font-extrabold dark:text-gray-400 relative">1200</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-sm  text-purple-600" width="1em"
                                     height="1em" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                          d="M205.66 117.66a8 8 0 0 1-11.32 0L136 59.31V216a8 8 0 0 1-16 0V59.31l-58.34 58.35a8 8 0 0 1-11.32-11.32l72-72a8 8 0 0 1 11.32 0l72 72a8 8 0 0 1 0 11.32Z"></path>
                                </svg>
                                <span class="text-xs font-bold text-purple-600">+5</span>
                            </div>
                        </div>
                        <div class="hover:animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-400" width="2.3em" height="2.3em"
                                 viewBox="0 0 256 256">
                                <path fill="currentColor"
                                      d="m252.24 132.24l-24 24a6 6 0 0 1-8.48 0l-24-24a6 6 0 1 1 8.48-8.48L218 137.51V128A90 90 0 0 0 54.87 75.5a6 6 0 1 1-9.74-7A102 102 0 0 1 230 128v9.51l13.76-13.75a6 6 0 1 1 8.48 8.48Zm-41.39 55.26A102 102 0 0 1 26 128v-9.51l-13.76 13.75a6 6 0 0 1-8.48-8.48l24-24a6 6 0 0 1 8.48 0l24 24a6 6 0 1 1-8.48 8.48L38 118.49V128a89.65 89.65 0 0 0 24.49 61.64a77.53 77.53 0 0 1 40-31.38a46 46 0 1 1 51 0a77.49 77.49 0 0 1 40 31.41a89.35 89.35 0 0 0 7.58-9.17a6 6 0 1 1 9.74 7ZM128 154a34 34 0 1 0-34-34a34 34 0 0 0 34 34Zm0 64a90.24 90.24 0 0 0 56.57-20a66 66 0 0 0-113.13 0A89.58 89.58 0 0 0 128 218Z"></path>
                            </svg>
                        </div>
                    </div>


                </div>
                <!-- END Column -->

                <!-- Column -->
                <div class="cardHover cardDark p-4 my-1  px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/5">
                    <div class="flex justify-between ">
                        <div>
                            <h5 class="mb-2 font-bold text-gray-500  dark:text-white relative">Gross Profit</h5>

                            <div class="flex items-end ">
                                <span
                                    class="font-normal text-3xl text-slate-950 font-extrabold dark:text-gray-400 relative">$3,456</span>

                                <svg xmlns="http://www.w3.org/2000/svg" class="text-sm  text-rose-500" width="1em"
                                     height="1em" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                          d="m205.66 149.66l-72 72a8 8 0 0 1-11.32 0l-72-72a8 8 0 0 1 11.32-11.32L120 196.69V40a8 8 0 0 1 16 0v156.69l58.34-58.35a8 8 0 0 1 11.32 11.32Z"></path>
                                </svg>

                                <span class="text-xs font-bold text-rose-500">-1</span>
                            </div>
                        </div>
                        <div class="hover:animate-bounce">

                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="2.5em" height="2.5em"
                                 viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                   strokeWidth="2">
                                    <path
                                        d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v2M7 6h10M3 14v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4m0 0h4"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M18 15v3m0 3v-3m0 0h-3m3 0h3"></path>
                                </g>
                            </svg>

                        </div>
                    </div>
                </div>
                <!-- END Column -->
                <div class="cardHover cardDark p-4 my-1   px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/5">
                    <div class="flex justify-between ">
                        <div>
                            <h5 class="mb-2 font-bold text-gray-500  dark:text-white relative">Gross Profit</h5>

                            <div class="flex items-end ">
                                <span
                                    class="font-normal text-3xl text-slate-950 font-extrabold dark:text-gray-400 relative">$3,456</span>

                                <svg xmlns="http://www.w3.org/2000/svg" class="text-sm  text-rose-500" width="1em"
                                     height="1em" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                          d="m205.66 149.66l-72 72a8 8 0 0 1-11.32 0l-72-72a8 8 0 0 1 11.32-11.32L120 196.69V40a8 8 0 0 1 16 0v156.69l58.34-58.35a8 8 0 0 1 11.32 11.32Z"></path>
                                </svg>

                                <span class="text-xs font-bold text-rose-500">-1</span>
                            </div>
                        </div>
                        <div class="hover:animate-bounce">

                            <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="2.5em" height="2.5em"
                                 viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                   strokeWidth="2">
                                    <path
                                        d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v2M7 6h10M3 14v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4m0 0h4"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M18 15v3m0 3v-3m0 0h-3m3 0h3"></path>
                                </g>
                            </svg>

                        </div>
                    </div>
                </div>

                <!-- Column -->
                <div class="my-1 cardDark px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/5 p-5">
                    <span class="text-2xl font-bold dark:text-white"> Top Category</span>
                    <div class="flex justify-start">

                        <ul class="w-full divide-y divide-gray-200 dark:divide-gray-700 p-2">
                            <li class="pb-3 sm:pb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-sky-400" width="2em"
                                             height="2em" viewBox="0 0 256 256">
                                            <path fill="currentColor"
                                                  d="M176 16H80a24 24 0 0 0-24 24v176a24 24 0 0 0 24 24h96a24 24 0 0 0 24-24V40a24 24 0 0 0-24-24ZM72 64h112v128H72Zm8-32h96a8 8 0 0 1 8 8v8H72v-8a8 8 0 0 1 8-8Zm96 192H80a8 8 0 0 1-8-8v-8h112v8a8 8 0 0 1-8 8Z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class=" font-bold text-slate-950 truncate dark:text-white textHover">
                                            Mobile & Accessories
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400">
                                            (1,239)
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-400" width="2.5em"
                                             height="2.5em" viewBox="0 0 256 256">
                                            <path fill="currentColor"
                                                  d="M24 96v72a8 8 0 0 0 8 8h80a8 8 0 0 1 0 16H96v16h16a8 8 0 0 1 0 16H64a8 8 0 0 1 0-16h16v-16H32a24 24 0 0 1-24-24V96a24 24 0 0 1 24-24h80a8 8 0 0 1 0 16H32a8 8 0 0 0-8 8Zm184-32h-32a8 8 0 0 0 0 16h32a8 8 0 0 0 0-16Zm0 32h-32a8 8 0 0 0 0 16h32a8 8 0 0 0 0-16Zm40-48v160a16 16 0 0 1-16 16h-80a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h80a16 16 0 0 1 16 16Zm-16 160V48h-80v160h80Zm-40-40a12 12 0 1 0 12 12a12 12 0 0 0-12-12Z"></path>
                                        </svg>


                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class=" font-bold text-slate-950 truncate dark:text-white textHover">
                                            Desktop And PC
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400">
                                            (200)
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">


                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-400" width="2.5em"
                                             height="2.5em" viewBox="0 0 256 256">
                                            <path fill="currentColor"
                                                  d="M232 168h-8V72a24 24 0 0 0-24-24H56a24 24 0 0 0-24 24v96h-8a8 8 0 0 0-8 8v16a24 24 0 0 0 24 24h176a24 24 0 0 0 24-24v-16a8 8 0 0 0-8-8ZM48 72a8 8 0 0 1 8-8h144a8 8 0 0 1 8 8v96H48Zm176 120a8 8 0 0 1-8 8H40a8 8 0 0 1-8-8v-8h192ZM152 88a8 8 0 0 1-8 8h-32a8 8 0 0 1 0-16h32a8 8 0 0 1 8 8Z"></path>
                                        </svg>


                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class=" font-bold text-slate-950 truncate dark:text-white textHover">
                                            Laptop
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400">
                                            (50)
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">


                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-violet-400" width="2.5em"
                                             height="2.5em" viewBox="0 0 256 256">
                                            <path fill="currentColor"
                                                  d="M208 128a79.94 79.94 0 0 0-32.7-64.47l-6.24-34.38A16 16 0 0 0 153.32 16h-50.64a16 16 0 0 0-15.74 13.15L80.7 63.53a79.9 79.9 0 0 0 0 128.94l6.24 34.38A16 16 0 0 0 102.68 240h50.64a16 16 0 0 0 15.74-13.15l6.24-34.38A79.94 79.94 0 0 0 208 128ZM102.68 32h50.64l3.91 21.55a79.75 79.75 0 0 0-58.46 0ZM64 128a64 64 0 1 1 64 64a64.07 64.07 0 0 1-64-64Zm89.32 96h-50.64l-3.91-21.55a79.75 79.75 0 0 0 58.46 0ZM120 128V88a8 8 0 0 1 16 0v32h32a8 8 0 0 1 0 16h-40a8 8 0 0 1-8-8Z"></path>
                                        </svg>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class=" font-bold text-slate-950 truncate dark:text-white textHover">
                                            Watch
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400">
                                            (200)
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="pt-3 pb-0 sm:pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-400" width="2.5em"
                                             height="2.5em" viewBox="0 0 256 256">
                                            <path fill="currentColor"
                                                  d="M208 56h-27.72l-13.63-20.44A8 8 0 0 0 160 32H96a8 8 0 0 0-6.65 3.56L75.71 56H48a24 24 0 0 0-24 24v112a24 24 0 0 0 24 24h160a24 24 0 0 0 24-24V80a24 24 0 0 0-24-24Zm8 136a8 8 0 0 1-8 8H48a8 8 0 0 1-8-8V80a8 8 0 0 1 8-8h32a8 8 0 0 0 6.66-3.56L100.28 48h55.43l13.63 20.44A8 8 0 0 0 176 72h32a8 8 0 0 1 8 8ZM128 88a44 44 0 1 0 44 44a44.05 44.05 0 0 0-44-44Zm0 72a28 28 0 1 1 28-28a28 28 0 0 1-28 28Z"></path>
                                        </svg>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class=" font-bold text-slate-950 truncate dark:text-white textHover">
                                            Camera
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400">
                                            (420)
                                        </p>
                                    </div>

                                </div>
                            </li>
                        </ul>


                    </div>


                </div>
                <!-- END Column -->

                <!-- Column -->
                <div class="my-1 cardDark px-1 w-full md:w-full lg:my-4 lg:px-4 lg:w-1/2 p-5">

                    <!-- Article -->
                    <span class="text-2xl font-bold dark:text-white">Visitor</span>
                    <Bar
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                        :style="myStyles"

                    />


                </div>
                <!-- END Column -->

                <!-- Column -->
                <div class="my-1 cardDark px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/4 p-5">

                    <span class="text-2xl font-bold dark:text-white">Valuable Customer</span>
                    <div class="flex justify-start p-4">
                        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 ">
                            <li class="pb-3 sm:pb-4">
                                <div class="flex items-center space-x-1">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="../../../public/images/user/1.jpg"
                                             alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-md font-bold text-gray-700 dark:text-white textHover">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400 textHover">
                                            email@flowbite.com
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="../../../public/images/user/2.jpg"
                                             alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-md font-bold text-slate-950 dark:text-white textHover">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400 textHover">
                                            email@flowbite.com
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="../../../public/images/user/5.jpg"
                                             alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-md font-bold text-slate-950 dark:text-white textHover">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400 textHover">
                                            email@flowbite.com
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="../../../public/images/user/6.jpg"
                                             alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ">
                                        <p class="text-md font-bold text-slate-950 dark:text-white textHover">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 truncate dark:text-gray-400 textHover">
                                            email@flowbite.com
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="pt-3 pb-0 sm:pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="../../../public/images/user/1.jpg"
                                             alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-md font-bold text-slate-950 dark:text-white textHover">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm font-bold text-gray-500 dark:text-gray-400 textHover">
                                            email@flowbite.com
                                        </p>
                                    </div>

                                </div>
                            </li>
                        </ul>

                    </div>

                </div>
                <!-- END Column -->


                <div class="my-1 cardDark px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-full p-4">
                    <span class="text-2xl font-bold dark:text-white">Recent Orders</span>
                    <div v-auto-animate class="flex justify-start">
                        <div class="w-full">

                            <div class=" mb-4 border-b border-gray-200 dark:border-gray-700 p-2">
                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                                    data-tabs-toggle="#myTabContent" role="tablist">
                                    <li class="mr-2" role="presentation">
                                        <button @click="changeCategory('mobile')"
                                                class=" dark:border dark:border-blue-700 text-sky-400 hover:text-white inline-block p-4 border border-gray-300 rounded-lg hover:bg-indigo-400  cardHover"
                                                id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5em" height="2.5em"
                                                 viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                      d="M176 16H80a24 24 0 0 0-24 24v176a24 24 0 0 0 24 24h96a24 24 0 0 0 24-24V40a24 24 0 0 0-24-24ZM72 64h112v128H72Zm8-32h96a8 8 0 0 1 8 8v8H72v-8a8 8 0 0 1 8-8Zm96 192H80a8 8 0 0 1-8-8v-8h112v8a8 8 0 0 1-8 8Z"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li class="mr-2" role="presentation">
                                        <button @click="changeCategory('desktop')"
                                            class="dark:border-blue-700 text-indigo-400 hover:text-white border border-gray-300 rounded-lg cardHover  hover:bg-indigo-400 inline-block p-4  dark:hover:text-gray-300"
                                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                            aria-controls="dashboard" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5em" height="2.5em"
                                                 viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                      d="M24 96v72a8 8 0 0 0 8 8h80a8 8 0 0 1 0 16H96v16h16a8 8 0 0 1 0 16H64a8 8 0 0 1 0-16h16v-16H32a24 24 0 0 1-24-24V96a24 24 0 0 1 24-24h80a8 8 0 0 1 0 16H32a8 8 0 0 0-8 8Zm184-32h-32a8 8 0 0 0 0 16h32a8 8 0 0 0 0-16Zm0 32h-32a8 8 0 0 0 0 16h32a8 8 0 0 0 0-16Zm40-48v160a16 16 0 0 1-16 16h-80a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h80a16 16 0 0 1 16 16Zm-16 160V48h-80v160h80Zm-40-40a12 12 0 1 0 12 12a12 12 0 0 0-12-12Z"></path>
                                            </svg>

                                        </button>
                                    </li>
                                    <li class="mr-2" role="presentation">
                                        <button
                                            @click="changeCategory('laptop')"
                                            class="dark:border-blue-700 text-green-400 hover:text-white border border-gray-300 cardHover rounded-lg hover:bg-indigo-400 inline-block p-4   hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                                            aria-controls="settings" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5em" height="2.5em"
                                                 viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                      d="M232 168h-8V72a24 24 0 0 0-24-24H56a24 24 0 0 0-24 24v96h-8a8 8 0 0 0-8 8v16a24 24 0 0 0 24 24h176a24 24 0 0 0 24-24v-16a8 8 0 0 0-8-8ZM48 72a8 8 0 0 1 8-8h144a8 8 0 0 1 8 8v96H48Zm176 120a8 8 0 0 1-8 8H40a8 8 0 0 1-8-8v-8h192ZM152 88a8 8 0 0 1-8 8h-32a8 8 0 0 1 0-16h32a8 8 0 0 1 8 8Z"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li role="presentation">
                                        <button
                                            @click="changeCategory('watch')"
                                            class="dark:border-blue-700 text-violet-400 hover:text-white border border-gray-300 cardHover rounded-lg hover:bg-indigo-400 inline-block p-4  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                            id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                                            aria-controls="contacts" aria-selected="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="2.5em" height="2.5em"
                                                 viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                      d="M208 128a79.94 79.94 0 0 0-32.7-64.47l-6.24-34.38A16 16 0 0 0 153.32 16h-50.64a16 16 0 0 0-15.74 13.15L80.7 63.53a79.9 79.9 0 0 0 0 128.94l6.24 34.38A16 16 0 0 0 102.68 240h50.64a16 16 0 0 0 15.74-13.15l6.24-34.38A79.94 79.94 0 0 0 208 128ZM102.68 32h50.64l3.91 21.55a79.75 79.75 0 0 0-58.46 0ZM64 128a64 64 0 1 1 64 64a64.07 64.07 0 0 1-64-64Zm89.32 96h-50.64l-3.91-21.55a79.75 79.75 0 0 0 58.46 0ZM120 128V88a8 8 0 0 1 16 0v32h32a8 8 0 0 1 0 16h-40a8 8 0 0 1-8-8Z"></path>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div v-auto-animate>
                                <div v-if="category==='mobile'" class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                     id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>

                                                <th scope="col" class="px-6 py-3">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Position
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Neil Sims</div>
                                                        <div class="font-normal text-gray-500">neil.sims@flowbite.com
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    React Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/2.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Bonnie Green</div>
                                                        <div class="font-normal text-gray-500">bonnie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Designer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/5.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Jese Leos</div>
                                                        <div class="font-normal text-gray-500">jese@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Vue JS Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/6.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Thomas Lean</div>
                                                        <div class="font-normal text-gray-500">thomes@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    UI/UX Engineer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Leslie Livingston</div>
                                                        <div class="font-normal text-gray-500">leslie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    SEO Specialist
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                                        Offline
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div v-if="category==='desktop'" class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                     id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>

                                                <th scope="col" class="px-6 py-3">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Position
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Neil Sims desktop</div>
                                                        <div class="font-normal text-gray-500">neil.sims@flowbite.com
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    React Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/2.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Bonnie Green</div>
                                                        <div class="font-normal text-gray-500">bonnie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Designer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/5.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Jese Leos</div>
                                                        <div class="font-normal text-gray-500">jese@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Vue JS Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/6.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Thomas Lean</div>
                                                        <div class="font-normal text-gray-500">thomes@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    UI/UX Engineer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Leslie Livingston</div>
                                                        <div class="font-normal text-gray-500">leslie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    SEO Specialist
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                                        Offline
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div v-if="category==='laptop'" class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                     id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>

                                                <th scope="col" class="px-6 py-3">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Position
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Neil Sims Laptop</div>
                                                        <div class="font-normal text-gray-500">neil.sims@flowbite.com
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    React Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/2.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Bonnie Green</div>
                                                        <div class="font-normal text-gray-500">bonnie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Designer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/5.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Jese Leos</div>
                                                        <div class="font-normal text-gray-500">jese@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Vue JS Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/6.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Thomas Lean</div>
                                                        <div class="font-normal text-gray-500">thomes@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    UI/UX Engineer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Leslie Livingston</div>
                                                        <div class="font-normal text-gray-500">leslie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    SEO Specialist
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                                        Offline
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div v-if="category==='watch'" class=" p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                     id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>

                                                <th scope="col" class="px-6 py-3">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Position
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Neil Sims Watch</div>
                                                        <div class="font-normal text-gray-500">neil.sims@flowbite.com
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    React Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/2.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Bonnie Green</div>
                                                        <div class="font-normal text-gray-500">bonnie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Designer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/5.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Jese Leos</div>
                                                        <div class="font-normal text-gray-500">jese@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    Vue JS Developer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/6.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Thomas Lean</div>
                                                        <div class="font-normal text-gray-500">thomes@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    UI/UX Engineer
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                                        Online
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <th scope="row"
                                                    class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="../../../public/images/user/1.jpg" alt="Jese image">
                                                    <div class="pl-3">
                                                        <div class="text-base font-semibold">Leslie Livingston</div>
                                                        <div class="font-normal text-gray-500">leslie@flowbite.com</div>
                                                    </div>
                                                </th>
                                                <td class="px-6 py-4">
                                                    SEO Specialist
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                                        Offline
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                                        user</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>


                </div>

            </div>
        </div>


    </AuthenticatedLayout>
</template>


