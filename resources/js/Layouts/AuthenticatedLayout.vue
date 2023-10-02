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


const {mode} = storeToRefs(useCommonStore());


const showingNavigationDropdown = ref(false);
const {addMode} = useCommonStore()


function changeMode(value) {

    addMode(value)

    var root = document.getElementsByTagName('html')[0]; // '0' to assign the first (and only `HTML` tag)
    root.setAttribute('class', value);


}

const [show] = useAutoAnimate({
    duration: 300,
    easing: 'ease-in'

})
</script>

<template>
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
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo"/>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Flowbite</span>
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
                                    <a href="#"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Sign out</a>
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
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class=" navCus group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" class="text-2xl font-bold" height="1em"
                             viewBox="0 0 256 256">
                            <path fill="currentColor"
                                  d="m216.13 106.72l-80.06-75.59a12 12 0 0 0-16.2.05l-79.94 75.49a12 12 0 0 0-3.93 8.87V208a12 12 0 0 0 12 12h48a12 12 0 0 0 12-12v-48a4 4 0 0 1 4-4h32a4 4 0 0 1 4 4v48a12 12 0 0 0 12 12h48a12 12 0 0 0 12-12v-92.46a12 12 0 0 0-3.87-8.82ZM212 208a4 4 0 0 1-4 4h-48a4 4 0 0 1-4-4v-48a12 12 0 0 0-12-12h-32a12 12 0 0 0-12 12v48a4 4 0 0 1-4 4H48a4 4 0 0 1-4-4v-92.46a4.09 4.09 0 0 1 1.36-3l79.94-75.49a4 4 0 0 1 5.33 0l80.06 75.58a4 4 0 0 1 1.31 3Z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="navCus group font-rubik">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" class="text-2xl font-bold" height="1em"
                             viewBox="0 0 256 256">
                            <path fill="currentColor"
                                  d="m216.13 106.72l-80.06-75.59a12 12 0 0 0-16.2.05l-79.94 75.49a12 12 0 0 0-3.93 8.87V208a12 12 0 0 0 12 12h48a12 12 0 0 0 12-12v-48a4 4 0 0 1 4-4h32a4 4 0 0 1 4 4v48a12 12 0 0 0 12 12h48a12 12 0 0 0 12-12v-92.46a12 12 0 0 0-3.87-8.82ZM212 208a4 4 0 0 1-4 4h-48a4 4 0 0 1-4-4v-48a12 12 0 0 0-12-12h-32a12 12 0 0 0-12 12v48a4 4 0 0 1-4 4H48a4 4 0 0 1-4-4v-92.46a4.09 4.09 0 0 1 1.36-3l79.94-75.49a4 4 0 0 1 5.33 0l80.06 75.58a4 4 0 0 1 1.31 3Z"></path>
                        </svg>
                        <span class="ml-3">User</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-500 font-bold  rounded-lg group hover:bg-gray-100 hover:duration-500  hover:delay-300 hover:text-purple-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" class="text-2xl"
                             viewBox="0 0 256 256">
                            <path fill="currentColor"
                                  d="M236 69.4a16.13 16.13 0 0 0-12.08-5.4H176a48 48 0 0 0-96 0H32.08a16.13 16.13 0 0 0-12 5.4a16 16 0 0 0-3.92 12.48l14.26 120a16 16 0 0 0 16 14.12h163.25a16 16 0 0 0 16-14.12l14.26-120A16 16 0 0 0 236 69.4ZM128 32a32 32 0 0 1 32 32H96a32 32 0 0 1 32-32Zm81.76 168a.13.13 0 0 1-.09 0H46.25L32.08 80H80v24a8 8 0 0 0 16 0V80h64v24a8 8 0 0 0 16 0V80h48Z"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">E-commerce</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                               class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                        </li>
                    </ul>
                </li>
                <li class="transition duration-300 delay-150  hover:text-purple-700">
                    Demo
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 dark:bg-gray-800 dark:border-gray-700 ">
        <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
            <slot/>

        </div>
    </div>
</template>
