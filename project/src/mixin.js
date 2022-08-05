import axios from "axios";

export default {
    methods: {
        async $get(url, param) {
            return (await axios.get(url, {
                params : param
            }).catch(e => {
                console.log(e);
            })).data;
        },
        
        async $post(url, data) {
            return (await axios({
                method: 'post',
                url,
                data
            }).catch(e => {
                console.error(e);
            })).data;
        },
        
    }
}