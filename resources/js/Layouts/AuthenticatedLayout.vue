<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link} from '@inertiajs/vue3';
import {useAutoAnimate} from '@formkit/auto-animate/vue'
import {useCommonStore} from '@/stores/common'
import {storeToRefs} from "pinia";

import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

const {mode} = storeToRefs(useCommonStore());
const baseUrl='/images/'
const {addMode} = useCommonStore()


onMounted(() => {
    initFlowbite();
})


function changeMode(value) {

    addMode(value)

    var root = document.getElementsByTagName('html')[0]; // '0' to assign the first (and only `HTML` tag)

   // root.classList.toggle('dark');
    root.setAttribute('class', value);


}

function signout(){
    console.log("Hello");
}

const [show] = useAutoAnimate({
    duration: 300,
    easing: 'ease-in'

})
</script>

<template>
    <div class="h-full">
    <nav  class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ml-2 md:mr-24">
                        <img :src="baseUrl+'new-logo.png'" class="h-8 mr-3" alt="City Group"/>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div data-popover-target="popover-default" ref="show">
                        <svg   class="hover:text-purple-500 hover:cursor-pointer dark:text-white" v-if="mode==='dark'  " @click="changeMode('light')" xmlns="http://www.w3.org/2000/svg"
                             width="1.5em" height="1.5em" viewBox="0 0 256 256">
                            <g fill="currentColor">
                                <path d="M184 128a56 56 0 1 1-56-56a56 56 0 0 1 56 56Z" opacity=".2"></path>
                                <path
                                    d="M120 40V16a8 8 0 0 1 16 0v24a8 8 0 0 1-16 0Zm72 88a64 64 0 1 1-64-64a64.07 64.07 0 0 1 64 64Zm-16 0a48 48 0 1 0-48 48a48.05 48.05 0 0 0 48-48ZM58.34 69.66a8 8 0 0 0 11.32-11.32l-16-16a8 8 0 0 0-11.32 11.32Zm0 116.68l-16 16a8 8 0 0 0 11.32 11.32l16-16a8 8 0 0 0-11.32-11.32ZM192 72a8 8 0 0 0 5.66-2.34l16-16a8 8 0 0 0-11.32-11.32l-16 16A8 8 0 0 0 192 72Zm5.66 114.34a8 8 0 0 0-11.32 11.32l16 16a8 8 0 0 0 11.32-11.32ZM48 128a8 8 0 0 0-8-8H16a8 8 0 0 0 0 16h24a8 8 0 0 0 8-8Zm80 80a8 8 0 0 0-8 8v24a8 8 0 0 0 16 0v-24a8 8 0 0 0-8-8Zm112-88h-24a8 8 0 0 0 0 16h24a8 8 0 0 0 0-16Z"></path>
                            </g>
                        </svg>
                        <svg class="hover:text-purple-500 hover:cursor-pointer dark:text-white" v-else @click="changeMode('dark')" xmlns="http://www.w3.org/2000/svg" width="1.5em"
                             height="1.5em" viewBox="0 0 256 256">
                            <g fill="currentColor">
                                <path d="M227.89 147.89A96 96 0 1 1 108.11 28.11a96.09 96.09 0 0 0 119.78 119.78Z"
                                      opacity=".2"></path>
                                <path
                                    d="M233.54 142.23a8 8 0 0 0-8-2a88.08 88.08 0 0 1-109.8-109.8a8 8 0 0 0-10-10a104.84 104.84 0 0 0-52.91 37A104 104 0 0 0 136 224a103.09 103.09 0 0 0 62.52-20.88a104.84 104.84 0 0 0 37-52.91a8 8 0 0 0-1.98-7.98Zm-44.64 48.11A88 88 0 0 1 65.66 67.11a89 89 0 0 1 31.4-26A106 106 0 0 0 96 56a104.11 104.11 0 0 0 104 104a106 106 0 0 0 14.92-1.06a89 89 0 0 1-26.02 31.4Z"></path>
                            </g>
                        </svg>

                    </div>

                    <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-32 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                <span >{{mode==='dark'?'light':'dark'}} theme</span>
                                </h3>
                        </div>

                        <div data-popper-arrow></div>
                    </div>

                    <button  type="button" data-dropdown-toggle="notification-dropdown"
                            class="p-2 mr-1 text-gray-500 rounded-lg hover:text-purple-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <span class="sr-only">View notifications</span>
                        <!-- Bell icon -->

                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-waving-hand font-extrabold dark:text-white" width="1.5em"
                             height="1.5em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" strokeWidth="2.5">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                      d="M6 19v-9a6 6 0 0 1 6-6v0a6 6 0 0 1 6 6v9M6 19h12M6 19H4m14 0h2m-9 3h2"></path>
                                <circle cx="12" cy="3" r="1"></circle>
                            </g>
                        </svg>


                        <div
                            class="dark:bg-blue-600 absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 border-1 border-white rounded-full top-3 ring-1 dark:border-gray-900">
                            8
                        </div>

                    </button>

                    <div v-auto-animate
                        class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700"
                        id="notification-dropdown">
                        <div
                            class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            Notifications
                        </div>
                        <div>
                            <a href="#"
                               class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="w-11 h-11 rounded-full"
                                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                                         alt="Bonnie Green avatar">
                                    <div
                                        class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700 dark:border-gray-700">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                            <path
                                                d="M15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783ZM6 2h6a1 1 0 1 1 0 2H6a1 1 0 0 1 0-2Zm7 5H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Z"/>
                                            <path
                                                d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">New message
                                        from <span
                                            class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span>:
                                        "Hey, what's up? All set for the presentation?"
                                    </div>
                                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">a few
                                        moments ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="w-11 h-11 rounded-full"
                                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                         alt="Jese Leos avatar">
                                    <div
                                        class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-gray-900 rounded-full border border-white dark:border-gray-700">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span
                                        class="font-semibold text-gray-900 dark:text-white">Jese leos</span> and <span
                                        class="font-medium text-gray-900 dark:text-white">5 others</span> started
                                        following you.
                                    </div>
                                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">10 minutes
                                        ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="w-11 h-11 rounded-full"
                                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                                         alt="Joseph McFall avatar">
                                    <div
                                        class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-red-600 rounded-full border border-white dark:border-gray-700">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span
                                        class="font-semibold text-gray-900 dark:text-white">Joseph Mcfall</span> and
                                        <span class="font-medium text-gray-900 dark:text-white">141 others</span> love
                                        your story. See it and view more stories.
                                    </div>
                                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">44 minutes
                                        ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="w-11 h-11 rounded-full"
                                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                                         alt="Roberta Casas image">
                                    <div
                                        class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-green-400 rounded-full border border-white dark:border-gray-700">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span
                                        class="font-semibold text-gray-900 dark:text-white">Leslie Livingston</span>
                                        mentioned you in a comment: <span
                                            class="font-medium text-primary-700 dark:text-primary-500">@bonnie.green</span>
                                        what do you say?
                                    </div>
                                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">1 hour ago
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="flex py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="w-11 h-11 rounded-full"
                                         src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png"
                                         alt="Robert image">
                                    <div
                                        class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-purple-500 rounded-full border border-white dark:border-gray-700">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                            <path
                                                d="M11 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm8.585 1.189a.994.994 0 0 0-.9-.138l-2.965.983a1 1 0 0 0-.685.949v8a1 1 0 0 0 .675.946l2.965 1.02a1.013 1.013 0 0 0 1.032-.242A1 1 0 0 0 20 12V2a1 1 0 0 0-.415-.811Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span
                                        class="font-semibold text-gray-900 dark:text-white">Robert Brown</span> posted a
                                        new video: Glassmorphism - learn how to implement the new design trend.
                                    </div>
                                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">3 hours
                                        ago
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="#"
                           class="block py-2 text-base font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                            <div class="inline-flex items-center ">
                                <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                          d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>


                    <div class="flex items-center ml-3">
                        <div>
                            <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                     src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                     alt="user photo">
                            </button>
                        </div>
                        <div
                            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <DropdownLink class="block  px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
           class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
           aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium ">
                <li>
                    <a href="#" class="navCus group">


                        <svg class="hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><path fill="#888888" fillRule="evenodd" d="M9.944 1.25H10a.75.75 0 0 1 0 1.5c-1.907 0-3.261.002-4.29.14c-1.005.135-1.585.389-2.008.812c-.423.423-.677 1.003-.812 2.009c-.138 1.028-.14 2.382-.14 4.289a.75.75 0 0 1-1.5 0v-.056c0-1.838 0-3.294.153-4.433c.158-1.172.49-2.121 1.238-2.87c.749-.748 1.698-1.08 2.87-1.238c1.14-.153 2.595-.153 4.433-.153Zm8.345 1.64c-1.027-.138-2.382-.14-4.289-.14a.75.75 0 0 1 0-1.5h.056c1.838 0 3.294 0 4.433.153c1.172.158 2.121.49 2.87 1.238c.748.749 1.08 1.698 1.238 2.87c.153 1.14.153 2.595.153 4.433V10a.75.75 0 0 1-1.5 0c0-1.907-.002-3.261-.14-4.29c-.135-1.005-.389-1.585-.812-2.008c-.423-.423-1.003-.677-2.009-.812ZM9.497 6.28c-.21-.028-.504-.03-.997-.03c-.728 0-1.2.002-1.546.048c-.325.044-.427.115-.484.172c-.057.057-.128.159-.172.484c-.046.347-.048.818-.048 1.546c0 .493.002.787.03.997a.706.706 0 0 0 .042.177l.001.003l.003.001a.706.706 0 0 0 .177.042c.21.028.504.03.997.03h1c.493 0 .787-.002.997-.03a.706.706 0 0 0 .177-.042l.003-.001l.001-.003a.706.706 0 0 0 .042-.177c.028-.21.03-.504.03-.997v-1c0-.493-.002-.787-.03-.997a.706.706 0 0 0-.037-.167l-.002-.004l-.003-.006l-.001-.003l-.003-.001a.706.706 0 0 0-.177-.042Zm.2-1.487c.356.048.731.16 1.04.47c.31.309.422.684.47 1.04c.043.323.043.72.043 1.152v1.09c0 .433 0 .83-.043 1.152c-.048.356-.16.731-.47 1.04c-.309.31-.684.422-1.04.47c-.323.043-.72.043-1.152.043h-1.09c-.433 0-.83 0-1.152-.043c-.356-.048-.731-.16-1.04-.47c-.31-.309-.422-.684-.47-1.04c-.043-.323-.043-.72-.043-1.152V8.45c0-.664 0-1.237.062-1.696c.066-.491.215-.963.597-1.345s.854-.531 1.345-.597c.459-.062 1.032-.062 1.697-.062h.094c.433 0 .83 0 1.152.043Zm5.758-.043h.094c.665 0 1.238 0 1.697.062c.492.066.963.215 1.345.597s.531.854.597 1.345c.062.459.062 1.032.062 1.697v.094c0 .433 0 .83-.043 1.152c-.048.356-.16.731-.47 1.04c-.309.31-.684.422-1.04.47c-.323.043-.72.043-1.152.043h-1.09c-.433 0-.83 0-1.152-.043c-.356-.048-.731-.16-1.04-.47c-.31-.309-.422-.684-.47-1.04c-.043-.323-.043-.72-.043-1.152v-1.09c0-.433 0-.83.043-1.152c.048-.356.16-.731.47-1.04c.309-.31.684-.422 1.04-.47c.323-.043.72-.043 1.152-.043Zm-1.13 1.572l-.002.001l-.001.003a.703.703 0 0 0-.042.177c-.028.21-.03.504-.03.997v1c0 .493.002.787.03.997a.704.704 0 0 0 .042.177l.001.003l.003.001a.705.705 0 0 0 .177.042c.21.028.504.03.997.03h1c.493 0 .787-.002.997-.03a.705.705 0 0 0 .177-.042l.003-.001l.001-.003a.703.703 0 0 0 .042-.177c.028-.21.03-.504.03-.997c0-.728-.002-1.2-.048-1.546c-.044-.325-.115-.427-.172-.484c-.057-.057-.159-.128-.484-.172c-.347-.046-.818-.048-1.546-.048c-.493 0-.787.002-.997.03a.705.705 0 0 0-.167.037l-.005.002a.169.169 0 0 0-.005.003Zm-6.87 6.428h1.09c.433 0 .83 0 1.152.043c.356.048.731.16 1.04.47c.31.309.422.684.47 1.04c.043.323.043.72.043 1.152v1.09c0 .433 0 .83-.043 1.152c-.048.356-.16.731-.47 1.04c-.309.31-.684.422-1.04.47c-.323.043-.72.043-1.152.043H8.45c-.665 0-1.238 0-1.697-.062c-.491-.066-.963-.215-1.345-.597s-.531-.854-.597-1.345c-.062-.459-.062-1.032-.062-1.697v-.094c0-.433 0-.83.043-1.152c.048-.356.16-.731.47-1.04c.309-.31.684-.422 1.04-.47c.323-.043.72-.043 1.152-.043Zm-1.13 1.572l-.002.001l-.001.003a.705.705 0 0 0-.042.177c-.028.21-.03.504-.03.997c0 .728.002 1.2.048 1.546c.044.325.115.427.172.484c.057.057.159.128.484.172c.347.046.818.048 1.546.048c.493 0 .787-.002.997-.03a.703.703 0 0 0 .177-.042l.003-.001l.001-.003a.705.705 0 0 0 .042-.177c.028-.21.03-.504.03-.997v-1c0-.493-.002-.787-.03-.997a.705.705 0 0 0-.042-.177l-.001-.003l-.003-.001a.704.704 0 0 0-.177-.042c-.21-.028-.504-.03-.997-.03h-1c-.493 0-.787.002-.997.03a.703.703 0 0 0-.177.042Zm9.13-1.572h1.09c.433 0 .83 0 1.152.043c.356.048.731.16 1.04.47c.31.309.422.684.47 1.04c.043.323.043.72.043 1.152v.094c0 .665 0 1.238-.062 1.697c-.066.492-.215.963-.597 1.345s-.854.531-1.345.597c-.459.062-1.032.062-1.697.062h-.094c-.433 0-.83 0-1.152-.043c-.356-.048-.731-.16-1.04-.47c-.31-.309-.422-.684-.47-1.04c-.043-.323-.043-.72-.043-1.152v-1.09c0-.433 0-.83.043-1.152c.048-.356.16-.731.47-1.04c.309-.31.684-.422 1.04-.47c.323-.043.72-.043 1.152-.043Zm-1.13 1.572l-.002.001l-.001.003l-.002.004l-.003.006a.702.702 0 0 0-.037.167c-.028.21-.03.504-.03.997v1c0 .493.002.787.03.997a.702.702 0 0 0 .04.174l.002.003l.001.003l.003.001a.702.702 0 0 0 .177.042c.21.028.504.03.997.03c.728 0 1.2-.002 1.546-.048c.325-.044.427-.115.484-.172c.057-.057.128-.159.172-.484c.046-.347.048-.818.048-1.546c0-.493-.002-.787-.03-.997a.702.702 0 0 0-.042-.177l-.001-.003l-.003-.001a.702.702 0 0 0-.177-.042c-.21-.028-.504-.03-.997-.03h-1c-.493 0-.787.002-.997.03a.702.702 0 0 0-.177.042ZM2 13.25a.75.75 0 0 1 .75.75c0 1.907.002 3.262.14 4.29c.135 1.005.389 1.585.812 2.008c.423.423 1.003.677 2.009.812c1.028.138 2.382.14 4.289.14a.75.75 0 0 1 0 1.5h-.056c-1.838 0-3.294 0-4.433-.153c-1.172-.158-2.121-.49-2.87-1.238c-.748-.749-1.08-1.698-1.238-2.87c-.153-1.14-.153-2.595-.153-4.433V14a.75.75 0 0 1 .75-.75Zm20 0a.75.75 0 0 1 .75.75v.056c0 1.838 0 3.294-.153 4.433c-.158 1.172-.49 2.121-1.238 2.87c-.749.748-1.698 1.08-2.87 1.238c-1.14.153-2.595.153-4.433.153H14a.75.75 0 0 1 0-1.5c1.907 0 3.262-.002 4.29-.14c1.005-.135 1.585-.389 2.008-.812c.423-.423.677-1.003.812-2.009c.138-1.027.14-2.382.14-4.289a.75.75 0 0 1 .75-.75Z" clipRule="evenodd"></path></svg>

                        <Link :href="route('dashboard')" class="ml-3">Dashboard</Link>
                    </a>
                </li>
                <li>
                    <a href="#" class="navCus group">

                        <svg class="hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 256 256"><path fill="#888888" d="M117.25 157.92a60 60 0 1 0-66.5 0a95.83 95.83 0 0 0-47.22 37.71a8 8 0 1 0 13.4 8.74a80 80 0 0 1 134.14 0a8 8 0 0 0 13.4-8.74a95.83 95.83 0 0 0-47.22-37.71ZM40 108a44 44 0 1 1 44 44a44.05 44.05 0 0 1-44-44Zm210.14 98.7a8 8 0 0 1-11.07-2.33A79.83 79.83 0 0 0 172 168a8 8 0 0 1 0-16a44 44 0 1 0-16.34-84.87a8 8 0 1 1-5.94-14.85a60 60 0 0 1 55.53 105.64a95.83 95.83 0 0 1 47.22 37.71a8 8 0 0 1-2.33 11.07Z"></path></svg>

                        <Link class="ml-3" :href="route('user.index')">
                       User
                        </Link>
                    </a>
                </li>

                <li>
                    <a href="#" class="navCus group">

                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 256 256"><path fill="currentColor" d="m216.49 79.52l-56-56A12 12 0 0 0 152 20H56a20 20 0 0 0-20 20v176a20 20 0 0 0 20 20h144a20 20 0 0 0 20-20V88a12 12 0 0 0-3.51-8.48ZM160 57l23 23h-23ZM60 212V44h76v48a12 12 0 0 0 12 12h48v108Zm112-80a12 12 0 0 1-12 12H96a12 12 0 0 1 0-24h64a12 12 0 0 1 12 12Zm0 40a12 12 0 0 1-12 12H96a12 12 0 0 1 0-24h64a12 12 0 0 1 12 12Z"></path></svg>

                        <Link class="ml-3" :href="route('list.index')">
                            List
                        </Link>
                    </a>
                </li>


                <li>
                    <a href="#" class="navCus group">

                        <svg  class="hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 256 256"><path fill="#888888" d="M168 116h48a20 20 0 0 0 20-20V48a20 20 0 0 0-20-20h-48a20 20 0 0 0-20 20v12h-4a36 36 0 0 0-36 36v20H84v-4a20 20 0 0 0-20-20H32a20 20 0 0 0-20 20v32a20 20 0 0 0 20 20h32a20 20 0 0 0 20-20v-4h24v20a36 36 0 0 0 36 36h4v12a20 20 0 0 0 20 20h48a20 20 0 0 0 20-20v-48a20 20 0 0 0-20-20h-48a20 20 0 0 0-20 20v12h-4a12 12 0 0 1-12-12V96a12 12 0 0 1 12-12h4v12a20 20 0 0 0 20 20ZM60 140H36v-24h24Zm112 24h40v40h-40Zm0-112h40v40h-40Z"></path></svg>

                        <Link class="ml-3" :href="route('category.index')">
                            Category
                        </Link>
                    </a>
                </li>



                <li>
                    <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-500 font-bold  rounded-lg group hover:bg-gray-100 hover:duration-500  hover:delay-300 hover:text-purple-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="localtionManagment" data-collapse-toggle="localtionManagment">


                        <svg class="hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 256 256"><g fill="currentColor"><path d="M215 168.71a96.42 96.42 0 0 1-30.54 37l-9.36-9.37a8 8 0 0 0-3.63-2.09L150 188.59a8 8 0 0 1-5.88-8.9l2.38-16.2a8 8 0 0 1 4.84-6.22l30.46-12.66a8 8 0 0 1 8.47 1.49ZM159.89 105l22.17-25.8A8 8 0 0 0 184 74V50A96 96 0 0 0 50.49 184.65l9.92-6.52a8 8 0 0 0 3.59-6.64l.21-36.23a8.06 8.06 0 0 1 1.35-4.41l20.94-31.3a8 8 0 0 1 11.34-2l19.81 13a8.06 8.06 0 0 0 5.77 1.45l31.46-4.26a8 8 0 0 0 5.01-2.74Z" opacity=".2"></path><path d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm0 16a87.5 87.5 0 0 1 48 14.28V74l-22.17 25.74l-31.47 4.26l-.31-.22l-19.67-12.86a16 16 0 0 0-22.51 4.18l-20.94 31.3a16 16 0 0 0-2.7 8.81L56 171.44l-3.27 2.15A88 88 0 0 1 128 40ZM62.29 186.47l2.52-1.65A16 16 0 0 0 72 171.53l.21-36.23L93.17 104a3.62 3.62 0 0 0 .32.22l19.67 12.87a15.94 15.94 0 0 0 11.35 2.77l31.49-4.27a16 16 0 0 0 10-5.41l22.17-25.76A16 16 0 0 0 192 74v-6.33A87.87 87.87 0 0 1 211.77 155l-16.14-14.76a16 16 0 0 0-16.93-3l-30.46 12.65a16.08 16.08 0 0 0-9.68 12.45l-2.39 16.19a16 16 0 0 0 11.77 17.81L169.4 202l2.36 2.37a87.88 87.88 0 0 1-109.47-17.9ZM185 195l-4.3-4.31a16 16 0 0 0-7.26-4.18L152 180.85l2.39-16.19L184.84 152L205 170.48A88.43 88.43 0 0 1 185 195Z"></path></g></svg>

                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Location Mater</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <ul   id="localtionManagment" class="hidden py-2 space-y-2">
                        <li class="hover:animate-bounce">

                            <Link :href="route('country.index')"
                                  class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Country</Link>
                        </li>
                        <li class="hover:animate-bounce">

                            <Link  :href="route('state.index')"
                                   class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">States</Link>
                        </li>

                        <li class="hover:animate-bounce">

                            <Link  :href="route('cities.index')"
                                   class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">City</Link>
                        </li>

                        <li class="hover:animate-bounce">


                            <Link  :href="route('area.index')"
                                   class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Areas</Link>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="navCus group font-rubik">
                        <svg  class="hover:animate-bounce" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 256 256"><g fill="#888888"><path d="m230.1 108.76l-31.85-18.14c-.64-1.16-1.31-2.29-2-3.41l-.12-36A104.61 104.61 0 0 0 162 32l-32 17.89h-4L94 32a104.58 104.58 0 0 0-34.11 19.25l-.16 36c-.7 1.12-1.37 2.26-2 3.41l-31.84 18.1a99.15 99.15 0 0 0 0 38.46l31.85 18.14c.64 1.16 1.31 2.29 2 3.41l.12 36A104.61 104.61 0 0 0 94 224l32-17.87h4L162 224a104.58 104.58 0 0 0 34.08-19.25l.16-36c.7-1.12 1.37-2.26 2-3.41l31.84-18.1a99.15 99.15 0 0 0 .02-38.48ZM128 168a40 40 0 1 1 40-40a40 40 0 0 1-40 40Z" opacity=".2"></path><path d="M128 80a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48Zm0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32Zm109.94-52.79a8 8 0 0 0-3.89-5.4l-29.83-17l-.12-33.62a8 8 0 0 0-2.83-6.08a111.91 111.91 0 0 0-36.72-20.67a8 8 0 0 0-6.46.59L128 41.85L97.88 25a8 8 0 0 0-6.47-.6a111.92 111.92 0 0 0-36.68 20.75a8 8 0 0 0-2.83 6.07l-.15 33.65l-29.83 17a8 8 0 0 0-3.89 5.4a106.47 106.47 0 0 0 0 41.56a8 8 0 0 0 3.89 5.4l29.83 17l.12 33.63a8 8 0 0 0 2.83 6.08a111.91 111.91 0 0 0 36.72 20.67a8 8 0 0 0 6.46-.59L128 214.15L158.12 231a7.91 7.91 0 0 0 3.9 1a8.09 8.09 0 0 0 2.57-.42a112.1 112.1 0 0 0 36.68-20.73a8 8 0 0 0 2.83-6.07l.15-33.65l29.83-17a8 8 0 0 0 3.89-5.4a106.47 106.47 0 0 0-.03-41.52Zm-15 34.91l-28.57 16.25a8 8 0 0 0-3 3c-.58 1-1.19 2.06-1.81 3.06a7.94 7.94 0 0 0-1.22 4.21l-.15 32.25a95.89 95.89 0 0 1-25.37 14.3L134 199.13a8 8 0 0 0-3.91-1h-3.83a8.1 8.1 0 0 0-4.1 1l-28.84 16.1A96 96 0 0 1 67.88 201l-.11-32.2a8 8 0 0 0-1.22-4.22c-.62-1-1.23-2-1.8-3.06a8.09 8.09 0 0 0-3-3.06l-28.6-16.29a90.49 90.49 0 0 1 0-28.26l28.52-16.28a8 8 0 0 0 3-3c.58-1 1.19-2.06 1.81-3.06a7.94 7.94 0 0 0 1.22-4.21l.15-32.25a95.89 95.89 0 0 1 25.37-14.3L122 56.87a8 8 0 0 0 4.1 1h3.64a8 8 0 0 0 4.1-1l28.84-16.1A96 96 0 0 1 188.12 55l.11 32.2a8 8 0 0 0 1.22 4.22c.62 1 1.23 2 1.8 3.06a8.09 8.09 0 0 0 3 3.06l28.6 16.29a90.49 90.49 0 0 1 .05 28.29Z"></path></g></svg>

                        <Link class="ml-3" :href="route('setting.index')">
                            Settings
                        </Link>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 dark:bg-gray-800 dark:border-gray-700 h-full ">
        <div class="p-4  rounded-lg dark:border-gray-700 mt-14 ">
            <slot/>
        </div>
    </div>
    </div>
</template>
