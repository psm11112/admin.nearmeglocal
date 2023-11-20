const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')


/** @type {import('tailwindcss').Config} */
module.exports = {


        fileupload: {
            input: 'hidden',
            buttonbar: {
                class: ['flex flex-wrap', 'bg-gray-50 dark:bg-gray-800 p-5 border border-solid border-gray-300 dark:border-blue-900/40 text-gray-700 dark:text-white/80 rounded-tr-lg rounded-tl-lg gap-2 border-b-0']
            },
            chooseButton: {
                class: ['text-white bg-blue-500 border border-blue-500 p-3 px-5 rounded-md text-base', 'overflow-hidden relative']
            },
            chooseIcon: 'mr-2 inline-block',
            chooseButtonLabel: 'flex-1 font-bold',
            uploadbutton: {
                icon: 'mr-2'
            },
            cancelbutton: {
                icon: 'mr-2'
            },
            content: {
                class: ['relative', 'bg-white dark:bg-gray-900 p-8 border border-gray-300 dark:border-blue-900/40 text-gray-700 dark:text-white/80 rounded-b-lg']
            },
            file: {
                class: ['flex items-center flex-wrap', 'p-4 border border-gray-300 dark:border-blue-900/40 rounded gap-2 mb-2', 'last:mb-0']
            },
            thumbnail: 'shrink-0',
            fileName: 'mb-2',
            fileSize: 'mr-2',
            uploadicon: 'mr-2'
        },


    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js",
        "./node_modules/primevue/**/*.{vue,js,ts,jsx,tsx}"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
                rubik: ['Rubik',  'sans-serif']
            },
            keyframes: {
                wave: {
                    '0%': { transform: 'rotate(0.0deg)' },
                    '10%': { transform: 'rotate(14deg)' },
                    '20%': { transform: 'rotate(-8deg)' },
                    '30%': { transform: 'rotate(14deg)' },
                    '40%': { transform: 'rotate(-4deg)' },
                    '50%': { transform: 'rotate(10.0deg)' },
                    '60%': { transform: 'rotate(0.0deg)' },
                    '100%': { transform: 'rotate(0.0deg)' },
                },
            },
            animation: {
                'waving-hand': 'wave 2s linear infinite',
            },

        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],
};
