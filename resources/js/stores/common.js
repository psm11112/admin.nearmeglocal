import { defineStore } from 'pinia'

export const useCommonStore = defineStore('mode',{


    state: () => ({
        mode:localStorage.getItem('color-theme')? localStorage.getItem('color-theme'): 'light',

    }),

    actions: {

         addMode(value) {
             this.mode=value
             localStorage.setItem('color-theme',value)
         }
    }
})
