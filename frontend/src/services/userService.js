import axios from 'axios';
import { useAppStore } from '@/store/app';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

const create = async (username, password) => {
   try {
  
    await axios.post(`${BACKEND_URL}/register`, {
        username: username,
        password: password
    }).then(async (res) => {
        const store = useAppStore();
        store.setIsAuthenticated(true);
    })
    .catch(error => {
        throw error;
    });
   } catch (error) {
        throw error;
   }
};

export default {
    create
};