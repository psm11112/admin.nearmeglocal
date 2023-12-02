
export default function GetValue(value) {
    let rt=''



    function setValue(value){

        if(value ==1){
            rt= true
        }else{
            rt= false
        }
        return rt
    }


    return{

        setValue
    }

}
