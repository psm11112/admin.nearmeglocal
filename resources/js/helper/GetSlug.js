



export default function GetSlug(name) {
    let slug = ''

    console.log(name)

    async function asyncCall() {
        console.log('calling');
       // const result = await resolveAfter2Seconds();

        const  result= await axios.get('/api/slug/'+name);

        return result;

        console.log(result)
    }


    return {
        slug,
        asyncCall
    };
}
