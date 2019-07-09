import Axios from 'axios';
import {store} from './store/store';

const headers = {
    'Accept': 'application/json'
}
const makeRequest = function(token = false){
    if(!token){
        if(store.getters.hasToken){
            headers['Authorization'] = store.getters.getToken;
            headers['Active-Store'] = store.getters.getActiveStore;    
        }
    }else{
        headers.Authorization = store.getters.getToken;
    }
    return Axios.create({
        headers
    })
}

export default makeRequest;
  
  