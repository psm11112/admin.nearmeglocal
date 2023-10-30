import ToastMessage from '@/Components/Totast.vue'
import { useToast } from "vue-toastification";

const useToast= useToast();
const toast = {
 messsage() {

    useToast.success(ToastMessage,{
        icon: false,
    })

},

}

export default toast
