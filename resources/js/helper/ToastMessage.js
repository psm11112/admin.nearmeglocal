import { useToast } from 'vue-toastification'
import ToastNotification from "@/Components/NotificationToast.vue";



export default function ToastMessage() {

    const ToastMessage = useToast()

    ToastMessage.success(ToastNotification,{
        icon:false
    });
    return {
        ToastMessage,

    };
}
