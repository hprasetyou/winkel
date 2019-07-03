import Axios from 'axios';
import {store} from './store/store';

const headers = {
    'Accept': 'application/json'
}
if(store.getters.hasToken){
    headers.Authorization = store.getters.getToken;
    console.log(headers);
    
}

export default Axios.create({
    headers
})
  
  